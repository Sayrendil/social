<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    $sql_post = "SELECT * FROM posts";
    $posts = mysqli_query($connect, $sql_post);
    $posts = mysqli_fetch_all($posts);

    $user_id = $_SESSION['user']['id'];

?>

<div class="container my-5">
    <div class="row my-5">
        <h1 class="h1 text-center">Новости</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">
            Добавить пост
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление поста</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/vendor/posts/create.php" method="POST" enctype="multipart/form-data" name="create_post">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content">Описание</label>
                            <textarea name="content" id="content" cols="20" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Картинка</label>
                            <input type="file" name="image" class="form-control">
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

    <div class="row">
        <div class="col-12">
            <?php
                foreach($posts as $post) {
            ?>
            <div class="jumbotron">
                <h1 class="display-4"><?= $post[1] ?></h1>
                <img src="views/images/<?= $post[3] ?>" alt="" class="img-fluid">
                <hr class="my-4">
                <p><?= $post[2] ?></p>
                <a class="btn btn-primary" href="/views/posts/post.php?id=<?= $post[0] ?>">Подробнее</a>
                <?php
                    if($post[5] == $user_id) {
                ?>
                    <a class="btn btn-warning" href="/views/posts/edit.php?id=<?= $post[0] ?>">Редактировать</a>
                    <a class="btn btn-danger" href="/vendor/posts/destroy.php?id=<?= $post[0] ?>">Удалить</a>
                <?php
                    }
                ?>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>