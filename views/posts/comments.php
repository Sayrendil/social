<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(isset($_GET['id'])) {
        $post_id = $_GET['id'];
    }

    if(isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
    }

    $sql_post = "SELECT post_comments.id as comment_id, 
    users.id as usr_id, 
    users.first_name as first_name, 
    users.second_name as second_name, 
    post_comments.text as comment, 
    post_comments.user_id as comment_user_id, 
    post_comments.post_id as comment_post_id,
    post_comments.parent_id as comment_parent_id,
    posts.id as post_id,
    posts.title as post_title,
    posts.content as post_content
    FROM `post_comments`
    LEFT JOIN users ON users.id = post_comments.user_id
    LEFT JOIN posts ON posts.id = post_comments.post_id
    WHERE post_comments.post_id = '$post_id'";
    $comments = mysqli_query($connect, $sql_post);
    // $comments = mysqli_fetch_all($comments);

    // die(var_dump($comments));

?>

<div class="container my-5">
    <div class="row my-5">
        <h1 class="h1 text-center">Комментарии</h1>
        <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#ModalComment">
            Добавить Комментарий
        </button>
    </div>
        <?php
            foreach($comments as $comment) {
        ?>
        <ul class="list-group">
            <li class="list-group-item">
                <?php
                    if($comment['comment_parent_id'] <= 0) {
                ?>
                <?= $comment['first_name'] ?> <?= $comment['second_name'] ?>: <?= $comment['comment'] ?>
                <?php
                    }
                ?>
            </li>
            <li class="list-group-item">
                <?php
                    if(isset($comment)) {
                ?>
                <form action="/vendor/posts/create_comment.php" method="POST" name="create_comment">
                    <div class="form-group">
                        <label for="comment">Комментарий</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <input type="hidden" value="<?= $user_id ?>" name="user_id">
                    <input type="hidden" value="1" name="parent_id">
                    <input type="hidden" value="<?= $post_id ?>" name="post_id">
                    <button type="submit" class="btn btn-info" name="create_comment">Отправить</button>
                </form>
                <?php
                    }
                ?>
            </li>
            
        </ul>

        <?php
            }
        ?>
</div>

    <!-- Modal -->
    <div class="modal fade" id="ModalComment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление Комментария</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/vendor/posts/create.php" method="POST" enctype="multipart/form-data" name="create_post">
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <input type="text" name="comment" class="form-control">
                        </div>
                        <button class="btn btn-info" type="submit" name="create_post">Опубликовать</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" name="create_post">Отмена</button>
                </div>
            </div>
        </div>
    </div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>