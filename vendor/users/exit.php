<?php

    session_start();

    if(!isset($_SESSION['user'])) {
        header("Location: /index.php?error=400");
        exit;
    }

    if(!isset($_POST['clear'])) {
        header("Location: /index.php?error=403");
    }

    session_destroy();

    header("Location: /index.php?success=200");