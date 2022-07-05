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
        <link rel="stylesheet" href="views/css/style.css">
    </head>
    <body>
        <?php
            if(empty($_SESSION['user'])) {
        ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="/social/index.php">V Y S E</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item ">
                                <a class="nav-link" href="/social/index.php">Главная</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/social/about.php">О нас</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/social/login.php">Войти</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/social/register.php">Зарегистрироваться</a>
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
                                <a class="nav-link" href="/social/index.php">Главная</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="/social/news.php">Новости</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="/social/messages.php">Сообщения</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="/social/friends.php">Друзья</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Аккаунт
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/social/views/users/profile.php">Мой Профиль</a>
                                    <a class="dropdown-item" href="/social/views/users/settings.php">Редактировать профиль</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/social/vendor/users/exit.php">Выход</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php
            }
        ?>