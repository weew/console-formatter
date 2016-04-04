<?php

namespace Weew\Cli\OutputFormatter;

interface IFormatParser {
    /**
     * @param string $string
     *
     * @return array
     */
    function parseFormat($string);

    /**
     * @param string $string
     *
     * @return array
     */
    function parseStyle($string);
}
