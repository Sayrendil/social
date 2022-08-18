<?php

    require($_SERVER['DOCUMENT_ROOT'] . "/config/db.php");
    include($_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php");

?>

    <div class="container my-5">
        <div class="alert alert-success">Вы успешно зарегистрировались</div>
        <a href="/login.php">Войти</a>
        <!-- <div class="row">
            <div class="col-8 offset-2">
                <form action="/vendor/users/email_verify.php" method="POST">
                    <div class="form-group">
                        <label for="token">Код подтверждения: </label>
                        <input type="text" class="form-control" name="token">
                    </div>
                    <button class="btn btn-info" type="submit">Отправить</button>
                </form>
            </div>
        </div> -->
    </div>

<?php

    include($_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php");

?>