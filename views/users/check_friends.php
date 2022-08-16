<?php

    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');

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
    LEFT JOIN users ON friendship_requests.from_user_id = users.id
    OR friendship_requests.to_user_id = users.id
    WHERE friendship_requests.to_user_id = '$user_id' OR friendship_requests.from_user_id = '$user_id' AND friendship_requests.status = '1'";
    $friends = mysqli_query($connect, $sql_friends);
    // $friends = mysqli_fetch_assoc($friends);

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

    <h1 class="text-center my-3">Заявки в Друзья</h1>
    <div class="row">
        <?php
            foreach($friends as $friend) {
                if($user_id != $friend['user_ids'] && $friend['status_friend'] == 1 && $friend['to_user_id'] == $user_id) {
        ?>
        <div class="col-4">
            <div class="card">
                <img src="/views/images/<?= $friend['image_user'] ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $friend['first_name'] ?> <?= $friend['second_name'] ?></h5>
                    <p class="card-text"><?= $friend['phone'] ?></p>
                    <a href="/vendor/users/verify_friends_request.php?verify=success" class="btn btn-primary">Принять</a>
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