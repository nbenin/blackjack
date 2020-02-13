<?php
// Base blackjack class
class Blackjack
{
    function __construct($score = '0')
    {
        $this->score = $score;

    }
    public function getScore() {
        return $this->score;
    }
}

