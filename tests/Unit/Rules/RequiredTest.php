<?php

use Sadhakbj\Validator\Rules\Required;

it('returns true is non empty value is passed', function () {
    $required = new Required();
    expect($required->passes('Name', 'Test Name'))->toBeTrue();
});

it('returns false is non empty value is passed', function () {
    $required = new Required();
    expect($required->passes('Name', ''))->toBeFalse();
});
