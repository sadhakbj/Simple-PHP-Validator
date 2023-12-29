<?php

namespace Sadhakbj\Validator\Rules;

class Required extends Rule
{
    public function message(string $field): string
    {
        return "$field is required";
    }

    public function passes(string $field, mixed $value): bool
    {
        return !empty(trim($value));
    }
}
