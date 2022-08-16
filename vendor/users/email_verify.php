<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . "/config/db.php");

    if(isset($_SESSION['user'])) {
        header("Location: /index.php?error=400");
        exit;
    }

    if(empty($_POST['token'])) {
        header("Location: /index.php?error=403");
        exit;
    }

    $token = htmlspecialchars(rtrim($_POST['token']));

    $sql = "SELECT * FROM users WHERE `restore_password_token` = '$token'";

    $user_token = mysqli_query($connect, $sql);
    $user_token = mysqli_fetch_assoc($user_token);

    if($token === $user_token['restore_password_token']) {
        $sql_update = "UPDATE users SET status = '1' WHERE restore_password_token='$token'";
        mysqli_query($connect, $sql_update);
        // die(var_dump($update));
    }

    header("Location: /index.php?success=activate");