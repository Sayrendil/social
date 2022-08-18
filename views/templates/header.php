<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>V Y S E</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" 
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="/views/css/style.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            if(empty($_SESSION['user'])) {
        ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="index.php">V Y S E</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item ">
                                <a class="nav-link" href="/index.php">Главная</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/about.php">О нас</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/login.php">Войти</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register.php">Зарегистрироваться</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php
            } else {
        ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-info">
                <div class="container">
                    <a class="navbar-brand" href="#">V Y S E</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/index.php">Главная</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="/news.php">Новости</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="/messages.php">Сообщения</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="/friends.php">Друзья</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Аккаунт
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/views/users/my_profile.php">Мой Профиль</a>
                                    <a class="dropdown-item" href="/views/users/settings.php">Редактировать профиль</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/vendor/users/exit.php">Выход</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php
            }
        ?>