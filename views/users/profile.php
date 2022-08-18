<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    $user = $_SESSION['user'];
    $user_id = $_SESSION['user']['id'];

    if(!isset($_GET['id'])) {
        header("Location: /friends.php?error=401");
    }

    $profile_id = $_GET['id'];

    $sql_profile_friends = "SELECT COUNT(*) AS total FROM friendship_requests 
    WHERE (friendship_requests.from_user_id = '$user_id' AND friendship_requests.to_user_id = '$profile_id') OR 
    (friendship_requests.from_user_id = '$profile_id' AND friendship_requests.to_user_id ='$user_id')";
    $profile_friends = mysqli_query($connect, $sql_profile_friends);
    // $friends = mysqli_fetch_assoc($friends);

    $sql_friends = "SELECT fead.id as id, 
    fead.from_user_id as from_user_id, 
    fead.to_user_id as to_user_id, 
    fead.status as status_friend, 
    fead.created_at as created_at,
    u1.id as user_ids,
    u1.first_name as first_name,
    u1.second_name as second_name,
    u1.phone as phone,
    u1.email as email,
    u1.image as image_user,
    u1.description as descriptione,
    u2.id as user_ids,
    u2.first_name as first_name,
    u2.second_name as second_name,
    u2.phone as phone,
    u2.email as email,
    u2.image as image_user,
    u2.description as descriptione
    FROM friendship_requests fead
    JOIN users u2 ON fead.to_user_id = u2.id
    JOIN users u1 ON fead.from_user_id = u1.id
    WHERE fead.from_user_id = '$profile_id' OR fead.to_user_id = '$profile_id'";
    $friends = mysqli_query($connect, $sql_friends);
    // die(var_dump($friends));

    $sql_profile = "SELECT * FROM users WHERE users.id = '$profile_id'";
    $profile = mysqli_query($connect, $sql_profile);
    $profile = mysqli_fetch_assoc($profile);

?>

<div class="container my-5">
    <div class="row">
        <div class="col-6 offset-1">
        <h3 class="h3 text-center">Профиль пользователя</h3>
            <div class="card my-5" style="width: 100%;">
                <img src="/views/images/<?= $profile['image'] ?>" class="card-img-top" alt="image_user">
                <div class="card-body">
                    <h5 class="card-title"><?= $profile['first_name'] ?> <?= $profile['second_name'] ?></h5>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            Телефон: <?= $profile['phone'] ?>
                        </li>
                        <li class="nav-item active">
                           E-mail: <?= $profile['email'] ?>
                        </li>
                    </ul>
                    <?php
                        foreach($profile_friends as $profile_friend) {
                            if($profile_friend['total'] <= 0) {
                                // die(var_dump($profile_friend));
                    ?>
                        <a href="/vendor/users/friend_request.php?to_user_id=<?= $profile_id ?>" class="btn btn-warning mt-3">Отправить дружбу</a>
                    <?php
                            } else {
                    ?>
                        <div class="alert alert-info my-3">Вы друзья</div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-4">
            <h3 class="h3 text-center">Друзья</h3>
            <?php
                foreach($friends as $friend) {
                    // if($user_id != $friend['user_ids'] && $friend['status_friend'] == 2 && $friend['to_user_id'] != $user_id) {
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
                    // } 
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