<?php

    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');

    $user_id = $_SESSION['user']['id'];

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

    $sql_users = "SELECT * FROM users WHERE users.id IN($mas) AND NOT users.id IN($user_id)";
    $friends = mysqli_query($connect, $sql_users);

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

<h1 class="text-center my-3">Мои Друзья</h1>
    <div class="row">
        <?php
            foreach($friends as $friend) {
                // if($friend['to_user_id'] != $user_id || $friend['from_user_id'] == $user_id) {
        ?>
        <div class="col-4">
            <div class="card">
                <img src="/views/images/<?= $friend['image'] ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $friend['first_name'] ?> <?= $friend['second_name'] ?></h5>
                    <p class="card-text"><?= $friend['phone'] ?></p>
                    <a href="/views/messages/message.php?chat_id=<?= $friend['id'] ?>" class="btn btn-primary">Написать</a>
                </div>
            </div>
        </div>
        <?php
                // }
            }
        ?>
    </div>
</div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>