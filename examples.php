<?php

use Weew\Cli\OutputFormatter\OutputBackground;
use Weew\Cli\OutputFormatter\OutputColor;
use Weew\Cli\OutputFormatter\OutputFormat;
use Weew\Cli\OutputFormatter\OutputFormatter;

require 'vendor/autoload.php';

$formatter = new OutputFormatter();

$formatter->style('error')
    ->setColor(OutputColor::WHITE)
    ->setBackground(OutputBackground::RED);

$formatter->style('warning')
    ->setColor(OutputColor::WHITE)
    ->setBackground(OutputBackground::YELLOW);

$formatter->style('important')
    ->setColor(OutputColor::WHITE)
    ->setBackground(OutputBackground::CYAN)
    ->setFormat([OutputFormat::BOLD, OutputFormat::UNDERLINE]);

echo $formatter->format(<<<STRING

<style fg=red bg=blue>red text with blue background</style>

<error fmt=bold>bold error text</error>
<warning>warning text</warning>
<important>important text</important>

<style bg=white fg=red>here is an <unknown>unknown</unknown> style tag</style>

sample <error>error with an <important>important <warning>warning</warning></important></error> text

STRING
);
