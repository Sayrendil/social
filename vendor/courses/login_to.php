<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(empty($_SESSION['user'])) {
        header("Location: /index.php?error=auth");
        exit;
    }

    if(empty($_POST['course_id'])) {
        header("Location: /register.php?error=403");
        exit;
    }

    $course_id = htmlspecialchars(rtrim($_POST['course_id']));
    $user_id = $_SESSION['user']['id'];
    $entered = date("Y-m-d H:i:s");

    $sql = "SELECT * FROM learns WHERE learns.user_id = '$user_id'";
    $learn = mysqli_query($connect, $sql);
    $learn = mysqli_fetch_assoc($learn);

    // die(var_dump($learn));

    if(!empty($learn)) {
        header("Location: /programm.php?error=active");
        exit;
    }

    mysqli_query($connect, "INSERT INTO learns (`id`, `user_id`, `course_id`, `entered`, `finished`, `status`) 
    VALUES (NULL, '$user_id', '$course_id', '$entered', '$entered', '1')");

    header("Location: /programm.php?success=200");