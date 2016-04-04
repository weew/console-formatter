<?php

namespace tests\spec\Weew\Cli\OutputFormatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\Cli\OutputFormatter\OutputColor;

/**
 * @mixin OutputColor
 */
class OutputColorSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType(OutputColor::class);
    }

    function it_returns_code() {
        $this->getColorCode('red')->shouldBe(31);
    }

    function it_returns_name() {
        $this->getColorName(31)->shouldBe('red');
    }

    function it_returns_null_for_unknown_names() {
        $this->getColorName('code')->shouldBe(null);
    }

    function it_returns_null_for_unknown_codes() {
        $this->getColorName('name')->shouldBe(null);
    }

    function it_returns_default_name() {
        $this->getColorName('code', 'name')->shouldBe('name');
    }

    function it_returns_default_code() {
        $this->getColorCode('name', 'code')->shouldBe('code');
    }
}
