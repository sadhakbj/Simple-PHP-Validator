<?php

namespace Sadhakbj\Validator\Errors;

class ErrorBag
{
    protected array $errors = [];

    public function add(string $key, string $message): void
    {
        $this->errors[$key][] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) === 0;
    }
}
