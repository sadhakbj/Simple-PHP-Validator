<?php

namespace Sadhakbj\Validator\Rules;

class Max implements RuleInterface
{
    public function __construct(private readonly int $length)
    {
    }

    public function message(string $field, array $options = []): string
    {
        return "$field must not greater than $this->length";
    }

    public function validate(string $field, mixed $value): bool
    {
        if (is_array($value)) {
            return count($value) <= $this->length;
        }

        return mb_strlen($value) <= $this->length;
    }
}
