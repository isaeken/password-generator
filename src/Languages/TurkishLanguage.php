<?php


namespace IsaEken\PasswordGenerator\Languages;


class TurkishLanguage implements Language
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
            'açık', 'ambalaj', 'açıklama', 'acı', 'anne', 'atatürk', 'ali',
            'benzer', 'badem', 'bey', 'baba', 'balta',
            'cahil', 'cimri', 'cisim', 'can', 'cambaz', 'cumhuriyet',
            'çabuk', 'çerçeve', 'çekiç', 'çatı', 'çamur', 'çocuk',
            'dalgın', 'dayı', 'damla', 'dar', 'davul', 'devrim', 'doğa',
            'ebedi', 'efsun', 'egzoz', 'eklem', 'ekmek', 'egemenlik', 'efendi',
            'fark', 'fakir', 'fabrika', 'faiz', 'felsefe', 'felaket',
            'gazete', 'gaz', 'galon', 'gayet', 'genç', 'gıda',
            'hafif', 'hava', 'haber', 'haksız', 'hadise', 'hafıza', 'hanım',
            'ışık', 'ışıl', 'ızgara', 'ışıma', 'ırk', 'ısı',
            'iktidar', 'iade', 'işci', 'icra', 'ikamet', 'ihtimal', 'inklap',
            'jakuzi', 'jeton', 'joker', 'jilet', 'jest',
            'kaba', 'kafes', 'kaç', 'kaktüs', 'kabile', 'kemal',
            'laik', 'lehim', 'labirent', 'lahana', 'lira', 'lise',
            'maaş', 'mahkuk', 'mahküm', 'mağdur', 'macun', 'mustafa',
            'not', 'nakil', 'nakış', 'nakit', 'nasip', 'namlu',
            'okyanus', 'olta', 'olgun', 'omuz', 'onarım', 'onay',
            'ödül', 'ödev', 'özgür', 'ödünç', 'öğüt', 'ödenek',
            'pano', 'para', 'paça', 'profesyonel', 'proje',
            'ruhsat', 'radikal', 'radyo', 'ruh', 'rüzgar', 'rıza',
            'sabit', 'saldırgan', 'sağlam', 'sağlık', 'samimi', 'selanik',
            'şart', 'şehir', 'şeffaf', 'şahsiyet', 'şekil',
            'televizyon', 'taksit', 'toplum', 'tiyatro', 'türkçe', 'türkiye',
            'uysal', 'uzak', 'ulus', 'uzman', 'utan', 'uğur', 'uyanık', 'usta',
            'ülkü', 'ücret', 'üstün', 'üzüm', 'üniforma', 'üşengeç',
            'vakif', 'vasıf', 'vergi', 'vatan', 'vitamin', 'vejeteryan',
            'yasa', 'yabancı', 'yoksul', 'yüzey', 'yurt', 'yaban', 'yaprak',
            'zengin', 'zayıf', 'zikir', 'zaman', 'zabıta', 'zarf', 'zemin', 'zübeyde',
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
            0 => 'sıfır',
            1 => 'bir',
            2 => 'iki',
            3 => 'üç',
            4 => 'dört',
            5 => 'beş',
            6 => 'altı',
            7 => 'yedi',
            8 => 'sekiz',
            9 => 'dokuz',
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