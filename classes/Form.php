<?php

namespace Neat\View;

use Neat\Http\Input;

class Form
{
    /**
     * @var Input
     */
    protected $input;

    /**
     * Form constructor
     *
     * @param Input $input
     */
    public function __construct(Input $input)
    {
        $this->input  = $input;
    }

    /**
     * Get errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->input->errors();
    }

    /**
     * Open form
     *
     * @param array $attributes
     * @return string
     */
    public function open(array $attributes = [])
    {
        $element = new Element('form', $attributes);

        return $element->open();
    }

    /**
     * Close form
     *
     * @return string
     */
    public function close()
    {
        $element = new Element('form');

        return $element->close();
    }

    /**
     * Input
     *
     * @param string $type
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function input(string $type, string $name, array $attributes = [])
    {
        $input = ['type' => $type, 'name' => $name];
        if (!isset($attributes['value']) && $this->input->has($name)) {
            $input['value'] = $this->input->get($name);
        }

        return new Element('input', array_merge($input, $attributes));
    }

    /**
     * Checkbox
     *
     * @param string $name
     * @param string $value
     * @param array  $attributes
     * @return string
     */
    public function checkbox(string $name, string $value, array $attributes = [])
    {
        $attributes['value'] = $value;
        if ($this->input->get($name) == $value) {
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
     * @return string
     */
    public function radio(string $name, string $value, array $attributes = [])
    {
        $attributes['value'] = $value;
        if ($this->input->get($name) == $value) {
            $attributes[] = 'checked';
        }

        return $this->input('radio', $name, $attributes);
    }

    /**
     * Color input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function color(string $name, array $attributes = [])
    {
        return $this->input('color', $name, $attributes);
    }

    /**
     * Date input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function date(string $name, array $attributes = [])
    {
        $attributes['pattern'] = '[0-9]{4}-[0-9]{2}-[0-9]{2}';

        return $this->input('date', $name, $attributes);
    }

    /**
     * Date and time input (time includes fraction of a second, but no time zone)
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function datetimeLocal(string $name, array $attributes = [])
    {
        return $this->input('datetime-local', $name, $attributes);
    }

    /**
     * E-mail input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function email(string $name, array $attributes = [])
    {
        return $this->input('email', $name, $attributes);
    }

    /**
     * File input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function file(string $name, array $attributes = [])
    {
        return $this->input('file', $name, $attributes);
    }

    /**
     * Hidden input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function hidden(string $name, array $attributes = [])
    {
        return $this->input('hidden', $name, $attributes);
    }

    /**
     * Image submit button
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function image(string $name, array $attributes = [])
    {
        return $this->input('image', $name, $attributes);
    }

    /**
     * Month and year input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function month(string $name, array $attributes = [])
    {
        $attributes['pattern'] = '[0-9]{4}-[0-9]{2}';

        return $this->input('month', $name, $attributes);
    }

    /**
     * Number input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function number(string $name, array $attributes = [])
    {
        return $this->input('number', $name, $attributes);
    }

    /**
     * Password input (characters are masked)
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function password(string $name, array $attributes = [])
    {
        return $this->input('password', $name, $attributes);
    }

    /**
     * Range input (default range is 0 to 100)
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function range(string $name, array $attributes = [])
    {
        return $this->input('range', $name, $attributes);
    }

    /**
     * Search input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function search(string $name, array $attributes = [])
    {
        return $this->input('search', $name, $attributes);
    }

    /**
     * Telephone number input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function tel(string $name, array $attributes = [])
    {
        return $this->input('tel', $name, $attributes);
    }

    /**
     * Text input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function text(string $name, array $attributes = [])
    {
        return $this->input('text', $name, $attributes);
    }

    /**
     * Time input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function time(string $name, array $attributes = [])
    {
        $attributes['pattern'] = '[0-9]{2}:[0-9]{2}';

        return $this->input('time', $name, $attributes);
    }

    /**
     * URL input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function url(string $name, array $attributes = [])
    {
        return $this->input('url', $name, $attributes);
    }

    /**
     * Week and year input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function week(string $name, array $attributes = [])
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
     * @return string
     */
    public function select(string $name, array $options, array $attributes = [])
    {
        $selected = $this->input->get($name);
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
     * Option
     *
     * @param string $label
     * @param string $value
     * @param array  $attributes
     * @return string
     */
    public function option(string $label = null, string $value = null, array $attributes = [])
    {
        if ($value !== null) {
            $attributes['value'] = $value;
        }

        return new Element('option', $attributes, $label);
    }

    /**
     * Text area input
     *
     * @param string $name
     * @param array  $attributes
     * @return string
     */
    public function textarea(string $name, array $attributes = [])
    {
        $attributes = array_merge(['name' => $name], $attributes);

        return new Element('textarea', $attributes, $this->input->get($name) ?? '');
    }

    /**
     * Button
     *
     * @param string $label
     * @param array  $attributes
     * @return string
     */
    public function button(string $label, array $attributes = [])
    {
        $attributes['type'] = 'button';

        return new Element('button', $attributes, $label);
    }

    /**
     * Reset button
     *
     * @param string $label
     * @param array  $attributes
     * @return string
     */
    public function reset(string $label, array $attributes = [])
    {
        $attributes['type'] = 'reset';

        return new Element('button', $attributes, $label);
    }

    /**
     * Submit button
     *
     * @param string $label
     * @param array  $attributes
     * @return string
     */
    public function submit(string $label, array $attributes = [])
    {
        $attributes['type'] = 'submit';

        return new Element('button', $attributes, $label);
    }
}
