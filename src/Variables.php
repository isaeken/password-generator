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
 * Class Variables
 * @package IsaEken\PasswordGenerator
 */
class Variables
{
    /**
     * Get all symbols
     *
     * @return array
     */
    public function symbols() : array
    {
        return str_split('@#$+^%?{()}[]=*/-\\<>!.,-_`&:;');
    }

    /**
     * Get all numbers
     *
     * @return array
     */
    public function numbers() : array
    {
        return str_split('0123456789');
    }

    /**
     * Get alphabet
     *
     * @param bool $uppercase
     * @return array
     */
    public function alphabet($uppercase = false) : array
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        return str_split($uppercase ? strtoupper($alphabet) : strtolower($alphabet));
    }

    /**
     * Get similar characters
     *
     * @todo add characters from https://github.com/codebox/homoglyph/blob/master/raw_data/chars.txt
     * @return array
     */
    public function similarities() : array
    {
        return [
            'b' => ['6'],
            'c' => ['('],
            'g' => ['q', '9'],
            'C' => ['('],
            'G' => ['6'],
            'L' => ['l','I','1','|'],
            'O' => ['0','o'],
            'u' => ['U', 'V', 'v'],
            'S' => ['5'],
            'v' => ['V'],
            'Z' => ['z','2']
        ];
    }

    /**
     * Get ambiguous
     *
     * @return array
     */
    public function ambiguous() : array
    {
        return str_split('{}[]()/\\\'"`~,;:.<>');
    }
}