<?php

namespace Sadhakbj\Validator\Errors;

class ErrorBag
{
    /**
     * @var array Array to store validation errors.
     */
    protected array $errors = [];

    public function push(string $key, string $message): void
    {
        $this->errors[$key][] = $message;
    }

    /**
     * @return array<string, string[]>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
