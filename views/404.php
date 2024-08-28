<?php $PageTitle = "404 ERROR"; 
include "templates/header.php" ?>

    <div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
        <div>
            <h1 class="display-1 fw-bold text-white text-center">404</h1> <br>
            <h1 class="display-1 fw-bold text-white text-center">Page requested not found.</h1>
            <h1>
            <?php 
            $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
            var_dump($uri);
            ?>
            </h1>
        </div>
    </div>

<?php include "templates/footer.php" ?>