<?php

namespace tests\spec\Weew\Cli\OutputFormatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\Cli\OutputFormatter\OutputFormatter;
use Weew\Cli\OutputFormatter\OutputStyle;

/**
 * @mixin OutputFormatter
 */
class OutputFormatterSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType(OutputFormatter::class);
    }

    function it_takes_styles_trough_the_constructor() {
        $style = new OutputStyle('name');
        $this->beConstructedWith([$style]);
        $this->getStyles()->shouldBe(['name' => $style]);
    }

    function it_takes_and_returns_styles() {
        $style = new OutputStyle('name');
        $this->setStyles([$style]);
        $this->getStyles()->shouldBe(['name' => $style]);
    }
    
    function it_enables_and_disables_ansi() {
        $this->isAnsiEnabled()->shouldBe(true);
        $this->setEnableAnsi(false);
        $this->isAnsiEnabled()->shouldBe(false);
    }

    function it_adds_style() {
        $style1 = new OutputStyle('name1');
        $style2 = new OutputStyle('name2');
        $this->addStyle($style1);
        $this->addStyle($style2);

        $this->getStyles()
            ->shouldBe(['name1' => $style1, 'name2' => $style2]);
    }

    function it_adds_styles() {
        $style1 = new OutputStyle('name1');
        $style2 = new OutputStyle('name2');
        $this->addStyles([$style1]);
        $this->addStyles([$style2]);

        $this->getStyles()
            ->shouldBe(['name1' => $style1, 'name2' => $style2]);
    }

    function it_can_tell_if_it_has_a_style() {
        $this->hasStyle('name')->shouldBe(false);
        $this->addStyle(new OutputStyle('name'));
        $this->hasStyle('name')->shouldBe(true);
    }

    function it_can_return_a_style() {
        $style = new OutputStyle('name');
        $this->getStyle('name')->shouldBe(null);
        $this->addStyle($style);
        $this->getStyle('name')->shouldBe($style);
    }

    function it_creates_a_style() {
        $style = $this->style('name', 'color', 'background', 'format', true);
        $style->getName()->shouldBe('name');
        $style->getColor()->shouldBe('color');
        $style->getBackground()->shouldBe('background');
        $style->getFormat()->shouldBe(['format']);
        $style->isAllowingInheritance()->shouldBe(true);
        $this->getStyle('name')->shouldBe($style);
    }

    function it_formats_with_ansi_and_without_styles() {
        $this->format("<red>red<blue>blue<red>red</red></blue>red</red>")
            ->shouldBe("<red>red<blue>blue<red>red</red></blue>red</red>");
    }

    function it_formats_with_ansi_and_styles() {
        $this->style('red')
            ->setColor('red')
            ->setBackground('white')
            ->setFormat(['bold', 'dim']);

        $this->style('blue')
            ->allowInheritance(true)
            ->setColor('blue')
            ->setBackground('red')
            ->setFormat('italic');

        $result = $this->format('<style color=red><red>red<blue>blue\<x><red>red</red></blue>red</red></style>')->getWrappedObject();
        $result = str_replace("\e", '', $result);
        $expected = '[0;31m[0;31;107;1;2mred[34;41;3mblue<x>[0;31;107;1;2mred[34;41;3m[0;31;107;1;2mred[0;31m[0m';

        it($result)->shouldBe($expected);
    }

    function it_formats_without_ansi_and_styles() {
        $this->setEnableAnsi(false);
        $this->format('<style color=red><red>red<blue>blue\<x><red>red</red></blue>red</red></style>')
            ->shouldBe('<red>red<blue>blue<x><red>red</red></blue>red</red>');
    }

    function it_formats_without_ansi_and_with_styles() {
        $this->setEnableAnsi(false);

        $this->style('red')
            ->setColor('red')
            ->setBackground('white')
            ->setFormat(['bold', 'dim']);

        $this->style('blue')
            ->allowInheritance(true)
            ->setColor('blue')
            ->setBackground('red')
            ->setFormat('italic');

        $this->format('<style color=red><red>red<blue>blue<red>red</red></blue>red</red></style>')
            ->shouldBe('redblueredred');
    }
}
