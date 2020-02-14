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
    public function hit() {
        $randomCard = rand(1, 11);
        $this->score += $randomCard;

        // Check for player bustin
        if($this->score > 21) {
            echo '<script>alert("You Lose!");</script>';
            header('Location: blackjack.local/');
        }
        return $randomCard;
    }

    // Stand method
    public function stand($playerScore) {
        $dealerHits = [];
        while($this->score <= 15) {
            array_push($dealerHits, $this->hit());
        }

        // check for dealer bustin
        if ($this->score >= $playerScore) {
            echo '<script>alert("You Lose!");</script>';
            header('Location: blackjack.local/');
        } else {
            echo '<script>alert("You Win!");</script>';
            header('Location: blackjack.local/');
        }

        return $dealerHits;
    }

    // Surrender method
    public function surrender() {
        echo '<script>alert("You Lose!");</script>';
        header('Location: blackjack.local/');
    }
}

