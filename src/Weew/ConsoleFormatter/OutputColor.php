<?php

namespace Weew\ConsoleFormatter;

class OutputColor {
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
    public static $colorCodes = [
        self::NORMAL => 39,
        self::BLACK => 30,
        self::RED => 31,
        self::GREEN => 32,
        self::YELLOW => 33,
        self::BLUE => 34,
        self::MAGENTA => 35,
        self::CYAN => 36,
        self::LIGHT_GRAY => 37,
        self::DARK_GRAY => 90,
        self::LIGHT_RED => 91,
        self::LIGHT_GREEN => 92,
        self::LIGHT_YELLOW => 93,
        self::LIGHT_BLUE => 94,
        self::LIGHT_MAGENTA => 95,
        self::LIGHT_CYAN => 96,
        self::WHITE => 97,
    ];

    /**
     * @param int $colorCode
     * @param string $default
     *
     * @return string
     */
    public static function getColorName($colorCode, $default = null) {
        return array_get(array_flip(self::$colorCodes), $colorCode, $default);
    }

    /**
     * @param string $colorName
     * @param int $default
     *
     * @return int
     */
    public static function getColorCode($colorName, $default = null) {
        return array_get(self::$colorCodes, $colorName, $default);
    }
}
