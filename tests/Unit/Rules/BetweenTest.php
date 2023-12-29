<?php

use Sadhakbj\Validator\Rules\Between;

it('passes when the string length is within the limit', function () {
    $rule = new Between(2, 5);
    expect($rule->passes('field', 'abc'))->toBeTrue();
});

it('fails when the string length is not within the range', function () {
    $rule = new Between(3, 5);
    expect($rule->passes('field', 'ab'))->toBeFalse()->and($rule->passes('field', 'abcdef'))->toBeFalse();
});

it('passes when we pass a number between a range', function () {
    $rule = new Between(10, 15);
    expect($rule->passes('field', 11))->toBeTrue()->and($rule->passes('field', 15))->toBeTrue();
});

it('fails when we pass a number out of a range', function () {
    $rule = new Between(10, 15);
    expect($rule->passes('field', 9))->toBeFalse()->and($rule->passes('field', 16))->toBeFalse();
});
