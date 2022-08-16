<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(!isset($_SESSION['user'])) {
        header("Location: /login.php?error=400");
        exit;
    }

    if(empty($_POST['title'] && $_POST['content'] && $_FILES['image'] && $_POST['update_post'])) {
        header("Location: /news.php?error=401");
        exit;
    }

    $title = htmlspecialchars(rtrim($_POST['title']));
    $content = htmlspecialchars(rtrim($_POST['content']));
    if(!empty($_FILES['image']['tmp_name'])) {
        $image = $_FILES['image']['name'];
    }
    $image = $_POST['old_image'];
    $user_id = $_SESSION['user']['id'];
    $created_at = date("Y-m-d H:i:s");

    $post_id = $_POST['update_post'];

    $sql = "SELECT * FROM posts WHERE posts.id = '$post_id'";
    $post_image = mysqli_query($connect, $sql);
    $post_image = mysqli_fetch_assoc($post_image);

    // die(var_dump($image));

    if(strlen($title) < 3 && strlen($title) > 255) {
        header("Location: /register.php?error=first_name");
        exit;
    }

    if(strlen($content) < 3 && strlen($content) > 255) {
        header("Location: /register.php?error=second_name");
        exit;
    }

    if($image != $post_image['image']) {

        $tempname = $_FILES["image"]["tmp_name"];  

        $folder = $_SERVER['DOCUMENT_ROOT'] . "/views/images/".$image;

        if (move_uploaded_file($tempname, $folder)) {
            echo "Image uploaded successfully";
        }else{
            echo "Failed to upload image";
        }

    } 

    mysqli_query($connect, "UPDATE posts SET `title` = '$title', `content` = '$content', `image` = '$image', `created_at` = '$created_at'
    WHERE posts.id = '$post_id'");

    // die(var_dump($query_update));

    header("Location: /news.php?success=200");