<?php

    $connect = mysqli_connect('localhost','root', '', 'social');
    mysqli_set_charset($connect, "utf8") or die('Не установлена кодировка!');

    if(!$connect) {
        die("Error to cennect to Database!");
    }