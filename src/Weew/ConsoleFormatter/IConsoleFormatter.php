<?php

namespace Weew\ConsoleFormatter;

interface IConsoleFormatter {
    /**
     * @param string $string
     *
     * @return string
     */
    function format($string);

    /**
     * @param string $string
     *
     * @return string
     */
    function formatAnsi($string);

    /**
     * @param string $string
     *
     * @return string
     */
    function formatPlain($string);

    /**
     * @param string $name
     * @param string $color
     * @param string $background
     * @param string $format
     * @param bool $allowInheritance
     *
     * @return IConsoleStyle
     */
    function style($name, $color = null, $background = null, $format = null, $allowInheritance = null);

    /**
     * @return bool
     */
    function isAnsiEnabled();

    /**
     * @param bool $enableAnsi
     */
    function setEnableAnsi($enableAnsi);

    /**
     * @return IConsoleStyle[]
     */
    function getStyles();

    /**
     * @param $name
     *
     * @return IConsoleStyle
     */
    function getStyle($name);

    /**
     * @param $name
     *
     * @return bool
     */
    function hasStyle($name);

    /**
     * @param IConsoleStyle[] $styles
     */
    function setStyles(array $styles);

    /**
     * @param IConsoleStyle[] $styles
     */
    function addStyles(array $styles);

    /**
     * @param IConsoleStyle $style
     */
    function addStyle(IConsoleStyle $style);
}
