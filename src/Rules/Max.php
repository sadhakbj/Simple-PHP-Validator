<?php

namespace Sadhakbj\Validator\Rules;

class Max extends Rule
{
    public function __construct(private readonly int $length)
    {
    }

    public function message(string $field): string
    {
        return "$field must not greater than $this->length";
    }

    public function passes(string $field, mixed $value): bool
    {
        if (is_array($value)) {
            return count($value) <= $this->length;
        }

        return mb_strlen($value) <= $this->length;
    }
}
