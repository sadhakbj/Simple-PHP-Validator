<?php

namespace Sadhakbj\Validator;

use Sadhakbj\Validator\Errors\ErrorBag;
use Sadhakbj\Validator\Rules\Rule;

class Validator
{
    protected ErrorBag $errors;

    public function __construct(
        protected readonly array $data,
        protected readonly array $rules,
        protected readonly array $aliases = []
    ) {
        $this->errors = new ErrorBag();
    }

    public function validate(): bool
    {
        foreach ($this->rules as $inputField => $rules) {
            foreach ($this->resolveRules($rules) as $rule) {
                $this->validateRule($inputField, $rule);
            }
        }

        return $this->hasErrors();
    }

    public function hasErrors(): bool
    {
        return count($this->errors->getErrors()) === 0;
    }

    public function getFieldValue(string $field, array $data): mixed
    {
        return $data[$field] ?? null;
    }

    public function getFieldName(string $field)
    {
        return $this->aliases[$field] ?? $field;
    }

    public function getErrors(): array
    {
        return $this->errors->getErrors();
    }

    public function newRuleFromMap(string $rule, $options)
    {
        return RuleMap::resolve($rule, $options);
    }

    private function resolveRules(array $rules): array
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
            $this->errors->push($field, $rule->message($this->getFieldName($field)));
        }
    }

    private function getRuleFromString(string $rule)
    {
        return $this->newRuleFromMap(
            ($exploded = explode(':', $rule))[0],
            explode(',', end($exploded))
        );
    }
}
