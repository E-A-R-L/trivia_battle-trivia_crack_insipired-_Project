<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>
<div id="title">Trivia Battle</div>

<div id="login-box">
    <h3>Welcome</h3>
    <form method="POST" action="../controller.php">
        <label>Username</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Date of Birth</label><br>
        <input type="date" name="dob" required><br><br>

        <a href="../index.php"><button type="button">Go Back</button></a>
        <button type="submit" name="signup">Sign Up</button>
    </form>
</div>

</body>
</html>