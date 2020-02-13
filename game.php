<?php
// Yes
declare(strict_types=1);
// Require class file
require 'blackjack.php';
// start sesh
session_start();

// Initialize players
$Player = new Blackjack();
$Dealer = new Blackjack();

// Start game logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // If coming from home page, initialize new players
    if (isset($_POST['startGame'])) {
        $playerScore = $Player->firstTwo();
        $dealerScore = $Dealer->firstTwo();
        $_SESSION['playerScore'] = $playerScore;
        $_SESSION['dealerScore'] = $dealerScore;
    }

    // If game buttons pressed, check session for scores
    if (isset($_SESSION['playerScore'])) {
        $playerScore = $_SESSION['playerScore'];
        $dealerScore = $_SESSION['dealerScore'];
    }

    // If player hits
    if (isset($_POST['playerHit'])) {
        $playerScore = $Player->hit($playerScore);
        $_SESSION['playerScore'] = $playerScore;
    }

    // If player stands
    if (isset($_POST['playerStand'])) {
        echo 'stand';
    }

    // If player surrenders
    if (isset($_POST['playerSurrender'])) {
        echo 'Never Surrender';
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class='container'>
    <p>Player score is: <?php echo $playerScore?></p>
    <p>Dealer score is: <?php echo $dealerScore?></p>
</div>
<form method="POST">
    <button type="submit" name="playerHit">Hit</button>
    <button type="submit" name="playerStand">Stand</button>
    <button type="submit" name="playerSurrender">Surrender</button>
</form>
<br><br><br><br><br>
<form method="POST" action="index.php">
    <button type="submit" name="home">Go Home</button>
</form>

</body>
</html>