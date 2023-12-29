# Simple PHP Validator

A simple validator is a lightweight PHP validation library written in modern PHP 8. It provides a simple and expressive way to validate data using a fluent interface. The library uses Pest for unit testing.

## Installation

```bash
composer require sadhakbj/validator
```

## Quick Start

```php
<?php

require_once 'vendor/autoload.php';

use Sadhakbj\Validator\Rules\Required;
use Sadhakbj\Validator\Rules\Email;

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
    dd('Validation succeeded');
} else {
    dd($validator->getErrors());
}
```

## Usage

1. Create a `Validator` instance with your data.
2. Set validation rules using the `setRules` method.
3. Use the `validate` method to check if the data is valid.
4. Access validation errors using the `getErrors` method.

## Example

```php
// ... (Same as Quick Start)

if ($validator->validate()) {
    dd('Validation succeeded');
} else {
    dd($validator->getErrors());
}
```

In case of validation failure, `getErrors` returns an associative array with field names as keys and an array of error messages as values.

## Contributing

Feel free to contribute by opening issues or submitting pull requests on [GitHub](https://github.com/sadhakbj/Simple-PHP-Validator).

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
```
