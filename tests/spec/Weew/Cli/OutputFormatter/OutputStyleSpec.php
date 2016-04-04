<?php

namespace tests\spec\Weew\Cli\OutputFormatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\Cli\OutputFormatter\FormatParser;
use Weew\Cli\OutputFormatter\OutputStyle;

/**
 * @mixin OutputStyle
 */
class OutputStyleSpec extends ObjectBehavior {
    function let(FormatParser $parser) {
        $this->beConstructedWith('name');
    }

    function it_is_initializable() {
        $this->shouldHaveType(OutputStyle::class);
    }

    function it_takes_arguments_trough_the_constructor() {
        $this->beConstructedWith('name', 'color', 'background', ['format'], true);
        $this->getName()->shouldBe('name');
        $this->getColor()->shouldBe('color');
        $this->getBackground()->shouldBe('background');
        $this->getFormat()->shouldBe(['format']);
        $this->isAllowingInheritance()->shouldBe(true);
    }

    function it_takes_and_returns_name() {
        $this->setName('name');
        $this->getName()->shouldBe('name');
    }

    function it_takes_and_returns_color() {
        $this->setColor('color');
        $this->getColor()->shouldBe('color');
    }

    function it_takes_and_returns_background() {
        $this->setBackground('background');
        $this->getBackground()->shouldBe('background');
    }

    function it_takes_and_returns_format() {
        $this->setFormat(['format']);
        $this->getFormat()->shouldBe(['format']);
    }

    function it_takes_format_as_string() {
        $this->setFormat('format');
        $this->getFormat()->shouldBe(['format']);
    }

    function it_takes_format_as_null() {
        $this->setFormat(['format']);
        $this->getFormat()->shouldBe(['format']);
        $this->setFormat(null);
        $this->getFormat()->shouldBe([]);
    }

    function it_adds_format() {
        $this->setFormat(['format1']);
        $this->addFormat('format2');
        $this->getFormat()->shouldBe(['format1', 'format2']);
    }

    function it_takes_and_allow_inheritance() {
        $this->isAllowingInheritance()->shouldBe(false);
        $this->allowInheritance(true);
        $this->isAllowingInheritance()->shouldBe(true);
    }

    function it_is_chainable_trough_set_name() {
        $this->setName('name')->shouldBe($this);
    }

    function it_is_chainable_trough_set_color() {
        $this->setColor('color')->shouldBe($this);
    }

    function it_is_chainable_trough_set_background() {
        $this->setBackground('background')->shouldBe($this);
    }

    function it_is_chainable_trough_set_format() {
        $this->setFormat('format')->shouldBe($this);
    }

    function it_is_chainable_trough_add_format() {
        $this->addFormat('format')->shouldBe($this);
    }

    function it_is_chainable_trough_allow_inheritance() {
        $this->allowInheritance(true)->shouldBe($this);
    }
    
    function it_parses_style() {
        $style = 'color=red,blue background=yellow,black format=bold,italic';
        $this->parseStyle($style);
        $this->getColor()->shouldBe('blue');
        $this->getBackground()->shouldBe('black');
        $this->getFormat()->shouldBe(['bold', 'italic']);
    }

    function it_returns_style_code() {
        $this->setColor('red');
        $this->setBackground('white');
        $this->setFormat(['bold', 'italic']);
        $this->getStyleCode()->shouldBe("0;31;107;1;3");
    }

    function it_does_not_include_reset_code_if_inheritance_is_allowed() {
        $this->setColor('red');
        $this->setBackground('white');
        $this->setFormat(['bold', 'italic']);
        $this->allowInheritance(true);
        $this->getStyleCode()->shouldBe("31;107;1;3");
    }
}
