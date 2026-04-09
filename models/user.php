<?php
$conn = mysqli_connect('localhost', 'root', '', 'C354_t00595022');

function signUp($conn, $username, $password, $email, $dob) {
    $sql = "INSERT INTO users (username, password, email, date_of_birth) 
            VALUES ('$username', '$password', '$email', '$dob')";
    return mysqli_query($conn, $sql);
}

function logIn($conn, $username, $password) {
    $sql    = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function getRandomOpponent($conn, $current_user_id) {
    $sql = "SELECT * FROM users WHERE id != $current_user_id ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function createGame($conn, $player1_id, $player2_id) {
    $sql = "INSERT INTO games (player1_id, player2_id, current_turn, active) 
            VALUES ($player1_id, $player2_id, $player1_id, 1)";
    return mysqli_query($conn, $sql);
}

function getQuestion($conn) {
    $sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function checkActiveGame($conn, $user_id) {
    $sql = "SELECT * FROM games WHERE (player1_id = $user_id OR player2_id = $user_id) AND active = 1";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function submitAnswer($conn, $game_id, $player, $is_correct) {
    if ($is_correct) {
        mysqli_query($conn, "UPDATE games SET {$player}_score = {$player}_score + 1 WHERE id = $game_id");
    }
    mysqli_query($conn, "UPDATE games SET rounds_played = rounds_played + 1 WHERE id = $game_id");
}

function getGame($conn, $user_id) {
    $sql = "SELECT * FROM games WHERE (player1_id = $user_id OR player2_id = $user_id) AND active = 1";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function getChallenge($conn, $user_id) {
    $sql = "SELECT * FROM games WHERE player2_id = $user_id AND active = 1";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

?>