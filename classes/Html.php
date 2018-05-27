<?php

namespace Neat\View;

class Html
{
    /**
     * Encoding
     *
     * @var string
     */
    protected $encoding;

    /**
     * Html constructor
     *
     * @param string $encoding
     */
    public function __construct($encoding = 'UTF-8')
    {
        $this->encoding = $encoding;
    }

    /**
     * Escape content
     *
     * @param string $content
     * @return string
     */
    public function escape($content)
    {
        return htmlspecialchars($content, ENT_QUOTES | ENT_HTML5, $this->encoding);
    }

    /**
     * Render HTML open tag
     *
     * @param string $element
     * @param array  $attributes
     * @return string
     */
    public function openTag($element, array $attributes = [])
    {
        array_unshift($attributes, $element);
        array_walk($attributes, function (&$value, $key) {
            if (!is_int($key)) {
                $value = sprintf('%s="%s"', $key, $this->escape($value));
            }
        });

        return '<' . implode(' ', $attributes) . '>';
    }

    /**
     * Render HTML close tag
     *
     * @param string $element
     * @return string
     */
    public function closeTag($element)
    {
        return '</' . $element . '>';
    }

    /**
     * Render HTML open and close element with content
     *
     * @param string $element
     * @param array  $attributes
     * @param string $content
     * @return string
     */
    public function tag($element, array $attributes = [], $content)
    {
        return $this->openTag($element, $attributes)
            . $this->escape($content)
            . $this->closeTag($element);
    }
}