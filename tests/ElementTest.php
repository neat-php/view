<?php

namespace Neat\View\Test;

use Neat\View\Element;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase
{
    /**
     * Test empty element
     */
    public function testEmpty()
    {
        $element = new Element('br');

        $this->assertSame('<br>', (string) $element);
    }

    /**
     * Test attributes
     */
    public function testAttributes()
    {
        $this->assertSame('<input required>', (string) new Element('input', ['required']));
        $this->assertSame('<input type="text">', (string) new Element('input', ['type' => 'text']));
        $this->assertSame(
            '<input value="&lt;&gt;&quot;&amp;\'">',
            (string) new Element('input', ['value' => '<>"&\''])
        );
        $this->assertSame(
            '<input type="text" required placeholder="Type here...">',
            (string) new Element('input', ['type' => 'text', 'required', 'placeholder' => 'Type here...'])
        );
    }

    /**
     * Test content
     */
    public function testContent()
    {
        $this->assertSame('<div>Hello world!</div>', (string) new Element('div', [], 'Hello world!'));
        $this->assertSame('<div>&lt;&gt;&amp;\'"</div>', (string) new Element('div', [], '<>&\'"'));
    }
}
