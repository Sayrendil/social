<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    // die(var_dump($_POST['chat_id']));

    if(!isset($_SESSION['user'])) {
        header("Location: /messages.php?error=400");
        exit;
    }

    if(empty($_POST['message'])) {
        header("Location: /messages/message.php?chat_id=" . $_POST['chat_id']);
        exit;
    }

    $message = htmlspecialchars(rtrim($_POST['message']));
    $chat_id = $_POST['chat_id'];
    $created_at = date("Y-m-d H:i:s");
    $user_id = $_SESSION['user']['id'];

    // die(var_dump($user_id));

    if(strlen($message) < 0 && strlen($message) > 1255) {
        header("Location: /messages/message.php?error=first_name");
        exit;
    }

    mysqli_query($connect, "INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `text`, `craeted_at`) 
    VALUES (NULL, '$user_id', '$chat_id', '$message', '$created_at')");

    // die(var_dump($content));

    // die(var_dump($created_at));

    header('Location: /views/messages/message.php?chat_id='.$chat_id);

    exit;