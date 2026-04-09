<?php
session_start();
$opponent = $_SESSION['opponent_name'];
?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>
<div id="welcome" style="margin-top: 200px;">You are against <br><?= $opponent ?>
</div>
<br>
<button style="background-color: red;" onclick="window.location='ongoing.php'">Begin!</button>

</body>
</html>