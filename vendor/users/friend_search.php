<?php

    session_start();
    require('../../config/db.php');

    if(!isset($_SESSION['user'])) {
        header("Location: ../social/friends.php?error=403");
        exit;
    }

    if(!isset($_GET['search'])) {
        header("Location: ../social/friends.php?error=400");
        exit;
    }

    if(empty($_GET['friend_search'])) {
        header("Location: ../social/friends.php?error=empty");
        exit;
    }

    $search = htmlspecialchars(rtrim($_GET['friend_search']));

    $sql = "SELECT * FROM users WHERE first_name OR second_name = '$search'";
    $friends = mysqli_query($connect, $sql);
    $friends = mysqli_fetch_assoc($friends);

    header("Location: ../../friends.php?search=$search");