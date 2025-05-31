<?php
require_once("php/functions.php");
loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php
        loadPart("header"); ?>
    </header>

    <?php
    require_once("php/productsFunctions.php");
    use products\ProductsFunctions;
    $productsFunctions = new ProductsFunctions();
    $productsFunctions->generateWriteReviewForm();
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