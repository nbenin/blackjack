<?php
// Yes
declare(strict_types=1);
// Require class
require 'blackjack.php';
// Start session
session_start();

$buttonPressed = $_GET['']
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Player = new Blackjack();
    $Dealer = new Blackjack();
    echo 'Player score is ' . $Player->getScore();
    echo 'Dealer score is ' . $Player->getScore();
}


require 'game.php';

