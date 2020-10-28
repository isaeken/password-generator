<?php
/**
 * @author İsa Eken <hello@isaeken.com.tr>
 * @link https://www.isaeken.com.tr
 * @version 1.0.0
 * @license MIT
 * @see https://www.github.com/isaeken/password-generator/README.md
 */


namespace IsaEken\PasswordGenerator;


/**
 * Class PasswordGenerator
 * @package IsaEken\PasswordGenerator
 */
class PasswordGenerator
{
    /**
     * Password length
     * Suggested 16
     *
     * @var int
     */
    public int $length = 16;

    /**
     * Include symbols
     * E.g. @ # $ %
     *
     * @var bool
     */
    public bool $symbols = true;

    /**
     * Include numbers
     * E.g. 1 2 3 4 5
     *
     * @var bool
     */
    public bool $numbers = true;

    /**
     * Include lowercase characters
     * E.g. a b c d
     *
     * @var bool
     */
    public bool $lowercase = true;

    /**
     * Include uppercase characters
     * E.g. A B C D
     *
     * @var bool
     */
    public bool $uppercase = true;

    /**
     * Include similar characters
     * E.g. i, l, o, 0, O
     *
     * @var bool
     */
    public bool $similar = false;

    /**
     * Include ambiguous characters
     * { } [ ] ( ) / \ ' " ` ~ , ; : . < >
     *
     * @var bool
     */
    public bool $ambiguous = false;

    /**
     * Variables class
     *
     * @var Variables
     */
    public Variables $variables;

    /**
     * PasswordGenerator constructor.
     *
     * @param array|null $options
     */
    public function __construct(?array $options = null)
    {
        $this->variables = new Variables;
        if ($options == null) return;
        foreach ($options as $key => $value) if (isset($this->{$key})) $this->{$key} = $value;
    }

    /**
     * Set password length
     * Suggested 16 characters
     *
     * @param int $length
     * @return $this
     */
    public function setLength(int $length = 16) : PasswordGenerator
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Set including symbols
     *
     * @param bool $symbols
     * @return $this
     */
    public function setSymbols(bool $symbols = true) : PasswordGenerator
    {
        $this->symbols = $symbols;
        return $this;
    }

    /**
     * Set including numbers
     *
     * @param bool $numbers
     * @return $this
     */
    public function setNumbers(bool $numbers = true) : PasswordGenerator
    {
        $this->numbers = $numbers;
        return $this;
    }

    /**
     * Set including lowercase characters
     *
     * @param bool $lowercase
     * @return $this
     */
    public function setLowercase(bool $lowercase = true) : PasswordGenerator
    {
        $this->lowercase = $lowercase;
        return $this;
    }

    /**
     * Set including uppercase characters
     *
     * @param bool $uppercase
     * @return $this
     */
    public function setUppercase(bool $uppercase = true) : PasswordGenerator
    {
        $this->uppercase = $uppercase;
        return $this;
    }

    /**
     * Set including similar characters
     *
     * @param bool $similar
     * @return $this
     */
    public function setSimilar(bool $similar = false) : PasswordGenerator
    {
        $this->similar = $similar;
        return $this;
    }

    /**
     * Set including ambiguous characters
     *
     * @param bool $ambiguous
     * @return $this
     */
    public function setAmbiguous(bool $ambiguous = false) : PasswordGenerator
    {
        $this->ambiguous = $ambiguous;
        return $this;
    }

    /**
     * Generate a character using options
     *
     * @return string
     */
    public function character() : string
    {
        $possibilities = [];
        $similarities = $this->variables->similarities();
        if ($this->ambiguous) $possibilities = array_merge($possibilities, $this->variables->ambiguous());
        if ($this->uppercase) $possibilities = array_merge($possibilities, $this->variables->alphabet(true));
        if ($this->lowercase) $possibilities = array_merge($possibilities, $this->variables->alphabet(false));
        if ($this->numbers) $possibilities = array_merge($possibilities, $this->variables->numbers());
        if ($this->symbols) $possibilities = array_merge($possibilities, $this->variables->symbols());
        if (!$this->similar)
        {
            $possibilities = array_filter($possibilities, function ($character) use ($similarities) {
                foreach ($similarities as $key => $values)
                {
                    if ($character == $key) return false;
                    foreach ($values as $value) if ($character == $value) return false;
                }
                return true;
            });
        }
        return $possibilities[array_rand($possibilities)];
    }

    /**
     * Generate a password using options
     *
     * @param int|null $length
     * @return string
     */
    public function generate(?int $length = null) : string
    {
        $password = '';
        $length = isset($length) && $length != null ? $length : $this->length;
        for ($character = 0; $character < $length; $character++) $password .= $this->character();
        return $password;
    }

    /**
     * Generate a password between length using options
     *
     * @param int $min
     * @param int $max
     * @return string
     */
    public function generateBetween(int $min, int $max) : string
    {
        return $this->generate(rand($min, $max));
    }
}