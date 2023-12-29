<?php

use Sadhakbj\Validator\Validator;

test('tests class validator returns true for the valid input', function () {
    $input     = ['name' => 'Bijaya', 'email' => 'apple@apple.com', 'age' => 16];
    $validator = new Validator($input, [
        'name'  => ['required'],
        'email' => ['email'],
        'age'   => ['between:15,20'],
    ], []);

    expect($validator->validate())->toBeTrue()->and($validator->getErrors())->toBeEmpty();
});

test('tests class validator returns false for the invalid input with respective errors', function () {
    $input     = ['name' => '', 'email' => 'apple@apple.com'];
    $validator = new Validator($input, [
        'name'  => ['required'],
        'email' => ['email'],
    ], ['name' => 'Name']);

    expect($validator->validate())->toBeFalse()->and($validator->getErrors())->toEqual(['name' => ['Name is required']]);
});
