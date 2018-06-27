<?php

namespace Neat\View\Test;

use Neat\View\Element;
use Neat\View\Form;
use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
    protected function assertElement($expected, $element)
    {
        $this->assertInstanceOf(Element::class, $element);
        $this->assertSame($expected, (string) $element);
    }

    public function testFormTags()
    {
        $form = new Form;

        $this->assertSame('<form>', $form->open());
        $this->assertSame('<form onsubmit="alert(\'hi\');">', $form->open(['onsubmit' => "alert('hi');"]));
        $this->assertSame('</form>', $form->close());
    }

    public function testEmpty()
    {
        $form = new Form;

        $this->assertSame([], $form->values());
        $this->assertSame([], $form->errors());

        $this->assertElement('<input type="checkbox" name="test" value="value">', $form->checkbox('test', 'value'));
        $this->assertElement('<input type="radio" name="test" value="value">', $form->radio('test', 'value'));
        $this->assertElement('<input type="color" name="test">', $form->color('test'));
        $this->assertElement('<input type="date" name="test" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">', $form->date('test'));
        $this->assertElement('<input type="datetime-local" name="test">', $form->datetimeLocal('test'));
        $this->assertElement('<input type="email" name="test">', $form->email('test'));
        $this->assertElement('<input type="file" name="test">', $form->file('test'));
        $this->assertElement('<input type="hidden" name="test">', $form->hidden('test'));
//        $this->assertElement('<input type="image" name="test">', $form->image('test'));
        $this->assertElement('<input type="month" name="test" pattern="[0-9]{4}-[0-9]{2}">', $form->month('test'));
        $this->assertElement('<input type="number" name="test">', $form->number('test'));
        $this->assertElement('<input type="password" name="test">', $form->password('test'));
        $this->assertElement('<input type="range" name="test">', $form->range('test'));
        $this->assertElement('<input type="search" name="test">', $form->search('test'));
        $this->assertElement('<input type="tel" name="test">', $form->tel('test'));
        $this->assertElement('<input type="text" name="test">', $form->text('test'));
        $this->assertElement('<input type="time" name="test" pattern="[0-9]{2}:[0-9]{2}">', $form->time('test'));
        $this->assertElement('<input type="url" name="test">', $form->url('test'));
        $this->assertElement('<input type="week" name="test" pattern="[0-9]{4}-W[0-9]{2}">', $form->week('test'));
        $this->assertElement('<select name="test"><option value="0">first</option><option value="1">second</option></select>', $form->select('test', [
            'first',
            'second',
        ]));
        $this->assertElement('<textarea name="test"></textarea>', $form->textarea('test'));
    }

    public function testValues()
    {
        $form = new Form([
            'name'           => 'value',
            'color'          => '#ABCDEF',
            'date'           => '2018-01-01',
            'datetime-local' => '',
            'email'          => 'test@example.com',
            'file'           => (object) [],
            'hidden'         => 'invisible',
            'month'          => '2018-01',
            'number'         => 123,
            'password'       => 'secret',
            'range'       => 1,
            'search' => 'anything'
        ]);

        $this->assertSame(['name' => 'value'], $form->values());
        $this->assertSame([], $form->errors());

        $this->assertElement('<input type="checkbox" name="name" value="value" checked>', $form->checkbox('name', 'value'));
        $this->assertElement('<input type="checkbox" name="name" value="another value">', $form->checkbox('name', 'another value'));
        $this->assertElement('<input type="radio" name="name" value="value" checked>', $form->radio('name', 'value'));
        $this->assertElement('<input type="radio" name="name" value="another value">', $form->radio('name', 'another value'));
        $this->assertElement('<input type="color" name="color" value="#ABCDEF">', $form->color('color'));
        $this->assertElement('<input type="date" name="date" value="2018-01-01" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">', $form->date('test'));
//        $this->assertElement('<input type="datetime-local" name="test">', $form->datetimeLocal('test'));
        $this->assertElement('<input type="email" name="email" value="test@example.com">', $form->email('email'));
        $this->assertElement('<input type="file" name="file">', $form->file('file')); // file values are ignored
        $this->assertElement('<input type="hidden" name="hidden" value="invisible">', $form->hidden('hidden'));
        $this->assertElement('<input type="month" name="month" value="2018-01" pattern="[0-9]{4}-[0-9]{2}">', $form->month('month'));
        $this->assertElement('<input type="number" name="number" value="123">', $form->number('number'));
        $this->assertElement('<input type="password" name="password">', $form->password('password')); // password values are ignored
        $this->assertElement('<input type="range" name="range" value="1">', $form->range('range'));
        $this->assertElement('<input type="search" name="search" value="anything">', $form->search('search'));
//        $this->assertElement('<input type="tel" name="test">', $form->tel('test'));
        $this->assertElement('<input type="text" name="name" value="value">', $form->text('name'));
//        $this->assertElement('<input type="time" name="test" pattern="[0-9]{2}:[0-9]{2}">', $form->time('test'));
//        $this->assertElement('<input type="url" name="test">', $form->url('test'));
//        $this->assertElement('<input type="week" name="test" pattern="[0-9]{4}-W[0-9]{2}">', $form->week('test'));
//        $this->assertElement('<select name="test"><option value="0">first</option><option value="1">second</option></select>', $form->select('test', ['first', 'second']));
        $this->assertElement('<textarea name="name">value</textarea>', $form->textarea('name'));
    }

    public function testButton()
    {
        $form = new Form;

        $this->assertElement('<button type="button">test</button>', $form->button('test'));
        $this->assertElement('<button type="reset">test</button>', $form->reset('test'));
        $this->assertElement('<button type="submit">test</button>', $form->submit('test'));
    }
}
