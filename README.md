# Password Generator

![Travis (.org)](https://img.shields.io/travis/isaeken/password-generator) ![Libraries.io dependency status for GitHub repo](https://img.shields.io/librariesio/github/isaeken/password-generator) ![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/isaeken/password-generator) ![Lines of code](https://img.shields.io/tokei/lines/github/isaeken/password-generator) ![GitHub](https://img.shields.io/github/license/isaeken/password-generator) ![GitHub followers](https://img.shields.io/github/followers/isaeken?style=social)

## Installation
- Clone the repository
``git clone https://github.com/isaeken/password-generator.git``
- Install packages using composer
``composer install``

## Using with CLI
- Activate interface
``php bin/cli.php --interface=1``
- Usage
``php bin/cli.php [arguments]``

## Using in your code
### Add to your project using composer
````shell script
composer require isaeken/password-generator
````
### Initialize password generator
````php
use IsaEken\PasswordGenerator\PasswordGenerator;
$passwordGenerator = new PasswordGenerator;
````

### Generate password with default options
````php
$password = $passwordGenerator->generate();
````

### Generate password with custom length
````php
$password = $passwordGenerator->generate(16);
````

### Generate password with custom options
using arguments
````php
$password = $passwordGenerator->generate([
	'length' => 16,
	'numbers' => false,
]);
````
or variables
````php
$passwordGenerator->length = 16;
$passwordGenerator->numbers = false;
$password = $passwordGenerator->generate();
````
or chain functions
````php
$password = $passwordGenerator->setLength(16)->setNumbers(false)->generate();
````

### Generate a character
````php
$character = $passwordGenerator->character();
````

### Generate password between lengths
````php
$password = $passwordGenerator->generateBetween(3, 6);
````

## Variables and functions
````php
// variables
$passwordGenerator->length : int;
$passwordGenerator->symbols: bool;
$passwordGenerator->numbers: bool;
$passwordGenerator->lowercase : bool;
$passwordGenerator->uppercase: bool;
$passwordGenerator->similar: bool;
$passwordGenerator->ambiguous: bool;
$passwordGenerator->variables: IsaEken\PasswordGenerator\Variables;

// functions
$passwordGenerator->__construct(?array $options = null);
$passwordGenerator->setLength(int $length = 16) : PasswordGenerator;
$passwordGenerator->setSymbols(bool $symbols = true) : PasswordGenerator;
$passwordGenerator->setNumbers(bool $numbers = true) : PasswordGenerator;
$passwordGenerator->setLowercase(bool $lowercase = true) : PasswordGenerator;
$passwordGenerator->setUppercase(bool $uppercase = true) : PasswordGenerator;
$passwordGenerator->setSimilar(bool $similar = false) : PasswordGenerator;
$passwordGenerator->setAmbiguous(bool $ambiguous = false) : PasswordGenerator;
$passwordGenerator->character() : string;
$passwordGenerator->generate(?int $length = null) : string;
$passwordGenerator->generateBetween(int $min, int $max) : string;
````

## Converters
### Password to rememberable string converter
````php
use IsaEken\PasswordGenerator\Converters\PasswordToRememberable;
$passwordToRememberable = new PasswordToRememberable;
$passwordToRememberable->setLanguage('tr');
$passwordToRememberable->password = 'pa5swOrd';
$rememberableString = $passwordToRememberable->convert();
````
### Rememberable string to password converter
````php
use IsaEken\PasswordGenerator\Converters\RememberableToPassword;
$rememberableToPassword = new RememberableToPassword;
$rememberableToPassword->rememberable = ' pano  açıklama  5  selanik  w  OKYANUS  rüzgar  devrim ';
$password = $rememberableToPassword->convert();
````