<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>
<div id="title">Trivia Battle</div>
<br><br>
<div id="welcome">Welcome <?php echo $username; ?> ready to test your trivia?</div>
<br><br>

<div id="menu-options">
<button>Profile</button>
<br>
<button>Leaderboard</button>
</div>
<br>

<div id="options">
    <form method="POST" action="../controller.php">
        <button type="submit" name="search" id="searchbtn">SEARCH</button>
    </form>
    <button id="continuebtn">CONTINUE</button>
    <button id="challengebtn">CHALLENGES</button>
</div>

</body>
</html>