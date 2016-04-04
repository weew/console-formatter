<?php

namespace tests\spec\Weew\Cli\OutputFormatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\Cli\OutputFormatter\FormatParser;

/**
 * @mixin FormatParser
 */
class FormatParserSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType(FormatParser::class);
    }

    function it_parses_format() {
        $expected = [
            ['<tag1 prop=val1,val2 prop=val3>', 'tag1', ' prop=val1,val2 prop=val3'],
            ['<tag2>', 'tag2', ''],
            ['</tag2>', 'tag2', ''],
            ['</tag1>', 'tag1', ''],
        ];

        $this->parseFormat(
            'text<tag1 prop=val1,val2 prop=val3>text<tag2>text</tag2>text</tag1>text'
        )->shouldBe($expected);
    }

    function it_parses_style() {
        $expected = [
            ['color=red,blue', 'color', 'red,blue'],
            ['background=lime,yellow', 'background', 'lime,yellow'],
            ['format=bold,italic', 'format', 'bold,italic'],
        ];

        $this->parseStyle(
            'color=red,blue background=lime,yellow format=bold,italic'
        )->shouldBe($expected);

        $this->parseStyle(
            '<style color=red,blue background=lime,yellow format=bold,italic>'
        )->shouldBe($expected);

        $this->parseStyle(
            'color=red,blue;background=lime,yellow; format=bold,italic>'
        )->shouldBe($expected);
    }
}
