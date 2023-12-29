<?php

namespace Sadhakbj\Validator;

use Sadhakbj\Validator\Errors\ErrorBag;
use Sadhakbj\Validator\Rules\Rule;

class Validator
{
    protected array $rules = [];

    protected ErrorBag $errors;
    protected array $aliases;

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

    public function setAliases(array $aliases)
    {
        $this->aliases = $aliases;
    }

    public function getFieldValue(string $field, array $data): mixed
    {
        return $data[$field] ?? null;
    }

    public function getAlias(string $field)
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
            $this->errors->add($field, $rule->message($this->getAlias($field)));
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
