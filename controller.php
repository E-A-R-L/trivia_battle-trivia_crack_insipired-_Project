<?php
session_start();
require_once 'models/user.php';

if (isset($_POST['signup'])) {
    signUp($conn, $_POST['username'], $_POST['password'], $_POST['email'], $_POST['dob']);
    header('Location: index.php');
}

if (isset($_POST['login'])) {
    $user = logIn($conn, $_POST['username'], $_POST['password']);
    if ($user) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: views/menu.php');
    } else {
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: index.php');
    }
}

if (isset($_POST['search'])) {
    $opponent = getRandomOpponent($conn, $_SESSION['user_id']);
    $_SESSION['opponent_name'] = $opponent['username'];
    $_SESSION['opponent_id']   = $opponent['id'];
    createGame($conn, $_SESSION['user_id'], $opponent['id']);
    $game = getGame($conn, $_SESSION['user_id']);
    $_SESSION['game_id'] = $game['id'];
    $question = getQuestion($conn);
    $_SESSION['question'] = $question['question_text'];
    $_SESSION['a1']       = $question['option_a'];
    $_SESSION['a2']       = $question['option_b'];
    $_SESSION['a3']       = $question['option_c'];
    $_SESSION['a4']       = $question['option_d'];
    $_SESSION['correct']  = $question['correct_option'];
    header('Location: views/game.php');
}

if (isset($_POST['answer'])) {
    $game_id    = $_POST['game_id'];
    $answer     = $_POST['answer'];
    $correct    = $_SESSION['correct'];
    $is_correct = ($answer === $correct);
    $game       = getGame($conn, $_SESSION['user_id']);
    $player     = ($game['player1_id'] == $_SESSION['user_id']) ? 'player1' : 'player2';
    submitAnswer($conn, $game_id, $player, $is_correct);
    $next_turn  = ($game['player1_id'] == $_SESSION['user_id']) ? $game['player2_id'] : $game['player1_id'];
    mysqli_query($conn, "UPDATE games SET current_turn = $next_turn WHERE id = $game_id");

    $updatedGame = getGame($conn, $_SESSION['user_id']);
    $game_over = false;
    if ($updatedGame['rounds_played'] >= 6) {
        mysqli_query($conn, "UPDATE games SET active = 0 WHERE id = $game_id");
        if ($updatedGame['player1_score'] > $updatedGame['player2_score']) {
            $winner_id = $updatedGame['player1_id'];
        } elseif ($updatedGame['player2_score'] > $updatedGame['player1_score']) {
            $winner_id = $updatedGame['player2_id'];
        } else {
            $winner_id = null;
        }
        if ($winner_id) {
            mysqli_query($conn, "UPDATE users SET wins = wins + 1 WHERE id = $winner_id");
        }
        $_SESSION['game_result'] = $updatedGame;
        $game_over = true;
    }

    echo json_encode(['correct' => $is_correct, 'game_over' => $game_over]);
    exit;
}

if (isset($_POST['continue'])) {
    $question = getQuestion($conn);
    $_SESSION['question'] = $question['question_text'];
    $_SESSION['a1']       = $question['option_a'];
    $_SESSION['a2']       = $question['option_b'];
    $_SESSION['a3']       = $question['option_c'];
    $_SESSION['a4']       = $question['option_d'];
    $_SESSION['correct']  = $question['correct_option'];
    header('Location: views/ongoing.php');
}

if (isset($_POST['update'])) {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $retype       = $_POST['retype_password'];
    if ($new_password === $retype) {
        mysqli_query($conn, "UPDATE users SET username = '$new_username', password = '$new_password' WHERE id = {$_SESSION['user_id']}");
        $_SESSION['username'] = $new_username;
    }
    header('Location: views/profile.php');
}
?>