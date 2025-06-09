<?php
require_once("php/functions.php");
loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php loadPart("header"); ?>
    </header>

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

    <?php loadPart("footer"); ?>
</body>

</html>