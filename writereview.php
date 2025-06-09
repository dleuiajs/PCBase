<?php
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
WebFunc::loadPart("head");
?>

<body class="main-layout inner_posituong">
    <?php
    // načítanie hlavičky
    WebFunc::loadPart("header");

    require_once("php/productsFunctions.php");
    use products\ProductsFunctions;
    $productsFunctions = new ProductsFunctions();
    $productsFunctions->generateWriteReviewForm();
    // načítanie dolnej časti stránky
    WebFunc::loadPart("footer");
    ?>
</body>

</html>