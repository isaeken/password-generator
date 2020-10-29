<?php


namespace IsaEken\PasswordGenerator\Converters;


use Exception;
use IsaEken\PasswordGenerator\Languages\EnglishLanguage;
use IsaEken\PasswordGenerator\Languages\Language;
use IsaEken\PasswordGenerator\Languages\TurkishLanguage;

class PasswordToRememberable
{
    /**
     * Original password
     *
     * @var string
     */
    public string $password;

    /**
     * Converted string
     *
     * @var string
     */
    public string $converted;

    /**
     * Converter language
     *
     * @var Language
     */
    private Language $language;

    /**
     * Language classes
     *
     * @var array|string[]
     */
    private array $languages = [
        'en' => EnglishLanguage::class,
        'tr' => TurkishLanguage::class,
    ];

    /**
     * PasswordToRememberable constructor.
     * @param string|null $password
     * @param string $language
     * @throws Exception
     */
    public function __construct(string $password = null, string $language = 'en')
    {
        if ($password !== null) $this->password = $password;
        $this->setLanguage($language);
    }

    /**
     * @param string $language
     * @return $this
     * @throws Exception
     */
    public function setLanguage(string $language) : PasswordToRememberable
    {
        if (!array_key_exists($language, $this->languages)) throw new Exception('Language is not supported.');
        $this->language = new $this->languages[$language];
        return $this;
    }

    /**
     * @return Language
     */
    public function getLanguage() : Language
    {
        return $this->language;
    }

    /**
     * Convert password to rememberable
     *
     * @return string
     * @throws Exception
     */
    public function convert() : string
    {
        if (!(strlen($this->password) > 0)) throw new Exception('Password is cannot be null!');
        $converted = '';
        foreach (str_split($this->password) as $character)
        {
//            $word = is_numeric($character) ? $this->language->findNumber(intval($character)) : $this->language->findWord($character);
            $word = $this->language->findWord($character);
            if (ctype_upper($character)) $word = mb_strtoupper($word);
            $converted .= ' '.$word.' ';
        }
        return ($this->converted = $converted);
    }

    /**
     * Returns converted string
     *
     * @return string
     * @throws Exception
     */
    public function __toString() : string
    {
        return $this->convert();
    }
}