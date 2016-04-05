<?php

namespace Weew\ConsoleFormatter;

interface IOutputStyle {
    /**
     * @param string $style
     *
     * @return IOutputStyle
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
     * @return IOutputStyle
     */
    function setName($name);

    /**
     * @return bool
     */
    function isAllowingInheritance();

    /**
     * @param bool $allowInheritance
     *
     * @return IOutputStyle
     */
    function allowInheritance($allowInheritance);

    /**
     * @return string
     */
    function getColor();

    /**
     * @param string $color
     *
     * @return IOutputStyle
     */
    function setColor($color);

    /**
     * @return string
     */
    function getBackground();

    /**
     * @param string $background
     *
     * @return IOutputStyle
     */
    function setBackground($background);

    /**
     * @return array
     */
    function getFormat();

    /**
     * @param array|string $format
     *
     * @return IOutputStyle
     */
    function setFormat($format);

    /**
     * @param string $format
     *
     * @return IOutputStyle
     */
    function addFormat($format);
}
