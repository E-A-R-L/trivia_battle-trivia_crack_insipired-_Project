<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
$conn = mysqli_connect('localhost', 'root', '', 'C354_t00595022');
require_once '../models/user.php';
$activeGame = checkActiveGame($conn, $_SESSION['user_id']);
$username   = $_SESSION['username'];
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>
<div id="title">Trivia Battle</div>
<br><br>
<div id="welcome">Welcome <?= $username ?> ready to test your trivia?</div>
<br><br>

<div id="menu-options">
<a href="profile.php"><button>Profile</button></a>
<br>
<a href="leaderboard.php"><button>Leaderboard</button></a>
</div>
<br>

<div id="options">
    <?php if (!$activeGame): ?>
        <button type="button" onclick="document.getElementById('searchForm').submit()" id="searchbtn">SEARCH</button>
    <?php elseif ($activeGame['current_turn'] == $_SESSION['user_id']): ?>
        <button type="button" onclick="document.getElementById('continueForm').submit()" id="continuebtn">CONTINUE</button>
    <?php endif; ?>
</div>

<form id="searchForm" method="POST" action="../controller.php">
    <input type="hidden" name="search" value="1">
</form>
<form id="continueForm" method="POST" action="../controller.php">
    <input type="hidden" name="continue" value="1">
</form>

<a href="../index.php"><button id="signout">Sign Out</button></a>
</body>
</html>