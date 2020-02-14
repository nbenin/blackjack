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
        $playerHit = $Player->hit();
        echo 'Player hit with a ' . $playerHit . '<br>';
        $_SESSION['playerScore'] = $Player->score;
    }

    // If player stands
    if (isset($_POST['playerStand'])) {

        // Pass Player score into method and let dealer go
        $dealerHits = $Dealer->stand($Player->score);
        foreach($dealerHits as $cards) {
            echo 'Dealer hit with a ' . $cards . '<br>';
        }
        $_SESSION['dealerScore'] = $Dealer->score;
    }

    // If player surrenders
    if (isset($_POST['playerSurrender'])) {
        $Player->surrender();
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