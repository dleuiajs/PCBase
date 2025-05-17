<?php
require_once("php/functions.php");
loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php loadPart("header"); ?>
    </header>

    <div class="container my-5 text-center" style="max-width: 400px;">
        <div class="mb-2">
            <?php
            require_once(__ROOT__ . "\php\users.php");
            use users\Users;
            $users = new Users();
            // načítanie údajov o používateľovi
            echo "Dobrý deň, " . $users->getName() . "!<br>";
            echo "Vasa rola je: " . $users->getRole() . "<br>";
            ?>
        </div>
        <a href="?logout=true" class="text-decoration-underline">Odhlásiť sa</a>
        <?php
        if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
            $users->logout();
            header("Location: /");
            exit();
        }
        ?>
    </div>

    <?php
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