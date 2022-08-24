<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    $user_id = $_SESSION['user']['id'];

    $sql_course = "SELECT * FROM courses";
    $courses = mysqli_query($connect, $sql_course);
    $courses = mysqli_fetch_all($courses);

    if(isset($_GET['error'])) {
        if($_GET['error'] == 'active') {
            $error = $_GET['error'];
        }
    } elseif(isset($_GET['success'])) {
        if($_GET['success'] == 200) {
            $success = $_GET['success'];
        }
    }

?>

<div class="container my-5">
    <div class="row my-5">
        <h1 class="h1 text-center">Программа курса</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <?php
                if(isset($success)) {
            ?>
                <div class="alert alert-success">Вы успешно записаны на курс</div>
            <?php
                }
                if(isset($error)) {
            ?>
                <div class="alert alert-danger">Вы уже записаны на курс</div>
            <?php
                }
                foreach($courses as $course) {
            ?>
            <div class="jumbotron">
                <h1 class="display-4"><?= $course[1] ?></h1>
                <hr class="my-4">
                <div class="d-flex">
                    <a class="btn btn-primary mr-3" href="/views/courses/course.php?id=<?= $course[0] ?>">Подробнее</a>
                    <form action="/vendor/courses/login_to.php" method="POST">
                        <button type="submit" class="btn btn-success" value="<?= $course[0] ?>" name="course_id">Записаться</button>
                    </form>
                </div>
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