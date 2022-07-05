<?php
    require('../social/config/db.php');
    include('../social/views/templates/header.php');

?>

    <section class="intro">
        <div class="intro-black">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Welcome To Social Media Network</h1>
                        <p>Please Click to registration</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news">
        <div class="container my-5">
            <div class="row">
                <div class="col-6">
                    <div class="card" style="width: 100%;">
                        <img src="" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
    include('../social/views/templates/footer.php');
?>