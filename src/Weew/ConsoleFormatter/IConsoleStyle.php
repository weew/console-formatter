<?php

namespace Weew\ConsoleFormatter;

interface IConsoleStyle {
    /**
     * @param string $style
     *
     * @return IConsoleStyle
     */
    function parseStyle($style);

    /**
     * @return string
     */
    function getStyleCode();

    /**
     * @return string
     */
    function getName();

    /**
     * @param string $name
     *
     * @return IConsoleStyle
     */
    function setName($name);

    /**
     * @return bool
     */
    function isAllowingInheritance();

    /**
     * @param bool $allowInheritance
     *
     * @return IConsoleStyle
     */
    function allowInheritance($allowInheritance);

    /**
     * @return string
     */
    function getColor();

    /**
     * @param string $color
     *
     * @return IConsoleStyle
     */
    function setColor($color);

    /**
     * @return string
     */
    function getBackground();

    /**
     * @param string $background
     *
     * @return IConsoleStyle
     */
    function setBackground($background);

    /**
     * @return array
     */
    function getFormat();

    /**
     * @param array|string $format
     *
     * @return IConsoleStyle
     */
    function setFormat($format);

    /**
     * @param string $format
     *
     * @return IConsoleStyle
     */
    function addFormat($format);
}
