<?php
session_start();
$game    = $_SESSION['game_result'];
$conn    = mysqli_connect('localhost', 'root', '', 'C354_t00595022');
$player1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = {$game['player1_id']}"));
$player2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = {$game['player2_id']}"));

if ($game['player1_score'] > $game['player2_score']) {
    $winner = $player1['username'];
} elseif ($game['player2_score'] > $game['player1_score']) {
    $winner = $player2['username'];
} else {
    $winner = 'Draw';
}
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div id="title">Trivia Battle</div>

<div style="font-size:40px; margin-top:100px;">Results</div>

<div id="profile-box">
    <label><?= $player1['username'] ?>: <?= $game['player1_score'] ?></label>
    <br><br>
    <label><?= $player2['username'] ?>: <?= $game['player2_score'] ?></label>
    <br><br>
    <label>Winner: <?= $winner ?></label>
    <br><br>
    <button onclick="window.location='../views/menu.php'">Go Back</button>
</div>

</body>
</html>