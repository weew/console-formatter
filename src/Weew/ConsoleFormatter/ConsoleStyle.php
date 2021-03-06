<?php

namespace Weew\ConsoleFormatter;

class ConsoleStyle implements IConsoleStyle {
    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $allowInheritance;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var string
     */
    protected $background;

    /**
     * @var array
     */
    protected $format;

    /**
     * @var IFormatParser
     */
    protected $formatParser;

    /**
     * ConsoleStyle constructor.
     *
     * @param string $name
     * @param string $color
     * @param string $background
     * @param string|array $format
     * @param bool $allowInheritance
     */
    public function __construct(
        $name,
        $color = null,
        $background = null,
        $format = null,
        $allowInheritance = false
    ) {
        $this->setName($name);
        $this->setColor($color);
        $this->setBackground($background);
        $this->setFormat($format);
        $this->allowInheritance($allowInheritance);

        $this->formatParser = $this->createFormatParser();
    }

    /**
     * @param string $style
     *
     * @return IConsoleStyle
     */
    public function parseStyle($style) {
        $groups = $this->formatParser->parseStyle($style);

        foreach ($groups as $group) {
            $type = $group[1];
            $value = $group[2];

            if (array_contains(['color', 'clr', 'fg'], $type)) {
                foreach (explode(',', $value) as $color) {
                    $this->setColor($color);
                }
            }

            if (array_contains(['background', 'bg'], $type)) {
                foreach (explode(',', $value) as $background) {
                    $this->setBackground($background);
                }
            }

            if (array_contains(['format', 'fmt'], $type)) {
                foreach (explode(',', $value) as $format) {
                    $this->addFormat($format);
                }
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getStyleCode() {
        $styleCodes = [];

        if ( ! $this->isAllowingInheritance()) {
            $styleCodes[] = 0;
        }

        $colorCode = ConsoleColor::getColorCode($this->getColor());

        if ($colorCode !== null) {
            $styleCodes[] = $colorCode;
        }

        $backgroundCode = ConsoleBackground::getBackgroundCode($this->getBackground());

        if ($backgroundCode !== null) {
            $styleCodes[] = $backgroundCode;
        }

        foreach ($this->getFormat() as $format) {
            $formatCode = ConsoleFormat::getFormatCode($format);

            if ($formatCode !== null) {
                $styleCodes[] = $formatCode;
            }
        }

        return implode(';', $styleCodes);
    }

    /**
     * @return bool
     */
    public function isAllowingInheritance() {
        return $this->allowInheritance;
    }

    /**
     * @param bool $allowInheritance
     *
     * @return IConsoleStyle
     */
    public function allowInheritance($allowInheritance) {
        $this->allowInheritance = !! $allowInheritance;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return IConsoleStyle
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * @param string $color
     *
     * @return IConsoleStyle
     */
    public function setColor($color) {
        $this->color = $color;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackground() {
        return $this->background;
    }

    /**
     * @param string $background
     *
     * @return IConsoleStyle
     */
    public function setBackground($background) {
        $this->background = $background;

        return $this;
    }

    /**
     * @return array
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * @param array|string $format
     *
     * @return IConsoleStyle
     */
    public function setFormat($format) {
        if ($format === null) {
            $format = [];
        } else if ( ! is_array($format)) {
            $format = [$format];
        }

        $this->format = $format;

        return $this;
    }

    /**
     * @param string $format
     *
     * @return IConsoleStyle
     */
    public function addFormat($format) {
        $this->format[] = $format;

        return $this;
    }

    /**
     * @return IFormatParser
     */
    protected function createFormatParser() {
        return new FormatParser();
    }
}
