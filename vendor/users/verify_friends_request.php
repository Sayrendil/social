<?php

    session_start();
    require('../../config/db.php');

    if(!isset($_SESSION['user'])) {
        header("Location: ../../login.php?error=400");
        exit;
    }

    if(!isset($_GET['verify'])) {
        header("Location: ../../views/users/ckeck_friends.php?error=403");
        exit;
    }

    if($_GET['verify'] != "success") {
        header("Location: ../../views/users/ckeck_friends.php?error=403");
        exit;
    }

    $user_id = $_SESSION['user']['id'];

    $sql_update = "UPDATE friendship_requests SET status = '2' WHERE from_user_id='$user_id'";
    mysqli_query($connect, $sql_update);

    header("Location: ../../views/users/my_friends.php?success=200");
