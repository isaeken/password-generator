<?php
/**
 * @author İsa Eken <hello@isaeken.com.tr>
 * @link https://www.isaeken.com.tr
 * @version 1.0.0
 * @license MIT
 * @see https://www.github.com/isaeken/password-generator/README.md
 */

if (PHP_SAPI !== 'cli') return;

use IsaEken\PasswordGenerator\Converters\PasswordToRememberable;
use IsaEken\PasswordGenerator\PasswordGenerator;
use League\CLImate\CLImate;

require_once __DIR__.'/../vendor/autoload.php';

$climate = new CLImate;
$passwordGenerator = new PasswordGenerator;

$climate->arguments->add([
    'length' => [
        'prefix' => 'l',
        'longPrefix' => 'length',
        'description' => 'Password Length',
        'defaultValue' => 16,
        'castTo' => 'int',
    ],
    'symbols' => [
        'prefix' => 's',
        'longPrefix' => 'symbols',
        'description' => 'Include symbols',
        'defaultValue' => '0',
        'castTo' => 'bool',
    ],
    'numbers' => [
        'prefix' => 'n',
        'longPrefix' => 'numbers',
        'description' => 'Include numbers',
        'defaultValue' => '1',
        'castTo' => 'bool',
    ],
    'lowercase' => [
        'prefix' => 'L',
        'longPrefix' => 'lowercase',
        'description' => 'Include lowercase characters',
        'defaultValue' => '1',
        'castTo' => 'bool',
    ],
    'uppercase' => [
        'prefix' => 'U',
        'longPrefix' => 'uppercase',
        'description' => 'Include uppercase characters',
        'defaultValue' => '1',
        'castTo' => 'bool',
    ],
    'similar' => [
        'prefix' => 'S',
        'longPrefix' => 'similar',
        'description' => 'Include similar characters',
        'defaultValue' => '0',
        'castTo' => 'bool',
    ],
    'ambiguous' => [
        'prefix' => 'a',
        'longPrefix' => 'ambiguous',
        'description' => 'Include ambiguous characters',
        'defaultValue' => '0',
        'castTo' => 'bool',
    ],
    'rememberable' => [
        'prefix' => 'r',
        'longPrefix' => 'rememberable',
        'description' => 'Add rememberable string to output',
        'defaultValue' => '0',
        'castTo' => 'bool',
    ],
    'rememberableLanguage' => [
        'prefix' => 'rl',
        'longPrefix' => 'rememberLanguage',
        'description' => 'Rememberable string convert language',
        'defaultValue' => 'en',
        'castTo' => 'string',
    ],
    'interface' => [
        'prefix' => 'i',
        'longPrefix' => 'interface',
        'description' => 'Enable interface',
        'defaultValue' => '0',
        'castTo' => 'bool',
    ],
    'help' => [
        'longPrefix'  => 'help',
        'description' => 'Prints a usage statement',
        'noValue'     => 'true',
    ],
]);
$climate->description('A password generation tool');
$climate->arguments->parse();

if ($climate->arguments->get('help'))
{
    $climate->usage();
    return;
}

if (!$climate->arguments->get('interface'))
{
    $passwordGenerator->length      = (int) $climate->arguments->get('length');
    $passwordGenerator->symbols     = (bool) $climate->arguments->get('symbols');
    $passwordGenerator->numbers     = (bool) $climate->arguments->get('numbers');
    $passwordGenerator->lowercase   = (bool) $climate->arguments->get('lowercase');
    $passwordGenerator->uppercase   = (bool) $climate->arguments->get('uppercase');
    $passwordGenerator->similar     = (bool) $climate->arguments->get('similar');
    $passwordGenerator->ambiguous   = (bool) $climate->arguments->get('ambiguous');
    $password = $passwordGenerator->generate();
    $rememberable = null;

    if ((bool) $climate->arguments->get('rememberable'))
    {
        $passwordToRememberable = new PasswordToRememberable;
        $passwordToRememberable->setLanguage($climate->arguments->get('rememberableLanguage'));
        $passwordToRememberable->password = $password;
        $rememberable = $passwordToRememberable->convert();
    }

    $result = (object) [
        'password' => $password,
        'rememberable' => $rememberable,
    ];

    return print_r($result);
}

$climate->br();
$climate->whisper()->bold()->out('Password Generator');
$climate->out('Created by İsa Eken');
$climate->br();
$climate->out('Visit here to more projects: https://www.github.com/isaeken');
$climate->br();

$input = $climate->input('Password length (16)');
$input->accept(function ($response) {
    return ctype_digit($response);
});
$input->defaultTo('16');
$passwordGenerator->length = $input->prompt();

$input = $climate->input('Include symbols? [y, n] (n)');
$input->accept(['y', 'n']);
$input->defaultTo('n');
$passwordGenerator->symbols = $input->prompt() == 'y';

$input = $climate->input('Include numbers? [y, n] (y)');
$input->accept(['y', 'n']);
$input->defaultTo('y');
$passwordGenerator->numbers = $input->prompt() == 'y';

$input = $climate->input('Include lowercase? [y, n] (y)');
$input->accept(['y', 'n']);
$input->defaultTo('y');
$passwordGenerator->lowercase = $input->prompt() == 'y';

$input = $climate->input('Include uppercase? [y, n] (y)');
$input->accept(['y', 'n']);
$input->defaultTo('y');
$passwordGenerator->uppercase = $input->prompt() == 'y';

$input = $climate->input('Include similar characters? [y, n] (n)');
$input->accept(['y', 'n']);
$input->defaultTo('n');
$passwordGenerator->similar = $input->prompt() == 'y';

$input = $climate->input('Include ambiguous? [y, n] (n)');
$input->accept(['y', 'n']);
$input->defaultTo('n');
$passwordGenerator->ambiguous = $input->prompt() == 'y';

$input = $climate->input('Remember language ? [en, tr] (en)');
$input->accept(['en', 'tr']);
$input->defaultTo('en');
$rememberLanguage = $input->prompt();

$password = $passwordGenerator->generate();

$climate->br();
$climate->green()->inline('Generated password: ');
$climate->backgroundBlack()->white()->out($password);

$passwordToRememberable = new PasswordToRememberable;
$passwordToRememberable->setLanguage($rememberLanguage);
$passwordToRememberable->password = $password;
$climate->green()->inline('Rememberable: ');
$climate->backgroundBlack()->white()->out($passwordToRememberable->convert());

return $password;
