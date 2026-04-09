<?php
session_start();
$question = $_SESSION['question'];
$a1 = $_SESSION['a1'];
$a2 = $_SESSION['a2'];
$a3 = $_SESSION['a3'];
$a4 = $_SESSION['a4'];
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>
<div id="welcome" style="margin-top: 200px;"><?= $question ?></div>
<br><br>

<div id="answers">
    <div id="a1" class="answer-box" onclick="submitAnswer('a')"><?= $a1 ?></div>
    <div id="a2" class="answer-box" onclick="submitAnswer('b')"><?= $a2 ?></div>
    <div id="a3" class="answer-box" onclick="submitAnswer('c')"><?= $a3 ?></div>
    <div id="a4" class="answer-box" onclick="submitAnswer('d')"><?= $a4 ?></div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
function submitAnswer(answer) {
    $.post('../controller.php', {
        answer: answer,
        game_id: <?= $_SESSION['game_id'] ?>
    }, function(response) {
        var data = JSON.parse(response);
        if (data.correct) {
            alert('Correct!');
        } else {
            alert('Wrong!');
        }
        if (data.game_over) {
            window.location = '../views/result.php';
        } else {
            window.location = '../views/menu.php';
        }
    });
}
</script>

</body>
</html>