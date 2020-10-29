<?php


namespace IsaEken\PasswordGenerator\Languages;


interface Language
{
    /**
     * @return array
     */
    public function getWords() : array;

    /**
     * @param string $firstLetter
     * @return string
     */
    public function findWord(string $firstLetter) : string;

    /**
     * @return array
     */
    public function getNumbers() : array;

    /**
     * @param int $number
     * @return string
     */
    public function findNumber(int $number) : string;
}