<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    $user_id = $_SESSION['user']['id'];

    if(isset($_GET['chat_id'])) {
        $chat_id = $_GET['chat_id'];
    }

    $sql_messages_from = "SELECT 
    u1.id as user_ids,
    u1.first_name as first_name,
    u1.second_name as second_name,
    u1.phone as phone,
    u2.id as user_ids,
    u2.first_name as first_name,
    u2.second_name as second_name,
    u2.phone as phone,
    n.id as message_id,
    n.from_user_id as from_user_id,
    n.to_user_id as to_user_id,
    n.text as message_text,
    n.craeted_at as messages_created_at 
    FROM messages n
    JOIN users u1 ON n.from_user_id = u1.id
    JOIN users u2 ON n.to_user_id = u2.id
    WHERE n.from_user_id = '$user_id' AND n.to_user_id = '$chat_id' OR n.to_user_id = '$user_id' AND n.from_user_id = '$chat_id'";
    $messages = mysqli_query($connect, $sql_messages_from);
    $messages = mysqli_fetch_all($messages);

    // die(var_dump($messages));



?>

<div class="container my-5">
    <h1 class="h1 text-center">Сообщения</h1>
    <div class="row">
        <div class="col-12">
            <div class="card" style="width: 100%; margin: 0 0 10px 0;">
            <?php
            if(!empty($messages)) {
                foreach($messages as $message) {
                    // if($message === $user_id){
                    if($message[9] == $user_id || $message[10] != $user_id) {
            ?>
                <div class="card-body ml-auto" style="border: 1px solid #000;">
                        <h4 class="card-title">Пользователь: <?= $message[1] ?></h4>
                        <p class="card-text"><?= $message[11] ?> <span style="font-size: 10px;"><?= $message[12] ?></span></p>
                </div>
            <?php
                    }
                    if($message[10] != $chat_id || $message[9] == $chat_id) {
            ?>
                <div class="card-body mr-auto" style="border: 1px solid #000;">
                    <h4 class="card-title">Пользователь: <?= $message[1] ?></h4>
                    <p class="card-text"><?= $message[11] ?> <span style="font-size: 10px;"><?= $message[12] ?></span></p>
                </div>
            <?php
                    }
                }
            // }
            } else {
            ?>
            </div>
                <div class="card" style="width: 100%; text-align: center; margin: 0 0 10px 0;">
                    <div class="card-body d-flex">
                        <p class="card-text">Сообщений нет</p>
                    </div>
                </div>
            <?php
                }
            
            // die(var_dump($chat_id));
            ?>
            <form action="/vendor/messages/create.php" method="POST" name="create_message">
                <input type="hidden" value="<?= $chat_id ?>" name="chat_id">
                <textarea name="message" id="message" cols="30" rows="5" class="form-control mb-3"></textarea>
                <button class="btn btn-info btn_message" name="create_message" type="submit">Отправить</button>
            </form>
            <div class="mess">

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('.message_form').submit(function(e) {
        e.preventDefault();
        let th = $(this);
        let mess = $('.mess');
        let btn = th.find('.btn_message');

        btn.addClass('progress_bar_stripped progress_bar_animated');

        $.ajax({
            url: '/vendor/messages/create.php',
            type: 'POST',
            data: th.serialize(),
            success: function(data) {

                if(data == 1) {
                    btn.removeClass('progress_bar_stripped progress_bar_animated');
                    mess.html('<div class="alert alert-danger">Email введен не верно</div>');
                    return false;
                } else {
                    btn.removeClass('progress_bar_stripped progress_bar_animated');
                    mess.html('<div class="alert alert-success">Сообщение успешно отправлено</div>');
                    setTimeout(function() {
                        th.trigger('reset');
                    }, 3000);
                }
                btn.removeClass('progress_bar_stripped progress_bar_animated');
                mess.html('<div class="alert alert-success">Сообщение успешно отправлено</div>');

            }, error: function() {
                mess.html('<div class="alert alert-danger">Ошибка отправки</div>');
                btn.removeClass('progress_bar_stripped progress_bar_animated');
            }
        });
    });
</script>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>