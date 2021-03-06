<?php

    require("Location: ../../config/db.php");
    include("../social/views/templates/header.php");

?>

    <div class="container my-5">
        <h1 class="h1 text-center">Активация Аккаунта</h1>
        <p class="text-center">
            Вам на почту был выслан код для подтверждения аккаунта (Проверьте вкладку спама!)
        </p>
        <div class="row">
            <div class="col-8 offset-2">
                <form action="../social/vendor/users/email_verify.php" method="POST">
                    <div class="form-group">
                        <label for="token">Код подтверждения: </label>
                        <input type="text" class="form-control" name="token">
                    </div>
                    <button class="btn btn-info" type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>

<?php

    include("../social/views/templates/footer.php");

?>