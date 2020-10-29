<?php


use IsaEken\PasswordGenerator\Converters\RememberableToPassword;
use IsaEken\PasswordGenerator\PasswordGenerator;
use IsaEken\PasswordGenerator\Variables;
use IsaEken\PasswordGenerator\Converters\PasswordToRememberable;
use PHPUnit\Framework\TestCase;

class TestConverters extends TestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function testPasswordToRememberableEnglish()
    {
        $passwordToRememberable = new PasswordToRememberable;
        $passwordToRememberable->password = 'pa5swOrd';
        $rememberable = $passwordToRememberable->convert();
        $this->assertTrue(strlen($rememberable) > 0);
    }

    public function testRememberableToPasswordEnglish()
    {
        $rememberableToPassword = new RememberableToPassword;
        $rememberableToPassword->rememberable = ' page  architecture  5  safe  walk  OFFENSE  range  dance ';
        $password = $rememberableToPassword->convert();
        $this->assertTrue(strlen($password) > 0);
    }

    public function testPasswordToRememberableTurkish()
    {
        $passwordToRememberable = new PasswordToRememberable;
        $passwordToRememberable->setLanguage('tr');
        $passwordToRememberable->password = 'pa5swOrd';
        $rememberable = $passwordToRememberable->convert();
        $this->assertTrue(strlen($rememberable) > 0);
    }

    public function testRememberableToPasswordTurkish()
    {
        $rememberableToPassword = new RememberableToPassword;
        $rememberableToPassword->rememberable = ' pano  açıklama  5  selanik  w  OKYANUS  rüzgar  devrim ';
        $password = $rememberableToPassword->convert();
        $this->assertTrue(strlen($password) > 0);
    }
}
