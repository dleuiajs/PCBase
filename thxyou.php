<?php
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
WebFunc::loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php
        WebFunc::loadPart("header");
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
    <?php WebFunc::loadPart("footer"); ?>
</body>

</html>