<?php
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
WebFunc::loadPart("head");
?>

<body class="main-layout inner_posituong">
    <?php WebFunc::loadPart("header"); ?>

    <?php
    $id = $_GET['id'] ?? null;
    if ($id === null) {
        header("Location: products.php");
        exit();
    }
    require_once("php/productsFunctions.php");
    use products\ProductsFunctions;
    $productsFunctions = new ProductsFunctions();
    $productsFunctions->generateProduct($id);
    ?>

    <?php WebFunc::loadPart("footer"); ?>
</body>

</html>