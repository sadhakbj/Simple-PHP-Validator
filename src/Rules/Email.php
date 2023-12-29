<?php

namespace Sadhakbj\Validator\Rules;

class Email extends Rule
{

    public function message(string $field): string
    {
        return "$field must be a valid email";
    }

    public function passes(string $field, mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
