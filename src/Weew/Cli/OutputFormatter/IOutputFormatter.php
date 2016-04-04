<?php

namespace Weew\Cli\OutputFormatter;

interface IOutputFormatter {
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
     * @return IOutputStyle
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
     * @return IOutputStyle[]
     */
    function getStyles();

    /**
     * @param $name
     *
     * @return IOutputStyle
     */
    function getStyle($name);

    /**
     * @param $name
     *
     * @return bool
     */
    function hasStyle($name);

    /**
     * @param IOutputStyle[] $styles
     */
    function setStyles(array $styles);

    /**
     * @param IOutputStyle[] $styles
     */
    function addStyles(array $styles);

    /**
     * @param IOutputStyle $style
     */
    function addStyle(IOutputStyle $style);
}
