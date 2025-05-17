<?php
require_once("php/functions.php");
loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php
        $userException = null;
        error_reporting(E_ALL);
        ini_set("display_errors", "On");
        require_once(__ROOT__ . "\php\users.php");
        use users\Users;
        // načítanie údajov o používateľovi
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $users = new Users();
                $users->handlerLogin();
            } catch (Exception $e) {
                $userException = $e->getMessage();
            }
        }
        loadPart("header"); ?>
    </header>

    <?php
    echo '<div class="thxyou text-center">';

    // odosielanie údajov z formulára
    if ($userException == null) {
        echo '<h1>Úspešne ste sa prihlásili do účtu!</h1>';
        echo '<p>Vitajte na PCBASE!</p>';
    } else {
        echo '<h1 class="text-danger">Chyba pri prihlásení: ' . $userException . '</h1>';
    }
    echo '</div>';
    // načítanie dolnej časti stránky
    loadPart("footer");
    ?>

    <!-- Javascript files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>