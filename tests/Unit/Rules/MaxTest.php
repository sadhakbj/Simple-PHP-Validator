<?php

use Sadhakbj\Validator\Rules\Max;

it('passes when the string length is within the limit', function () {
    $rule = new Max(5);
    expect($rule->validate('field', 'abc'))->toBeTrue();
});

it('fails when the string length exceeds the limit', function () {
    $rule = new Max(5);
    expect($rule->validate('field', 'abcdef'))->toBeFalse();
});

it('passes when the array length is within the limit', function () {
    $rule = new Max(5);
    expect($rule->validate('field', range(1, 3)))->toBeTrue()->and($rule->validate('field', range(1, 5)));
});

it('passes when the array length is greater the limit', function () {
    $rule = new Max(5);
    expect($rule->validate('field', range(1, 6)))->toBeFalse();
});
