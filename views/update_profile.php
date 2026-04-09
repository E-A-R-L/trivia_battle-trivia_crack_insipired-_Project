<?php
session_start();
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>
<div id="title">Trivia Battle</div>

<div id="login-box">
    <h3>Update Profile</h3>
    <form method="POST" action="../controller.php">
        <label>New Username</label><br>
        <input type="text" name="new_username"><br><br>

        <label>New Password</label><br>
        <input type="password" name="new_password"><br><br>

        <label>Retype Password</label><br>
        <input type="password" name="retype_password"><br><br>

        <a href="profile.php"><button type="button">Go Back</button></a>
        <button type="submit" name="update">Update</button>
    </form>
</div>

</body>
</html>