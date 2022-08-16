<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(!isset($_SESSION['user'])) {
        header("Location: /login.php?error=400");
        exit;
    }

    if(!isset($_POST['create_comment'])) {
        header("Location: /news.php?error=403");
        exit;
    }

    if(empty($_POST['comment'] && $_POST['user_id'] && $_POST['post_id'])) {
        header("Location: /news.php?error=401");
        exit;
    }

    $comment = htmlspecialchars(rtrim($_POST['comment']));
    $parent_id = htmlspecialchars(rtrim($_POST['parent_id']));
    $post_id = htmlspecialchars(rtrim($_POST['post_id']));
    $created_at = date("Y-m-d H:i:s");
    $user_id = $_SESSION['user']['id'];

    if(strlen($title) < 3 && strlen($comment) > 255) {
        header("Location: /register.php?error=first_name");
        exit;
    }

    mysqli_query($connect, "INSERT INTO `post_comments` (`id`, `text`, `parent_id`, `post_id`, `user_id`, `created_at`) 
    VALUES (NULL, '$comment', '$parent_id', '$post_id', '$user_id', '$created_at')");

    // die(var_dump($content));

    // die(var_dump($created_at));

    header("Location: /news.php?success=200");