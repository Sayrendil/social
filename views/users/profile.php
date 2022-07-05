<?php

    session_start();
    include('../../views/templates/header.php');
    require('../../config/db.php');

    $user = $_SESSION['user'];

?>

<div class="container my-5">
    <h1 class="h1 text-center">Мой Профиль</h1>
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card my-5" style="width: 100%;">
                <img src="../images/<?= $user['image'] ?>" class="card-img-top" alt="image_user">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['first_name'] ?> <?= $user['second_name'] ?></h5>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            Телефон: <?= $user['phone'] ?>
                        </li>
                        <li class="nav-item active">
                           E-mail: <?= $user['email'] ?>
                        </li>
                    </ul>
                    <a href="/views/users/settings.php" class="btn btn-warning mt-3">Редактировать</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

    include('../../views/templates/footer.php');

?>