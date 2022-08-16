<?php

    $filename = $_SERVER['DOCUMENT_ROOT'] . "/.env";
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    fclose($handle);

    $content = explode("\n", $contents);

    $db_password = "admin";
    $db_user = "admin";
    $db_name = "db";

    foreach($content as $row) {
        $conf = explode("=", $row);
        if($conf[0] == "db_user") {
            $db_user = trim($conf[1]);
        }
        if($conf[0] == "db_password") {
            $db_password = trim($conf[1]);
        }
        if($conf[0] == "db_name") {
            $db_name = trim($conf[1]);
        }
    }

    // var_dump($db_user, $db_password, $db_name);

    $connect = mysqli_connect('localhost', $db_user, $db_password, $db_name);
    mysqli_set_charset($connect, "utf8") or die('Не установлена кодировка!');

    if(!$connect) {
        die("Error to cennect to Database!");
    }

    // die(var_dump($contents));