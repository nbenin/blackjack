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
        $cardOne = rand(1, 11);
        $cardTwo = rand(1, 10);
        $this->score = $cardOne + $cardTwo;
        return [$cardOne, $cardTwo];
    }

    // Hit method
    public function hit($currentScore) {
        $randomCard = rand(1, 11);
        $this->score = $currentScore + $randomCard;
        return $randomCard;
    }
}

