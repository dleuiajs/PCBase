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
</body>

</html>