<?php

namespace Neat\View;

class Form
{
    /**
     * @var string[]
     */
    protected $captions;

    /**
     * @var mixed[]
     */
    protected $values;

    /**
     * @var string[]
     */
    protected $errors;

    /**
     * Form constructor
     *
     * @param string[] $captions
     * @param mixed[]  $values
     * @param string[] $errors
     */
    public function __construct(array $captions = [], array $values = [], array $errors = [])
    {
        $this->captions = $captions;
        $this->values = $values;

        $errorKeys = array_keys($errors);
        $errorDescriptions = array_map(function (string $field, string $error) {
            return str_replace(':field', $this->captions[$field] ?? ':field', $error);
        }, $errorKeys, $errors);
        $this->errors = array_combine($errorKeys, $errorDescriptions);
    }

    /**
     * Get captions
     *
     * @return string[]
     */
    public function captions(): array
    {
        return $this->captions;
    }

    /**
     * Get caption
     *
     * @param string $name
     * @return string Defaults to $name if unknown
     */
    public function caption(string $name): string
    {
        return $this->captions[$name] ?? $name;
    }

    /**
     * Get values
     *
     * @return mixed[]
     */
    public function values(): array
    {
        return $this->values;
    }

    /**
     * Get value
     *
     * @param string $name
     * @return mixed|null
     */
    public function value(string $name)
    {
        return $this->values[$name] ?? null;
    }

    /**
     * Get errors
     *
     * @return string[]
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Get error
     *
     * @param string $name
     * @return string|null
     */
    public function error(string $name)
    {
        return $this->errors[$name] ?? null;
    }

    /**
     * Error list
     *
     * @param array $attributes
     * @return Element|null
     */
    public function errorList(array $attributes = [])
    {
        if (!$this->errors) {
            return null;
        }

        return new Element('ul', $attributes, array_map(function (string $error) {
            return new Element('li', [], $error);
        }, $this->errors));
    }

    /**
     * Open form
     *
     * @param array $attributes
     * @return string
     */
    public function open(array $attributes = []): string
    {
        $element = new Element('form', $attributes);

        return $element->open();
    }

    /**
     * Close form
     *
     * @return string
     */
    public function close(): string
    {
        $element = new Element('form');

        return $element->close();
    }

    /**
     * Label
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function label(string $name, array $attributes = []): Element
    {
        return new Element('label', $attributes, $this->caption($name));
    }

    /**
     * Input
     *
     * @param string $type
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function input(string $type, string $name, array $attributes = []): Element
    {
        $input = ['type' => $type, 'name' => $name];
        if (!isset($attributes['value']) && isset($this->values[$name]) && !in_array($type, ['file', 'image', 'password'])) {
            $input['value'] = $this->values[$name];
        }

        return new Element('input', array_merge($input, $attributes));
    }

    /**
     * Checkbox
     *
     * @param string $name
     * @param string $value
     * @param array  $attributes
     * @return Element
     */
    public function checkbox(string $name, string $value, array $attributes = []): Element
    {
        $attributes['value'] = $value;
        if (isset($this->values[$name]) && $this->values[$name] == $value) {
            $attributes[] = 'checked';
        }

        return $this->input('checkbox', $name, $attributes);
    }

    /**
     * Radio button
     *
     * @param string $name
     * @param string $value
     * @param array  $attributes
     * @return Element
     */
    public function radio(string $name, string $value, array $attributes = []): Element
    {
        $attributes['value'] = $value;
        if (isset($this->values[$name]) && $this->values[$name] == $value) {
            $attributes[] = 'checked';
        }

        return $this->input('radio', $name, $attributes);
    }

    /**
     * Color input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function color(string $name, array $attributes = []): Element
    {
        return $this->input('color', $name, $attributes);
    }

    /**
     * Date input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function date(string $name, array $attributes = []): Element
    {
        $attributes['pattern'] = '[0-9]{4}-[0-9]{2}-[0-9]{2}';

        return $this->input('date', $name, $attributes);
    }

    /**
     * Date and time input (time includes fraction of a second, but no time zone)
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function datetimeLocal(string $name, array $attributes = []): Element
    {
        return $this->input('datetime-local', $name, $attributes);
    }

    /**
     * E-mail input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function email(string $name, array $attributes = []): Element
    {
        return $this->input('email', $name, $attributes);
    }

    /**
     * File input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function file(string $name, array $attributes = []): Element
    {
        return $this->input('file', $name, $attributes);
    }

    /**
     * Hidden input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function hidden(string $name, array $attributes = []): Element
    {
        return $this->input('hidden', $name, $attributes);
    }

    /**
     * Image submit button
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function image(string $name, array $attributes = []): Element
    {
        return $this->input('image', $name, $attributes);
    }

    /**
     * Month and year input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function month(string $name, array $attributes = []): Element
    {
        $attributes['pattern'] = '[0-9]{4}-[0-9]{2}';

        return $this->input('month', $name, $attributes);
    }

    /**
     * Number input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function number(string $name, array $attributes = []): Element
    {
        return $this->input('number', $name, $attributes);
    }

    /**
     * Password input (characters are masked)
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function password(string $name, array $attributes = []): Element
    {
        return $this->input('password', $name, $attributes);
    }

    /**
     * Range input (default range is 0 to 100)
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function range(string $name, array $attributes = []): Element
    {
        return $this->input('range', $name, $attributes);
    }

    /**
     * Search input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function search(string $name, array $attributes = []): Element
    {
        return $this->input('search', $name, $attributes);
    }

    /**
     * Telephone number input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function tel(string $name, array $attributes = []): Element
    {
        return $this->input('tel', $name, $attributes);
    }

    /**
     * Text input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function text(string $name, array $attributes = []): Element
    {
        return $this->input('text', $name, $attributes);
    }

    /**
     * Time input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function time(string $name, array $attributes = []): Element
    {
        $attributes['pattern'] = '[0-9]{2}:[0-9]{2}';

        return $this->input('time', $name, $attributes);
    }

    /**
     * URL input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function url(string $name, array $attributes = []): Element
    {
        return $this->input('url', $name, $attributes);
    }

    /**
     * Week and year input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function week(string $name, array $attributes = []): Element
    {
        $attributes['pattern'] = '[0-9]{4}-W[0-9]{2}';

        return $this->input('week', $name, $attributes);
    }

    /**
     * Select input
     *
     * @param string $name
     * @param array  $options
     * @param array  $attributes
     * @return Element
     */
    public function select(string $name, array $options, array $attributes = []): Element
    {
        $selected = $this->values[$name] ?? null;
        array_walk($options, function (&$label, $value) use ($selected) {
            $attributes = $value === $selected ? ['selected'] : [];

            $label = $this->option($label, $value, $attributes);
        });
        if (isset($attributes['placeholder'])) {
            array_unshift($options, $this->option($attributes['placeholder'], null, array_merge(
                $selected === null ? ['selected'] : [],
                ['disabled', 'value', 'style' => 'display: none;']
            )));
            unset($attributes['placeholder']);
        }

        $attributes = array_merge(['name' => $name], $attributes);

        return new Element('select', $attributes, $options);
    }

    /**
     * Multi select input
     *
     * @param string $name
     * @param array  $options
     * @param array  $attributes
     * @return Element
     */
    public function multiSelect(string $name, array $options, array $attributes = []): Element
    {
        $selected = $this->values[$name] ?? [];
        array_walk($options, function (&$label, $value) use ($selected) {
            $attributes = in_array($value, $selected, true) ? ['selected'] : [];

            $label = $this->option($label, $value, $attributes);
        });
        if (!in_array('multiple', $attributes)) {
            $attributes[] ='multiple';
        }
        if (isset($attributes['placeholder'])) {
            array_unshift($options, $this->option($attributes['placeholder'], null, array_merge(
                $selected === [] ? ['selected'] : [],
                ['disabled', 'value', 'style' => 'display: none;']
            )));
            unset($attributes['placeholder']);
        }

        $attributes = array_merge(['name' => $name], $attributes);

        return new Element('select', $attributes, $options);
    }

    /**
     * Option
     *
     * @param string $label
     * @param string $value
     * @param array  $attributes
     * @return Element
     */
    public function option(string $label = null, string $value = null, array $attributes = []): Element
    {
        if ($value !== null) {
            $attributes = array_merge(['value' => $value], $attributes);
        }

        return new Element('option', $attributes, $label);
    }

    /**
     * Text area input
     *
     * @param string $name
     * @param array  $attributes
     * @return Element
     */
    public function textarea(string $name, array $attributes = []): Element
    {
        $attributes = array_merge(['name' => $name], $attributes);

        return new Element('textarea', $attributes, $this->values[$name] ?? '');
    }

    /**
     * Button
     *
     * @param string $label
     * @param array  $attributes
     * @return Element
     */
    public function button(string $label, array $attributes = []): Element
    {
        $attributes['type'] = 'button';

        return new Element('button', $attributes, $label);
    }

    /**
     * Reset button
     *
     * @param string $label
     * @param array  $attributes
     * @return Element
     */
    public function reset(string $label, array $attributes = []): Element
    {
        $attributes['type'] = 'reset';

        return new Element('button', $attributes, $label);
    }

    /**
     * Submit button
     *
     * @param string $label
     * @param array  $attributes
     * @return Element
     */
    public function submit(string $label, array $attributes = []): Element
    {
        $attributes['type'] = 'submit';

        return new Element('button', $attributes, $label);
    }
}
