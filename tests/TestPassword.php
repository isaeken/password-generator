<?php


use IsaEken\PasswordGenerator\PasswordGenerator;
use IsaEken\PasswordGenerator\Variables;
use PHPUnit\Framework\TestCase;

class TestPassword extends TestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function testSymbols()
    {
        $this->assertTrue(count((new Variables)->symbols()) > 0);
    }

    public function testNumbers()
    {
        $this->assertTrue(count((new Variables)->numbers()) > 0);
    }

    public function testUppercase()
    {
        $this->assertTrue(count((new Variables)->alphabet(true)) > 0);
    }

    public function testLowercase()
    {
        $this->assertTrue(count((new Variables)->alphabet(false)) > 0);
    }

    public function testSimilarities()
    {
        $this->assertTrue(count((new Variables)->similarities()) > 0);
    }

    public function testAmbiguous()
    {
        $this->assertTrue(count((new Variables)->ambiguous()) > 0);
    }

    public function testGenerateCharacter()
    {
        $passwordGenerator = new PasswordGenerator;
        $character = $passwordGenerator->character();
        $success = strlen($character) > 0;
        if ($success) $this->assertTrue(true, 'Generated character: '.$character);
        else $this->assertTrue(false, 'Character cannot be created!');
    }

    public function testGeneratePassword()
    {
        $passwordGenerator = new PasswordGenerator;
        $password = $passwordGenerator->generate();
        $success = strlen($password) > 0;
        if ($success) $this->assertTrue(true, 'Generated password: '.$password);
        else $this->assertTrue(false, 'Password length short than 1 characters!');
    }

    public function testGeneratePasswordBetween()
    {
        $passwordGenerator = new PasswordGenerator;
        $password = $passwordGenerator->generateBetween(3, 16);
        $success = strlen($password) > 0;
        if ($success) $this->assertTrue(true, 'Generated password: '.$password);
        else $this->assertTrue(false, 'Password length short than 1 characters!');
    }
}