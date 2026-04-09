<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'C354_t00595022');
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = {$_SESSION['user_id']}"));
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div id="title">Trivia Battle</div>

<div style="font-size:40px; margin-top:100px;">Profile</div>

<div id="profile-box">
    <label><?= $user['username'] ?></label>
    <br><br>
    <label>Wins: <?= $user['wins'] ?></label>
    <br><br>
    <button onclick="window.location='menu.php'">Go Back</button>
    <button onclick="window.location='update_profile.php'">Update</button>
</div>

</body>
</html>