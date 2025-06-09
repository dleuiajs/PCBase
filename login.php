<?php
// load functions
require_once("php/functions.php");
// load head
loadPart("head");
?>
<!-- body -->

<body class="main-layout inner_posituong computer_page">
    <!-- header -->
    <?php
    loadPart("header");
    ?>
    <!-- end header -->
    <?php
    $rand1 = rand(1, 9);
    $rand2 = rand(1, 9);
    echo '<div class="container my-5" style="max-width: 400px;">
        <h2>Prihlásenie</h2>
        <form id="request" action="thxyou_login.php" method="post">
            <input type="hidden" name="captcha1" value="' . $rand1 . '">
            <input type="hidden" name="captcha2" value="' . $rand2 . '">
            <div class="form-group mb-3">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Zadajte váš e-mail"
                    required>
            </div>
            <div class="form-group mb-4">
                <label for="heslo">Heslo:</label>
                <input type="password" class="form-control" id="heslo" name="heslo" placeholder="Zadajte vaše heslo"
                    required>
            </div>
            <div class="form-group mb-4">
                <label for="captcha">Koľko je ' . $rand1 . ' + ' . $rand2 . '?:</label>
                <input type="number" min="0" class="form-control" id="captcha" name="captcha" placeholder="Overte, že nie ste robot"
                    required>
            </div>
            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-primary">Prihlásiť sa</button>
                <a href="register.php" class="ms-3 text-decoration-underline" style="margin-left: 16px;">Registrovať
                    sa</a>
            </div>

        </form>';
    ?>
    <hr class="my-5">
    </div>
    <!--  footer -->
    <?php
    loadPart("footer");
    ?>
    <!-- end footer -->
</body>

</html>