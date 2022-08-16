<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(!isset($_SESSION['user'])) {
        header("Location: /index.php?error=400");
        exit;
    }

    iF(!isset($_POST['update_user'])) {
        header("Location: /index.php?error=403");
        exit;
    }

    if(empty($_POST['first_name'] || $_POST['second_name'] || $_POST['phone'] || $_POST['email'] || $_FILES['image'] || $_POST['password'])) {
        header("Location: /index.php?error=300");
        exit;
    }

    $first_name = htmlspecialchars(rtrim($_POST['first_name']));
    $second_name = htmlspecialchars(rtrim($_POST['second_name']));
    $phone = htmlspecialchars(rtrim($_POST['phone']));
    $image = $_FILES['image']['name'];
    $email = htmlspecialchars(rtrim($_POST['email']));
    $password = htmlspecialchars(rtrim($_POST['password']));

    $user_id = $_SESSION['user']['id'];

    $tempname = $_FILES["image"]["tmp_name"];  
    $folder = $_SERVER['DOCUMENT_ROOT'] . "/views/images/".$image;

    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $user = mysqli_query($connect, $sql);
    $user = mysqli_fetch_assoc($user);

    if(strlen($first_name) < 3 || strlen($first_name) > 255) {
        header("Location: /views/users/settings.php?error=first_name");
        exit;
    }

    if(strlen($second_name) < 3 || strlen($second_name) > 255) {
        header("Location: /views/users/settings.php?error=second_name");
        exit;
    }

    if(strlen($phone) < 10 || strlen($phone) > 13) {
        header("Location: /views/users/settings.php?error=phone");
        exit;
    }

    if(strlen($email) < 5 || strlen($email) > 255) {
        header("Location: /views/users/settings.php?error=email");
        exit;
    }

    if($password != $user['password']) {
        header("Location: /views/users/settings.php?error=password");
        exit;
    }

    if($first_name != $user['first_name'] || $second_name != $user['second_name'] || $phone != $user['phone'] || $email != $user['email'] || $image != $user['image'] || $password != $user['password']) {
        
        mysqli_query($connect, "UPDATE users SET `first_name` = '$first_name', `second_name` = '$second_name', `phone` = '$phone', `image` = '$image', `email` = '$email', `password` = '$password' WHERE users.id = '$user_id'");
        
        if (move_uploaded_file($tempname, $folder)) {
            echo "Image uploaded successfully";
            // die(var_dump($connect));
        }else{
            $msg = "Failed to upload image";
        }

        header("Location: /views/users/settings.php?success=200");

    } else {
        header("Location: /views/users/settings.php?error=401");
        exit;
    }