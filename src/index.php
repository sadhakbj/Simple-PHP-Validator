<?php

use Sadhakbj\Validator\Rules\Between;
use Sadhakbj\Validator\Rules\Email;
use Sadhakbj\Validator\Rules\Max;
use Sadhakbj\Validator\Rules\Required;
use Sadhakbj\Validator\Validator;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$data = [
    'name' => 'Bijaya',
    'age' => 25,
    'email' => 'abcd',
];

$rules = [
    'name' => ['between:3,5'],
    'age' => [new Required(), new Max(5), new Between(3, 5)],
    'email' => ['required', new Email()],
];

$aliases = [
    'name' => 'Name',
    'age' => 'Age',
];

$validator = new Validator(data: $data, rules: $rules, aliases: $aliases);
if ($validator->validate()) {
    echo 'Validation succeeded';
} else {
    foreach ($validator->getErrors() as $errors) {
        echo "<li>" . ($errors[0]) . "</li>";
    }
}
