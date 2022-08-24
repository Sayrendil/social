<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(isset($_GET['id'])) {
        $post_id = $_GET['id'];
    }

    $sql_post = "SELECT * FROM posts WHERE id='$post_id'";
    $post = mysqli_query($connect, $sql_post);
    $post = mysqli_fetch_assoc($post);

?>

<div class="container my-5">
    <div class="row my-5">
        <div class="col-8">
            <h1 class="h1 text-center"><?= $post['title'] ?></h1>
            <p>
                <?= $post['content'] ?>
            </p>
        </div>
        <div class="col-4">
            <img src="/views/images/<?= $post['image'] ?>" class="img-fluid">
        </div>
        <a href="/news.php" class="btn btn-warning">Вернуться к новостям</a>
    </div>
</div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>