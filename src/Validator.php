<?php

namespace Sadhakbj\Validator;

use Sadhakbj\Validator\Errors\ErrorBag;
use Sadhakbj\Validator\Rules\RuleInterface;

class Validator
{
    protected ErrorBag $errors;

    public function __construct(
        protected readonly array $input,
        protected readonly array $rules,
        protected readonly array $aliases = []
    )
    {
        $this->errors = new ErrorBag();
    }

    public function validate(): bool
    {
        foreach ($this->rules as $inputField => $rules) {
            foreach ($this->resolveRules($rules) as $rule) {
                $value = $this->input[$inputField] ?? null;

                if (!$rule->validate($inputField, $value)) {
                    $this->errors->push($inputField,
                        $rule->message($this->aliases[$inputField] ?? $inputField)
                    );
                }
            }
        }

        return $this->hasErrors();
    }

    public function hasErrors(): bool
    {
        return count($this->errors->getErrors()) === 0;
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


    /**
     * Map through all input rules, convert the string rule to the rule class.
     * @return RuleInterface[]
     */
    private function resolveRules(array $rules): array
    {
        return array_map(function ($rule) {
            if (is_string($rule)) {
                return $this->getRuleFromString($rule);
            }

            return $rule;
        }, $rules);
    }

    private function getRuleFromString(string $rule)
    {
        return $this->newRuleFromMap(
            ($exploded = explode(':', $rule))[0],
            explode(',', end($exploded))
        );
    }
}
