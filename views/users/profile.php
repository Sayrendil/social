<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    $user = $_SESSION['user'];
    $user_id = $_SESSION['user']['id'];

    $sql_friends = "SELECT `friendship_requests`.`id` as `id`, 
    friendship_requests.from_user_id as from_user_id, 
    friendship_requests.to_user_id as to_user_id, 
    friendship_requests.status as status_friend, 
    friendship_requests.created_at as created_at,
    users.id as user_ids,
    users.first_name as first_name,
    users.second_name as second_name,
    users.phone as phone,
    users.email as email,
    users.image as image_user,
    users.description as description
    FROM friendship_requests
    LEFT JOIN users ON friendship_requests.to_user_id = users.id
    OR friendship_requests.from_user_id = users.id
    WHERE friendship_requests.from_user_id = '$user_id' OR friendship_requests.to_user_id = '$user_id' AND friendship_requests.status = '2'";
    $friends = mysqli_query($connect, $sql_friends);

?>

<div class="container my-5">
    <div class="row">
        <div class="col-6 offset-1">
        <h3 class="h3 text-center">Мой Профиль</h3>
            <div class="card my-5" style="width: 100%;">
                <img src="/views/images/<?= $user['image'] ?>" class="card-img-top" alt="image_user">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['first_name'] ?> <?= $user['second_name'] ?></h5>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            Телефон: <?= $user['phone'] ?>
                        </li>
                        <li class="nav-item active">
                           E-mail: <?= $user['email'] ?>
                        </li>
                    </ul>
                    <a href="/views/users/settings.php" class="btn btn-warning mt-3">Редактировать</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <h3 class="h3 text-center">Друзья</h3>
            <?php
                foreach($friends as $friend) {
                    if($user_id != $friend['user_ids'] && $friend['status_friend'] == 2) {
            ?>
            <div class="card my-5" style="width: 100%;">
                <img src="/views/images/<?= $friend['image_user'] ?>" class="card-img-top" alt="image_user">
                <div class="card-body">
                    <h5 class="card-title"><?= $friend['first_name'] ?> <?= $friend['second_name'] ?></h5>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            Телефон: <?= $friend['phone'] ?>
                        </li>
                        <li class="nav-item active">
                           E-mail: <?= $friend['email'] ?>
                        </li>
                    </ul>
                    <a href="/views/messages/message.php?chat_id=<?= $friend['user_ids'] ?>" class="btn btn-info mt-3">Написать</a>
                </div>
            </div>
            <?php
                    } 
                    if(!isset($friends)) {
            ?>
                <div class="alert alert-light">У вас нет друзей)</div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>