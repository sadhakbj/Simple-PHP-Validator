<?php

namespace Sadhakbj\Validator;

use Sadhakbj\Validator\Rules\{Between, Email, Max, Required};

class RuleMap
{
    protected static array $ruleMap = [
        'required' => Required::class,
        'email'    => Email::class,
        'max'      => Max::class,
        'between'  => Between::class,
    ];

    public static function resolve(string $rule, array $options)
    {
        return new static::$ruleMap[$rule](...$options);
    }
}
