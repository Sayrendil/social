<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(!empty($_SESSION['user'])) {
        header("Location: /index.php?error=auth");
        exit;
    }

    if(!isset($_POST['create_user'])) {
        header("Location: /register.php?error=400");
        exit;
    }

    if(empty($_POST['first_name'] && $_POST['second_name'] && $_POST['phone'] && $_FILES['image'] && $_POST['email'] && $_POST['password'])) {
        header("Location: /register.php?error=403");
    }

    $first_name = htmlspecialchars(rtrim($_POST['first_name']));
    $second_name = htmlspecialchars(rtrim($_POST['second_name']));
    $phone = htmlspecialchars(rtrim($_POST['phone']));
    $email = htmlspecialchars(rtrim($_POST['email']));
    $image = $_FILES['image']['name'];
    $password = htmlspecialchars(rtrim($_POST['password']));
    $created_at = date("Y-m-d H:i:s");
    $token = uniqid();
    $status = 1;

    if(mb_strlen($first_name) < 3 && mb_strlen($first_name) > 255) {
        header("Location: /register.php?error=first_name");
    }

    if(mb_strlen($second_name) < 3 && mb_strlen($second_name) > 255) {
        header("Location: /register.php?error=second_name");
    }

    if(mb_strlen($phone) < 10 && mb_strlen($phone) > 13) {
        header("Location: /register.php?error=phone");
    }

    if(mb_strlen($email) < 5 && mb_strlen($email) > 255) {
        header("Location: /register.php?error=email");
    }

    if(mb_strlen($password) < 8 && mb_strlen($password) > 255) {
        header("Location: /register.php?error=password");
    }

    $tempname = $_FILES["image"]["tmp_name"];  

    $folder = $_SERVER['DOCUMENT_ROOT'] . "/views/images/".$image;

    mysqli_query($connect, "INSERT INTO users (`id`, `first_name`, `second_name`, `phone`, `image`, `password`, `email`, `description`, `created_at`, `restore_password_token`, `status`) 
    VALUES (NULL, '$first_name', '$second_name', '$phone', '$image', '$password', '$email', NULL, '$created_at', '$token', '$status')");

    // die(var_dump($connect));

    if (move_uploaded_file($tempname, $folder)) {
        header("Location: /verify.php?success=200");
        // die(var_dump($connect));
    }else{
        header("Location: /register.php?error=408");
    }

    // $to  = "<daniyarsigaev@gmail.com>, <daniyarsigaev@mail.ru>" ; 
    // $to .= "daniyarsigaev@mail.ru>"; 

    // $subject = "Регистрация на сайте V Y S E"; 

    // $message = ' <p>Ваш код для регистрации</p> </br> <b>' . $token . ' </b> </br><i>Введите данный код для активации аккаунта </i> </br>';

    // $headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
    // $headers .= "From: От кого письмо <wolfdesignstudio@gmail.com>\r\n"; 
    // $headers .= "Reply-To: wolfdesignstudio@gmail.com\r\n"; 

    // mail($to, $subject, $message, $headers);

    // die(var_dump(mail($to, $subject, $headers)));