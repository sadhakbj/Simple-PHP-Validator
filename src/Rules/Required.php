<?php

namespace Sadhakbj\Validator\Rules;

class Required implements RuleInterface
{
    public function message(string $field, array $options = []): string
    {
        return "$field is required";
    }

    public function validate(string $field, mixed $value): bool
    {
        return !empty(trim($value));
    }
}
