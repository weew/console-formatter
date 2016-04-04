<?php

namespace Weew\Cli\OutputFormatter;

class FormatParser implements IFormatParser {
    /**
     * @param string $string
     *
     * @return array
     */
    public function parseFormat($string) {
        $groups = [];

        if (preg_match_all("#<[/]?(\w+)([\sa-z0-9=_;,]*)>#", $string, $matches, PREG_SET_ORDER) !== false) {
            $groups = $matches;
        }

        return $groups;
    }

    /**
     * @param string $string
     *
     * @return array
     */
    public function parseStyle($string) {
        $groups = [];

        if (preg_match_all("#([a-z]+)=([a-z,]+)#", $string, $matches, PREG_SET_ORDER) !== false) {
            $groups = $matches;
        }

        return $groups;
    }
}
