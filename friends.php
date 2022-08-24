<?php

    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');

    $user_id = $_SESSION['user']['id'];

    if(isset($_GET['search'])) {
        $friend_id = $_GET['search'];
        $sql_friends_search = "SELECT * FROM users
        WHERE users.first_name = '$friend_id' OR users.second_name = '$friend_id'";
        $friend_users = mysqli_query($connect, $sql_friends_search);
        $friend_users = mysqli_fetch_assoc($friend_users);
    }

    $friend_sql1 = "SELECT * FROM friendship_requests 
    WHERE friendship_requests.from_user_id = '$user_id'";
    $friends_one = mysqli_query($connect, $friend_sql1);
    $friends_one = mysqli_fetch_all($friends_one);

    $friend_sql2 = "SELECT * FROM friendship_requests 
    WHERE friendship_requests.to_user_id = '$user_id'";
    $friends_two = mysqli_query($connect, $friend_sql2);
    $friends_two = mysqli_fetch_all($friends_two);

    $friends = array_merge_recursive($friends_one, $friends_two);

    $arr = array();

    foreach ($friends as $keys => $names) { 
        // die(var_dump($names));
        $names = array_slice($names, 1, 2);
        foreach ($names as $key => $name) {
            $arr[$key][] = $name;
            continue;
        }

    }

    unset($arr[$user_id]);

    foreach ($arr as $id => $val){
        $mas1[] = implode(", ", $val);
        $mas = implode(", ", $mas1);
    }

    $sql_users = "SELECT * FROM users WHERE NOT users.id IN($mas)";
    $users = mysqli_query($connect, $sql_users);

?>

<div class="container my-5">
    <h1 class="h1 text-center">Друзья</h1>
    <div class="row justify-content-center my-5">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="/views/users/my_friends.php" class="btn btn-secondary">Мои друзья</a>
            <a href="/views/users/check_friends.php" class="btn btn-secondary">Заявки в друзья</a>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-8 offset-2">
            <form action="/vendor/users/friend_search.php" method="GET" name="search" class="d-flex">
                <input type="text" class="form-control" name="friend_search" placeholder="Найти друга">
                <button class="btn btn-info" type="submit" name="search">Поиск</button>
            </form>
        </div>
    </div>
    <?php
        if(isset($_GET['search'])) {
    ?>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <img src="/views/images/<?= $friend_users['image'] ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $friend_users['first_name'] ?></h5>
                    <p class="card-text"><?= $friend_users['second_name'] ?></p>
                    <a href="/vendor/users/friend_request.php?to_user_id=<?= $friend_users['id'] ?>" class="btn btn-primary">Отправить заявку</a>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>

    <h1 class="text-center my-3">Найди возможного друга</h1>
    <div class="row">
        <?php
            foreach($users as $user) {
                    if($user['id'] != $user_id) {
        ?>
        <div class="col-4">
            <div class="card">
                <img src="/views/images/<?= $user['image'] ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['first_name'] ?> <?= $user['second_name'] ?></h5>
                    <p class="card-text"><?= $user['phone'] ?></p>
                    <a href="/views/users/profile.php?id=<?= $user['id'] ?>" class="btn btn-primary">Посмотреть профиль</a>
                </div>
            </div>
        </div>
        <?php
                }
            }
        ?>
    </div>
</div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>