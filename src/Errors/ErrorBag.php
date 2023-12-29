<?php

namespace Sadhakbj\Validator\Errors;

class ErrorBag
{
    /**
     * @var array<string, array<string>> Array to store validation errors.
     */
    protected array $errors = [];

    public function push(string $key, string $message): void
    {
        $this->errors[$key][] = $message;
    }

    /**
     * @return array<string, array<string>>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
