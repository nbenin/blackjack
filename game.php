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

        // Set player score
        $playerFirstHand = $Player->firstTwo();
        echo 'Player started with a ' . $playerFirstHand[0] . ' and a ' . $playerFirstHand[1] . '<br>';

        // Set dealer score
        $dealerFirstHand = $Dealer->firstTwo();
        echo 'Dealer started with a ' . $dealerFirstHand[0] . ' and a ' . $dealerFirstHand[1] . '<br>';

        // Store in session
        $_SESSION['playerScore'] = $Player->score;
        $_SESSION['dealerScore'] = $Dealer->score;
    }

    // If game buttons pressed, check session for scores
    if (isset($_SESSION['playerScore'])) {
        $Player->score = $_SESSION['playerScore'];
        $Dealer->score = $_SESSION['dealerScore'];
    }

    // If player hits
    if (isset($_POST['playerHit'])) {
        $playerHit = $Player->hit($Player->score);
        echo 'Player hit with a ' . $playerHit . '<br>';

        // Check if player bust or not
        if ($Player->score > 21) {
            youLose();
        }
        $_SESSION['playerScore'] = $Player->score;

    }

    // If player stands
    if (isset($_POST['playerStand'])) {
        while ($Dealer->score <= 15) {
            $dealerHit = $Dealer->hit($Dealer->score);
            echo 'Dealer hit with a ' . $dealerHit . '<br>';
            $_SESSION['dealerScore'] = $Dealer->score;
        }

        // Check if dealer bust
        if ($Dealer->score > 21) {
            youWin();
        }

        // Compare scores after player stands
        if ($Player->score <= $Dealer->score) {
            youLose();
        } else {
            youWin();
        }
    }

    // If player surrenders
    if (isset($_POST['playerSurrender'])) {
        youLose();
    }
}
function youWin() {
    echo 'Winner!';
}
function youLose() {
    echo 'Loser.';
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
    <p>Player score is: <?php echo $Player->score?></p>
    <p>Dealer score is: <?php echo $Dealer->score?></p>
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