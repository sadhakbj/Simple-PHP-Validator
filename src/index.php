<?php

use Sadhakbj\Validator\Rules\Email;
use Sadhakbj\Validator\Rules\Max;
use Sadhakbj\Validator\Rules\Required;
use Sadhakbj\Validator\Validator;

require_once dirname(__DIR__).'/vendor/autoload.php';

$data = [
    'name'  => 'Bijaya',
    'age'   => 25,
    'email' => 'abcd',
];

$validator = new Validator($data);

$validator->setRules([
    'name'  => ['between:3,5'],
    'age'   => [new Required(), new Max(5), 'between:10,20'],
    'email' => ['required', new Email()],
]);

$validator->setAliases([
    'name' => 'Name',
    'age'  => 'Age',
]);

if ($validator->validate()) {
    echo 'Validation succeeded';
} else {
    foreach ($validator->getErrors() as $errors) {
        echo "<li>".($errors[0])."</li>";
    }
}
