<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(!empty($_SESSION['user'])) {
        header("Location: /index.php?error=auth");
        exit;
    }

    if(!isset($_POST['auth_user'])) {
        header("Location: /login.php?error=400");
        exit;
    }

    if(empty($_POST['email'] && $_POST['password'])) {
        header("Location: /login.php?error=403");
        exit;
    }

    $status = 1;

    $email = htmlspecialchars(rtrim($_POST['email']));
    $password = htmlspecialchars(rtrim($_POST['password']));

    $sql = "SELECT * FROM users WHERE `email`='$email' AND `password`='$password'";
    $user = mysqli_query($connect, $sql);
    $user = mysqli_fetch_assoc($user);

    // die(var_dump($user));
    if($status != $user['status']) {
        header("Location: /index.php?error=status");
        exit;
    }

    if($user['password'] === $password && $user['email'] === $email) {
        $_SESSION['user'] = $user;
    }

    header("Location: /index.php?success=200");
