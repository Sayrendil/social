<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');

    $user_id = $_SESSION['user']['id'];

    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $user = mysqli_query($connect, $sql);
    $user = mysqli_fetch_assoc($user);

?>

<div class="container my-5">
    <h1 class="h1 text-center">Изменение профиля</h1>
    <div class="row">
        <div class="col-12">
            <form action="/vendor/users/update.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" name="first_name" class="form-control" value="<?= $user['first_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="second_name">Фамилия</label>
                    <input type="text" name="second_name" class="form-control" value="<?= $user['second_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Почта</label>
                    <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="text" name="password" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="image">Фото Профиля</label>
                    <input type="file" name="image" class="form-control" value="<?= $user['image'] ?>">
                </div>
                <button class="btn btn-info" type="submit" name="update_user"> Изменить данные</button>
            </form>
        </div>
    </div>
</div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');

?>