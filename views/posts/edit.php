<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(!isset($_GET['id'])) {
        header("Location: /index.php");
    }

    $post_id = $_GET['id'];

    $sql_post = "SELECT * FROM posts WHERE id='$post_id'";
    $post = mysqli_query($connect, $sql_post);
    $post = mysqli_fetch_assoc($post);

?>

<div class="container my-5">
    <div class="row my-5">
        <h1 class="h1 text-center">Редактирование новости</h1>
    </div>
    <form action="/vendor/posts/update.php" method="POST" enctype="multipart/form-data" name="update_post">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" class="form-control" value="<?= $post['title'] ?>">
        </div>
        <div class="form-group">
            <label for="content">Описание</label>
            <textarea name="content" id="content" cols="20" rows="10" class="form-control"><?= $post['content'] ?></textarea>
        </div>
        <div class="form-group">
            <img src="views/images/<?= $post['image'] ?>" value="<?= $post['image'] ?>">
            <input type="file" name="image" class="form-control" value="<?= $post['image'] ?>">
        </div>
        <input type="hidden" name="old_image" value="<?= $post['image'] ?>">
        <button class="btn btn-info" type="submit" name="update_post" value="<?= $post_id ?>">Изменить</button>
    </form>
</div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>