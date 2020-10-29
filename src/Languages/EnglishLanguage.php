<?php


namespace IsaEken\PasswordGenerator\Languages;


class EnglishLanguage implements Language
{
    /**
     * EnglishLanguage constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function getWords(): array
    {
        return [
            'art', 'articulate', 'architecture',
            'beautiful', 'besiege', 'blur',
            'clinical', 'cake', 'cancer',
            'dad', 'daily', 'dance',
            'ear', 'east', 'earn',
            'face', 'fake', 'fall',
            'game', 'gate', 'garbage',
            'half', 'hand', 'happy',
            'ice', 'idea', 'identity',
            'jacket', 'jam', 'job',
            'key', 'kid', 'kiss',
            'lady', 'lake', 'lamp', 'land',
            'machine', 'magic', 'man',
            'name', 'natural', 'near',
            'object', 'ocean', 'offense',
            'package', 'page', 'paint', 'panic', 'paper',
            'quality', 'queen', 'quiz',
            'rage', 'radio', 'range', 'rate',
            'sad', 'safe', 'sample', 'sand',
            'table', 'talk', 'take', 'tax', 'teacher',
            'umbrella', 'uncle', 'uniform', 'unique', 'unit',
            'value', 'vehicle', 'view', 'video',
            'woman', 'wake', 'walk', 'wash',
            'year', 'yellow', 'yesterday', 'young',
            'zero', 'zone', 'zoo',
        ];
    }

    /**
     * @param string $firstLetter
     * @return string
     */
    public function findWord(string $firstLetter): string
    {
        $words = $this->getWords();
        shuffle($words);
        foreach ($words as $word)
            if ($word[0] === strtolower($firstLetter))
                return $word;
        return $firstLetter;
    }

    /**
     * @return array
     */
    public function getNumbers(): array
    {
        return [
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
        ];
    }

    /**
     * @param int $number
     * @return string
     */
    public function findNumber(int $number): string
    {
        return $this->getNumbers()[$number];
    }
}