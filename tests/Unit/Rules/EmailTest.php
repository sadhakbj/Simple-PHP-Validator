<?php

use Sadhakbj\Validator\Rules\Email;

it('passes when the valid email is passed', function () {
    $rule = new Email();
    expect($rule->validate('email', 'john@example.com'))->toBeTrue();
});

it('fails when the invalid email is passed', function () {
    $rule = new Email();
    expect($rule->validate('email', 'john@'))->toBeFalse()->and($rule->message('email'))->toBe(('email must be a valid email'));
});
