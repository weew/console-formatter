<?php

namespace Weew\ConsoleFormatter;

class ConsoleFormat {
    const NORMAL = 'normal';
    const BOLD = 'bold';
    const DIM = 'dim';
    const ITALIC = 'italic';
    const UNDERLINE = 'underline';
    const BLINK = 'blink';
    const REVERSE = 'reverse';
    const HIDDEN = 'hidden';
    const STRIKETHROUGH = 'strikethrough';

    /**
     * @var array
     */
    public static $formatCodes = [
        self::NORMAL => '21;22;23;24;25;27;28;29',
        self::BOLD => 1,
        self::DIM => 2,
        self::ITALIC => 3,
        self::UNDERLINE => 4,
        self::BLINK => 5,
        self::REVERSE => 7,
        self::HIDDEN => 8,
        self::STRIKETHROUGH => 9,
    ];

    /**
     * @param int $formatCode
     * @param string $default
     *
     * @return string
     */
    public static function getFormatName($formatCode, $default = null) {
        return array_get(array_flip(self::$formatCodes), $formatCode, $default);
    }

    /**
     * @param string $formatName
     * @param int $default
     *
     * @return int
     */
    public static function getFormatCode($formatName, $default = null) {
        return array_get(self::$formatCodes, $formatName, $default);
    }
}
