<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
?>

    <div class="container my-5">
        <h1 class="h1 text-center">Регистрация</h1>
        <div class="row">
            <div class="col-8 offset-2">
                <form action="/vendor/users/create.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Имя</label>
                        <input type="text" name="first_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Фамилия</label>
                        <input type="text" name="second_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Телефон</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Пароль</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Фото профиля</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <button class="btn btn-success" name="create_user">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>

<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php');
?>