<?php

namespace Neat\View\Test;

use Neat\View\Html;
use PHPUnit\Framework\TestCase;

class HtmlTest extends TestCase
{
    public function testEscape()
    {
        $html = new Html;

        $this->assertSame('Just saying', $html->escape('Just saying'));
        $this->assertSame('&lt;&gt;&amp;&quot;&apos;', $html->escape('<>&"\''));
    }


}
