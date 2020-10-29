<?php


namespace IsaEken\PasswordGenerator\Converters;


use Exception;

class RememberableToPassword
{
    /**
     * Rememberable string
     *
     * @var string
     */
    public string $rememberable;

    /**
     * Converted string
     *
     * @var string
     */
    public string $converted;

    /**
     * PasswordToRememberable constructor.
     * @param string|null $rememberable
     */
    public function __construct(string $rememberable = null)
    {
        if ($rememberable !== null) $this->rememberable = $rememberable;
    }

    /**
     * Convert password to rememberable
     *
     * @return string
     * @throws Exception
     */
    public function convert() : string
    {
        if (!(strlen($this->rememberable) > 0)) throw new Exception('Rememberable is cannot be null!');
        $converted = '';
        foreach (explode(' ', $this->rememberable) as $word) if (strlen($word) > 0) $converted .= trim($word)[0];
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