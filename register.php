<?php
// load functions
require_once("php/functions.php");
// load head
loadPart("head");
?>
<!-- body -->

<body class="main-layout inner_posituong computer_page">
    <!-- header -->
    <?php loadPart("header"); ?>
    <!-- end header -->
    <div class="container my-5" style="max-width: 400px;">
        <h2>Registrácia</h2>
        <form id="request" action="thxyou_register.php" method="post">
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
            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-primary">Registrovať sa</button>
                <a href="login.php" class="ms-3 text-decoration-underline" style="margin-left: 16px;">Prihlásiť sa</a>
            </div>
        </form>
        <hr class="my-5">
    </div>
    <!--  footer -->
    <?php loadPart("footer"); ?>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>ms-3 text-decoration-underline
<hr class="my-5">
<!--  footer -->
<!-- end footer -->
<!-- Javascript files-->
<!-- sidebar -->