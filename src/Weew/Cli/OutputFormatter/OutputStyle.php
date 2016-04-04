<?php

namespace Weew\Cli\OutputFormatter;

class OutputStyle implements IOutputStyle {
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
     * OutputStyle constructor.
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
     * @return IOutputStyle
     */
    public function parseStyle($style) {
        $groups = $this->formatParser->parseStyle($style);

        foreach ($groups as $group) {
            $type = $group[1];
            $value = $group[2];

            if (in_array($type, ['color', 'clr', 'fg'])) {
                foreach (explode(',', $value) as $color) {
                    $this->setColor($color);
                }
            }

            if (in_array($type, ['background', 'bg'])) {
                foreach (explode(',', $value) as $background) {
                    $this->setBackground($background);
                }
            }

            if (in_array($type, ['format', 'fmt'])) {
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

        $colorCode = OutputColor::getColorCode($this->getColor());

        if ($colorCode !== null) {
            $styleCodes[] = $colorCode;
        }

        $backgroundCode = OutputBackground::getBackgroundCode($this->getBackground());

        if ($backgroundCode !== null) {
            $styleCodes[] = $backgroundCode;
        }

        foreach ($this->getFormat() as $format) {
            $formatCode = OutputFormat::getFormatCode($format);

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
     * @return IOutputStyle
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
     * @return IOutputStyle
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
     * @return IOutputStyle
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
     * @return IOutputStyle
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
     * @return IOutputStyle
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
     * @return IOutputStyle
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
