<?php

namespace Sadhakbj\Validator\Rules;

class Between implements RuleInterface
{
    public function __construct(private readonly int $min, private readonly int $max)
    {
    }

    public function message(string $field, array $options = []): string
    {
        return "$field must be between $this->min and $this->max.";
    }

    public function validate(string $field, mixed $value): bool
    {
        if (is_numeric($value)) {
            return $value >= $this->min && $value <= $this->max;
        }

        if (is_string($value)) {
            return mb_strlen($value) >= $this->min && mb_strlen($value) <= $this->max;
        }

        return false;
    }
}
