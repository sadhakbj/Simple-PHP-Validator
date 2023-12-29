<?php

namespace Sadhakbj\Validator\Rules;

abstract class Rule
{

    abstract public function passes(string $field, mixed $value): bool;

    abstract public function message(string $field): string;
}
