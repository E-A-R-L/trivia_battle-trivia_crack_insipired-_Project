<?php
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="style.css">
</head>

<body>
<div id="title">Trivia Battle</div>

<div id="login-box">
    <form method="POST" action="controller.php">
        <label>Username</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="login">Login</button>
    </form>
    <a href="views/signup.php"><button>Sign Up</button></a>
</div>
<?php if ($error): ?>
<script>alert('<?= $error ?>');</script>
<?php endif; ?>
</body>
</html>