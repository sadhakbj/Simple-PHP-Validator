<?php

use Sadhakbj\Validator\Validator;

test('tests class validator returns true for the valid input', function () {
    $input     = ['name' => 'Bijaya', 'email' => 'apple@apple.com'];
    $validator = new Validator($input);
    $validator->setRules([
        'name'  => ['required'],
        'email' => ['email'],
    ]);

    expect($validator->validate())->toBeTrue()->and($validator->getErrors())->toBeEmpty();
});


test('tests class validator returns false for the invalid input with respective errors', function () {
    $input     = ['name' => '', 'email' => 'apple@apple.com'];
    $validator = new Validator($input);
    $validator->setRules([
        'name'  => ['required'],
        'email' => ['email'],
    ]);

    expect($validator->validate())->toBeFalse()->and($validator->getErrors())->toEqual(['name' => ['name is required']]);
});
