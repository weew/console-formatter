<?php

namespace tests\spec\Weew\ConsoleFormatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\ConsoleFormatter\ConsoleBackground;

/**
 * @mixin ConsoleBackground
 */
class ConsoleBackgroundSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType(ConsoleBackground::class);
    }

    function it_returns_code() {
        $this->getBackgroundCode('red')->shouldBe(41);
    }

    function it_returns_name() {
        $this->getBackgroundName(41)->shouldBe('red');
    }

    function it_returns_null_for_unknown_names() {
        $this->getBackgroundName('code')->shouldBe(null);
    }

    function it_returns_null_for_unknown_codes() {
        $this->getBackgroundName('name')->shouldBe(null);
    }

    function it_returns_default_name() {
        $this->getBackgroundName('code', 'name')->shouldBe('name');
    }

    function it_returns_default_code() {
        $this->getBackgroundCode('name', 'code')->shouldBe('code');
    }
}
