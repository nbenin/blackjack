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

    // Player hit method
    public function playerHit() {
        $randomCard = rand(1, 11);
        $this->score += $randomCard;

        // Check for player bustin
        if($this->score > 21) {
            $this->alert('Lose! You drew a ' . $randomCard . ' and went bust with ' . $this->score);
        }
        return $randomCard;
    }

    // Dealer hit method
    public function dealerHit() {
        $randomCard = rand(1, 11);
        $this->score += $randomCard;

        // Check for dealer bustin
        if($this->score > 21) {
            $this->alert('Win! Dealer drew a ' . $randomCard . ' and went bust with ' . $this->score);
        }
        return $randomCard;
    }

    // Stand method
    public function stand($playerScore) {
        $dealerHits = [];
        while($this->score <= 15) {
            array_push($dealerHits, $this->dealerHit());
        }

        // check for dealer bustin
        if ($this->score >= $playerScore) {
            $this->alert('Lose! Dealer has ' . $this->score . ' and you have ' . $playerScore);
        } else {
            $this->alert('Win! Dealer has ' . $this->score . ' and you have ' . $playerScore);
        }

        return $dealerHits;
    }

    // Surrender method
    public function surrender() {
        $this->alert("Lose! You didn't even try!");
    }

    // Win lose alert function (using some cheeky javascript sorry!)
    public function alert($message) {
        echo '<script type="text/javascript">window.alert("You ' . $message . '");window.location.href="/";</script>';
    }
}

