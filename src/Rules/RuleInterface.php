<?php

namespace Sadhakbj\Validator\Rules;

interface RuleInterface
{
    public function validate(string $field, mixed $value): bool;

    public function message(string $field, array $options = []): string;
}
