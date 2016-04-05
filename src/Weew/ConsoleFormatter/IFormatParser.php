<?php

namespace Weew\ConsoleFormatter;

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

    /**
     * @param string $string
     *
     * @return string
     */
    function unescapeTags($string);
}
