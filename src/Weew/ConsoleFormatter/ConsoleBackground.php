<?php

namespace Weew\ConsoleFormatter;

class ConsoleBackground {
    const NORMAL = 'normal';
    const BLACK = 'black';
    const RED = 'red';
    const GREEN = 'green';
    const YELLOW = 'yellow';
    const BLUE = 'blue';
    const MAGENTA = 'magenta';
    const CYAN = 'cyan';
    const LIGHT_GRAY = 'light_gray';
    const DARK_GRAY = 'dark_gray';
    const LIGHT_RED = 'light_red';
    const LIGHT_GREEN = 'light_green';
    const LIGHT_YELLOW = 'light_yellow';
    const LIGHT_BLUE = 'light_blue';
    const LIGHT_MAGENTA = 'light_magenta';
    const LIGHT_CYAN = 'light_cyan';
    const WHITE = 'white';

    /**
     * @var array
     */
    public static $backgroundCodes = [
        self::NORMAL => 49,
        self::BLACK => 40,
        self::RED => 41,
        self::GREEN => 42,
        self::YELLOW => 43,
        self::BLUE => 44,
        self::MAGENTA => 45,
        self::CYAN => 46,
        self::LIGHT_GRAY => 47,
        self::DARK_GRAY => 100,
        self::LIGHT_RED => 101,
        self::LIGHT_GREEN => 102,
        self::LIGHT_YELLOW => 103,
        self::LIGHT_BLUE => 104,
        self::LIGHT_MAGENTA => 105,
        self::LIGHT_CYAN => 106,
        self::WHITE => 107,
    ];

    /**
     * @param int $backgroundCode
     * @param string $default
     *
     * @return string
     */
    public static function getBackgroundName($backgroundCode, $default = null) {
        return array_get(array_flip(self::$backgroundCodes), $backgroundCode, $default);
    }

    /**
     * @param string $backgroundName
     * @param int $default
     *
     * @return int
     */
    public static function getBackgroundCode($backgroundName, $default = null) {
        return array_get(self::$backgroundCodes, $backgroundName, $default);
    }
}
