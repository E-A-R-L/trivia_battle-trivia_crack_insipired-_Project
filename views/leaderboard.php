<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'C354_t00595022');
$result = mysqli_query($conn, "SELECT username, wins FROM users ORDER BY wins DESC");
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div id="title">Trivia Battle</div>
<div id="top">Top Players</div>

<div id="leaderboard">
    <table width="100%">
        <tr>
            <th>Username</th>
            <th>Wins</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['username'] ?></td>
            <td><?= $row['wins'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <button onclick="window.location='menu.php'">Go Back</button>
</div>

</body>
</html>