<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(!isset($_SESSION['user'])) {
        header("Location: /login.php?error=400");
        exit;
    }

    if(!isset($_GET['verify'])) {
        header("Location: /views/users/ckeck_friends.php?error=403");
        exit;
    }

    if($_GET['verify'] != "success") {
        header("Location: /views/users/ckeck_friends.php?error=403");
        exit;
    }

    $user_id = $_SESSION['user']['id'];

    // die(var_dump($user_id));

    $sql_update = "UPDATE friendship_requests SET friendship_requests.status = '2' WHERE friendship_requests.from_user_id='$user_id' OR friendship_requests.to_user_id = '$user_id'";
    mysqli_query($connect, $sql_update);

    header("Location: /views/users/my_friends.php?success=200");
