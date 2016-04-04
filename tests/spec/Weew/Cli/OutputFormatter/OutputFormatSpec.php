<?php

namespace tests\spec\Weew\Cli\OutputFormatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\Cli\OutputFormatter\OutputFormat;

/**
 * @mixin OutputFormat
 */
class OutputFormatSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType(OutputFormat::class);
    }

    function it_returns_code() {
        $this->getFormatCode('bold')->shouldBe(1);
    }

    function it_returns_name() {
        $this->getFormatName(1)->shouldBe('bold');
    }

    function it_returns_null_for_unknown_names() {
        $this->getFormatName('code')->shouldBe(null);
    }

    function it_returns_null_for_unknown_codes() {
        $this->getFormatName('name')->shouldBe(null);
    }

    function it_returns_default_name() {
        $this->getFormatName('code', 'name')->shouldBe('name');
    }

    function it_returns_default_code() {
        $this->getFormatCode('name', 'code')->shouldBe('code');
    }
}
