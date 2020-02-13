<?php
// Base blackjack class
class Blackjack
{
    // Score constructor
    public $score;
    public function __construct($score = '0')
    {
        $this->score = $score;
    }

    // Game start method
    public function firstTwo() {
        return(rand(1, 11) + rand(1, 10));
    }

    // Hit method
    public function hit($currentScore) {
        $randomCard = rand(1, 11);
        return $currentScore + $randomCard;
    }
}

