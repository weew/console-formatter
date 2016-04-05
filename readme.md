# Output Formatter for command line

[![Build Status](https://img.shields.io/travis/weew/php-console-formatter.svg)](https://travis-ci.org/weew/php-console-formatter)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/php-console-formatter.svg)](https://scrutinizer-ci.com/g/weew/php-console-formatter)
[![Test Coverage](https://img.shields.io/coveralls/weew/php-console-formatter.svg)](https://coveralls.io/github/weew/php-console-formatter)
[![Version](https://img.shields.io/packagist/v/weew/php-console-formatter.svg)](https://packagist.org/packages/weew/php-console-formatter)
[![Licence](https://img.shields.io/packagist/l/weew/php-console-formatter.svg)](https://packagist.org/packages/weew/php-console-formatter)

## Table of contents

## Installation

`composer require weew/php-console-formatter`

## Introduction

This package allows you to format text for terminal, using very simple and html like syntax. You will be able to change *text color*, *text background* and *text format*.

This package **has not been tested on windows** and I do not intend to do so. Contributions for windows support are highly appreciated.

## Adding styles

Before you'll be able to use styles, you must created them first.

```php
$formatter = new ConsoleFormatter();

$style = (new OutputStyle('alert'))
    ->setColor(OutputColor::WHITE)
    ->setBackground(OutputBackground::RED)
    ->setFormat([OutputFormat::BOLD, OutputFormat::UNDERLINE]);
$formatter->addStyle($style);

// or

$formatter->style('alert')
    ->setColor(OutputColor::WHITE)
    ->setBackground(OutputBackground::RED)
    ->setFormat([OutputFormat::BOLD, OutputFormat::UNDERLINE]);

// or

$formatter->style('alert')
    ->parseStyle('clr=white bg=red fmt=bold,underline');
```

## Using styles

As soon as you've register a style, it will be applied to matching tags. If a style is unknown, the tag will be ignored. Example below will output properly formatted text.

```php
echo $formatter->format('<alert>text</alert>');
```

## Using inline styles

You can apply styling inline, without having to register a new style. To do that you must use the `<style></style>` tag.

```php
echo $formatter->format('<style clr=red bg=white>red text on white background</style>');
```

You can also use inline styling on predefined styles.

```php
$formatter->format('<alert clr=yellow>alert style with yellow text</alert>');
```

## Style isolation

Whenever you have nested styles, one style might inherit from the parent. This is disabled by default to prevent unwanted styles changes. You can enable it for each style separately.

 ```php
 $formatter->style('name')
    ->setAllowInheritance(true);
 ```

## Disabling ANSI

If you're working with a terminal that does not support ANSI, you can disable formatting. All known style tags will be removed from the string.

```php
$formatter->setEnableAnsi(false);
// will return: alert <unknown>tag</unknown>
$formatter->format('<style clr=red><alert>alert <unknown>tag</unknown></alert></style>');
```

## Examples

You can run the `examples.php` file to see if it works on your system.
