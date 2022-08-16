<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(!isset($_SESSION['user'])) {
        header("Location: /login.php?error=400");
        exit;
    }

    if(!isset($_POST['create_post'])) {
        header("Location: /news.php?error=403");
        exit;
    }

    if(empty($_POST['title'] && $_POST['content'] && $_FILES['image'])) {
        header("Location: /news.php?error=401");
        exit;
    }

    $title = htmlspecialchars(rtrim($_POST['title']));
    $content = htmlspecialchars(rtrim($_POST['content']));
    $image = $_FILES['image']['name'];
    $created_at = date("Y-m-d H:i:s");
    $user_id = $_SESSION['user']['id'];

    if(strlen($title) < 3 && strlen($title) > 255) {
        header("Location: /register.php?error=first_name");
        exit;
    }

    if(strlen($content) < 3 && strlen($content) > 255) {
        header("Location: /register.php?error=second_name");
        exit;
    }

    $tempname = $_FILES["image"]["tmp_name"];  

    $folder = $_SERVER['DOCUMENT_ROOT'] . "/views/images/".$image;

    if (move_uploaded_file($tempname, $folder)) {
        echo "Image uploaded successfully";
    }else{
        echo "Failed to upload image";
    }

    mysqli_query($connect, "INSERT INTO `posts` (`id`, `title`, `content`, `image`, `created_at`, `user_id`) 
    VALUES (NULL, '$title', '$content', '$image', '$created_at', '$user_id')");

    // die(var_dump($content));

    // die(var_dump($created_at));

    header("Location: /news.php?success=200");