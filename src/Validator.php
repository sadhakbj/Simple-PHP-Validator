<?php

namespace Sadhakbj\Validator;

use Sadhakbj\Validator\Errors\ErrorBag;
use Sadhakbj\Validator\Rules\Email;
use Sadhakbj\Validator\Rules\Required;
use Sadhakbj\Validator\Rules\Rule;

class Validator
{
    protected array $rules = [];
    protected ErrorBag $errors;

    protected array $ruleMap = [
        'required' => Required::class,
        'email'    => Email::class,
    ];

    public function __construct(protected readonly array $data)
    {
        $this->errors = new ErrorBag();
    }

    public function setRules(array $rules): void
    {
        $this->rules = $rules;
    }

    public function validate(): bool
    {
        foreach ($this->rules as $inputField => $rules) {
            foreach ($this->resolveRules($rules) as $rule) {
                $this->validateRule($inputField, $rule);
            }
        }

        return $this->errors->hasErrors();
    }

    public function getFieldValue(string $field, array $data): mixed
    {
        return $data[$field] ?? null;
    }

    public function getErrors(): array
    {
        return $this->errors->getErrors();
    }

    private function resolveRules(array $rules)
    {
        return array_map(function ($rule) {
            if (is_string($rule)) {
                return $this->getRuleFromString($rule);
            }

            return $rule;
        }, $rules);
    }


    private function validateRule(string $field, Rule $rule): void
    {
        $value = $this->getFieldValue($field, $this->data);

        if (!$rule->passes($field, $value)) {
            $this->errors->add($field, $rule->message($field));
        }
    }

    private function getRuleFromString(string $rule)
    {
        return new $this->ruleMap[$rule]();
    }
}
