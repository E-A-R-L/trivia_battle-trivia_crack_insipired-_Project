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

?>