<?php

    session_start();

    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(!isset($_SESSION['user'])) {
        header("Location: /friends.php?error=403");
        exit;
    }

    if(empty($_GET['to_user_id'])) {
        header("Location: /friends.php?error=401");
        exit;
    }

    $user_id = $_SESSION['user']['id'];
    $status = 1;
    $to_user_id = $_GET['to_user_id'];
    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO friendship_requests (`id`, `from_user_id`, `to_user_id`, `status`, `created_at`) VALUES(NULL, '$user_id', '$to_user_id', '$status', '$created_at')";
    mysqli_query($connect, $sql);

    header("Location: /friends.php?success=200");