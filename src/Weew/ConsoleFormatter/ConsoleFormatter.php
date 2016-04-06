<?php

namespace Weew\ConsoleFormatter;

class ConsoleFormatter implements IConsoleFormatter {
    /**
     * @var IConsoleStyle[]
     */
    protected $styles = [];

    /**
     * @var IFormatParser
     */
    protected $formatParser;

    /**
     * @var bool
     */
    protected $enableAnsi;

    /**
     * ConsoleFormatter constructor.
     *
     * @param IConsoleStyle[] $styles
     * @param bool $enableAnsi
     */
    public function __construct(array $styles = [], $enableAnsi = true) {
        $this->setStyles($styles);
        $this->setEnableAnsi($enableAnsi);

        $this->formatParser = $this->createFormatParser();
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function format($string) {
        if ($this->isAnsiEnabled()) {
            return $this->formatAnsi($string);
        }

        return $this->formatPlain($string);
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function formatAnsi($string) {
        $styleStack = [];

        // match all tags like <tag> and </tag>
        $groups = $this->formatParser->parseFormat($string);

        foreach ($groups as $group) {
            $tag = $group[0]; // <tag> or </tag>
            $styleName = $group[1]; // tag
            $stylesString = $group[2]; // stuff like color=red

            // do not process unknown style tags
            if ($styleName !== 'style' && ! $this->hasStyle($styleName)) {
                continue;
            }

            // is this a closing tag?
            if (stripos($tag, '/') !== false) {
                // get previous style
                array_pop($styleStack);
                $styleCode = array_last($styleStack);

                if ( ! $styleCode) {
                    $styleCode = 0;
                }
            } else {
                if ($styleName === 'style') {
                    $style = new ConsoleStyle('style');
                } else {
                    $style = $this->getStyle($styleName);
                }

                if ($style instanceof IConsoleStyle) {
                    // clone style to prevent unwanted
                    // modification on future uses
                    $style = clone $style;
                    $style->parseStyle($stylesString);
                    $styleCode = $style->getStyleCode();
                }

                $styleStack[] = $styleCode;
            }

            // replace first matching tag with the escape sequence;
            $pattern = s('#%s#', preg_quote($tag));
            $escapeSequence = s("\e[%sm", $styleCode);

            $string = preg_replace($pattern, $escapeSequence, $string, 1);
        }

        $string = $this->formatParser->unescapeTags($string);

        return $string;
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function formatPlain($string) {
        $groups = $this->formatParser->parseFormat($string);

        foreach ($groups as $group) {
            $tag = $group[0];
            $styleName = $group[1];

            if ($styleName === 'style' || $this->hasStyle($styleName)) {
                $string = str_replace($tag, '', $string);
            }
        }

        $string = $this->formatParser->unescapeTags($string);

        return $string;
    }

    /**
     * @param string $name
     * @param string $color
     * @param string $background
     * @param string|array $format
     * @param bool $allowInheritance
     *
     * @return IConsoleStyle
     */
    public function style($name, $color = null, $background = null, $format = null, $allowInheritance = null) {
        $style = new ConsoleStyle($name, $color, $background, $format, $allowInheritance);
        $this->addStyle($style);

        return $style;
    }

    /**
     * @return bool
     */
    public function isAnsiEnabled() {
        return $this->enableAnsi;
    }

    /**
     * @param bool $enableAnsi
     */
    public function setEnableAnsi($enableAnsi) {
        $this->enableAnsi = ! ! $enableAnsi;
    }

    /**
     * @return IConsoleStyle[]
     */
    public function getStyles() {
        return $this->styles;
    }

    /**
     * @param IConsoleStyle[] $styles
     */
    public function setStyles(array $styles) {
        $this->styles = [];
        $this->addStyles($styles);
    }

    /**
     * @param string $name
     *
     * @return IConsoleStyle
     */
    public function getStyle($name) {
        return array_get($this->getStyles(), $name);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasStyle($name) {
        return array_has($this->getStyles(), $name);
    }

    /**
     * @param IConsoleStyle[] $styles
     */
    public function addStyles(array $styles) {
        foreach ($styles as $style) {
            $this->addStyle($style);
        }
    }

    /**
     * @param IConsoleStyle $style
     */
    public function addStyle(IConsoleStyle $style) {
        $this->styles[$style->getName()] = $style;
    }

    /**
     * @return IFormatParser
     */
    protected function createFormatParser() {
        return new FormatParser();
    }
}
