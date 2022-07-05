<?php
    include('../social/views/templates/header.php');
    require('../social/config/db.php');
?>

    <div class="container my-5">
        <h1 class="h1 text-center">Авторизация</h1>
        <div class="row">
            <div class="col-8 offset-2">
                <form action="../social/vendor/users/auth.php" method="POST" name="auth_user">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button class="btn btn-info" type="submit" name="auth_user">Войти</button>
                </form>
            </div>
        </div>
    </div>

<?php
    include('../social/views/templates/footer.php');
?>