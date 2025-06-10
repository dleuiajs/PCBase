<?php
// load functions
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
// load head
WebFunc::loadPart("head");
?>
<!-- body -->

<body class="main-layout inner_posituong computer_page">
    <!-- header -->
    <?php
    WebFunc::loadPart("header");
    $rand1 = rand(1, 9);
    $rand2 = rand(1, 9);
    // <!-- end header -->
    echo '<div class="container my-5" style="max-width: 400px;">
        <h2>Registrácia</h2>
        <form id="request" action="thxyou_register.php" method="post">
            <input type="hidden" name="captcha_result" value="' . $rand1 + $rand2 . '">
            <div class="form-group mb-3">
                <label for="meno">Meno:</label>
                <input class="form-control" id="meno" name="meno" placeholder="Zadajte váše meno" required>
            </div>

            <div class="form-group mb-3">
                <label for="priezvisko">Priezvisko:</label>
                <input class="form-control" id="priezvisko" name="priezvisko" placeholder="Zadajte váše priezvisko"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Zadajte váš e-mail"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="heslo">Heslo:</label>
                <input type="password" class="form-control" id="heslo" name="heslo" placeholder="Zadajte vaše heslo"
                    required>
            </div>
            <div class="form-group mb-4">
                <label for="heslo_confirm">Potvrďte heslo:</label>
                <input type="password" class="form-control" id="heslo_confirm" name="heslo_confirm"
                    placeholder="Zopakujte vaše heslo" required>
            </div>
            <div class="form-group mb-4">
                <label for="captcha">Koľko je ' . $rand1 . ' + ' . $rand2 . '?:</label>
                <input type="number" min="0" class="form-control" id="captcha" name="captcha" placeholder="Overte, že nie ste robot"
                    required>
            </div>
            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-primary">Registrovať sa</button>
                <a href="login.php" class="ms-3 text-decoration-underline" style="margin-left: 16px;">Prihlásiť sa</a>
            </div>
        </form>
        <hr class="my-5">
    </div>';
    ?>
    <!--  footer -->
    <?php WebFunc::loadPart("footer"); ?>
    <!-- end footer -->
</body>

</html>