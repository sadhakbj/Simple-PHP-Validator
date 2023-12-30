<?php

namespace Sadhakbj\Validator\Rules;

class Email implements RuleInterface
{
    public function message(string $field, array $options = []): string
    {
        return "$field must be a valid email";
    }

    public function validate(string $field, mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
