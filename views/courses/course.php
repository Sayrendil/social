<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    if(isset($_GET['id'])) {
        $course_id = $_GET['id'];
    }

    $sql_course = "SELECT * FROM courses WHERE id='$course_id'";
    $course = mysqli_query($connect, $sql_course);
    $course = mysqli_fetch_assoc($course);

?>

<div class="container my-5">
    <div class="row my-5">
        <div class="col-8 offset-3">
            <h1 class="h1 text-center"><?= $course['name'] ?></h1>
            <p>
                <?= $course['content'] ?>
            </p>
        </div>
        <a href="/programm.php" class="btn btn-warning">Вернуться к курсам</a>
    </div>
</div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>