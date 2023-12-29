<?php

use Sadhakbj\Validator\Rules\Email;
use Sadhakbj\Validator\Rules\Required;

require_once dirname(__DIR__).'/vendor/autoload.php';


$data = [
    'name'  => 'Bijaya',
    'age'   => 25,
    'email' => 'abcd',
];

$validator = new \Sadhakbj\Validator\Validator($data);

$validator->setRules([
    'name'  => ['required', new Required()],
    'age'   => [new Required(), 'max:10'],
    'email' => ['required', new Email()],
]);

if ($validator->validate()) {
    dd('succeeded');
} else {
    dd($validator->getErrors());
}
