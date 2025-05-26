<?php
require_once("php/functions.php");
loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php
        loadPart("header");
        require_once("php/productsFunctions.php");
        use products\ProductsFunctions;
        $productsFunctions = new ProductsFunctions();
        ?>
    </header>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $productsFunctions->buyProduct($_POST['product_id'], $_SESSION['user_id']);
            echo '<div class="thxyou text-center">
                                <h1>Ďakujeme za váš nákup!</h1>
                                <p>Váš tovar bude doručený v priebehu 2-3 dní</p>
                            </div>';
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Chyba pri nákupe produktu: " . $e->getMessage() . "</div>";
        }
    }
    ?>
    <?php loadPart("footer"); ?>

    <!-- Javascript files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>