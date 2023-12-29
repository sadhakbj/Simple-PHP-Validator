<?php

use Sadhakbj\Validator\Rules\Email;
use Sadhakbj\Validator\Rules\Required;
use Sadhakbj\Validator\Validator;

require_once dirname(__DIR__).'/vendor/autoload.php';

$data = [
    'name'      => 'Bijaya',
    'age'       => 25,
    'email'     => 'abcd',
];

$validator = new Validator($data);

$validator->setRules([
    'name'     => ['required', new Required()],
    'age'      => [new Required(), 'max:10'],
    'email'    => ['required', new Email()],
]);

if ($validator->validate()) {
    echo 'Validation succeeded';
} else {
    dump($validator->getErrors());
}
