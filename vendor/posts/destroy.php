<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(empty($_GET['id'])) {
        header("Location: /news.php?error=403");
        exit;
    }

    if(!isset($_SESSION['user'])) {
        header("Location: /login.php?error=400");
        exit;
    }

    $post_id = $_GET['id'];

    // die(var_dump($image));

    mysqli_query($connect, "DELETE FROM posts
    WHERE posts.id = '$post_id'");

    // die(var_dump($query_update));

    header("Location: /news.php?success=200");