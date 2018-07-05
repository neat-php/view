<?php

namespace Neat\View;

class Element
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string[]
     */
    protected $attributes;

    /**
     * @var string|string[]|Element[]
     */
    protected $content;

    /**
     * Element constructor
     *
     * @param string                    $name
     * @param string[]                  $attributes
     * @param string|string[]|Element[] $content
     */
    public function __construct(string $name, array $attributes = [], $content = null)
    {
        $this->name       = $name;
        $this->attributes = $attributes;
        $this->content    = $content;
    }

    /**
     * Render element
     *
     * @return mixed
     */
    public function __toString()
    {
        if ($this->content === null) {
            return $this->open();
        }

        return $this->open() . $this->content() . $this->close();
    }

    /**
     * Escape content
     *
     * @param string $content
     * @return string
     */
    protected function escape($content)
    {
        return htmlspecialchars($content, ENT_COMPAT | ENT_HTML5, 'UTF-8');
    }

    /**
     * Get name
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get attributes
     *
     * @return string
     */
    public function attributes()
    {
        $attributes = $this->attributes;
        array_walk($attributes, function (&$value, $key) {
            if (!is_int($key)) {
                $value = sprintf(' %s="%s"', $key, $this->escape($value));
            } else {
                $value = ' ' . $value;
            }
        });

        return implode('', $attributes);
    }

    /**
     * Get open tag
     *
     * @return string
     */
    public function open()
    {
        return '<' . $this->name() . $this->attributes() . '>';
    }

    /**
     * Get content
     *
     * @return string
     */
    public function content()
    {
        return implode('', array_map(function ($content) {
            if ($content instanceof Element) {
                return (string) $content;
            }

            return $this->escape($content);
        }, (array) $this->content));
    }

    /**
     * Get close tag
     *
     * @return string
     */
    public function close()
    {
        return '</' . $this->name() . '>';
    }
}
