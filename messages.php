<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    $user_id = $_SESSION['user']['id'];

    $sqlFriends = "SELECT `friendship_requests`.`id` as `id`, 
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
    JOIN users ON friendship_requests.to_user_id = users.id
    OR friendship_requests.from_user_id = users.id
    WHERE friendship_requests.from_user_id = '$user_id' OR friendship_requests.to_user_id = '$user_id' AND friendship_requests.status = '2'";
    $friends = mysqli_query($connect, $sqlFriends);

?>

<div class="container my-5">
    <h1 class="h1 text-center">Кому написать сообщение</h1>
    <div class="row">
        <div class="col-12">
            <?php
                foreach($friends as $friend) {
                    if($user_id != $friend['user_ids'] && $friend['status_friend'] == 2) {
            ?>
                <div class="card" style="width: 100%; text-align: center; margin: 0 0 10px 0;">
                    <div class="card-body d-flex">
                        <h5 class="card-title"><?= $friend['first_name'] ?> <?= $friend['second_name'] ?></h5>
                        <a href="/views/messages/message.php?chat_id=<?= $friend['user_ids'] ?>" class="btn btn-primary ml-auto">Написать</a>
                    </div>
                </div>
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