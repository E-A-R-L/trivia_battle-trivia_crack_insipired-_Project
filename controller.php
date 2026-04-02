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
    $_SESSION['opponent_id']   = $opponent['id'];
    $_SESSION['opponent_name'] = $opponent['username'];
    header('Location: views/game.php');
}
?>