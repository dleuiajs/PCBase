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
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (in_array($_SESSION['user_idrola'], [4, 5])) {
            $id = $_GET['id'] ?? null;
            $action = $_GET['action'] ?? null;
            if ($id !== null) {
                if ($action != "remove")
                    $productsFunctions->generateEditProductsForm($id);
                else {
                    echo $productsFunctions->removeProduct($id);
                }
            } else {
                echo '<div class="alert alert-danger text-center">Chyba: Neplatný ID produktu.</div>';
            }
        }
        else {
            echo '<div class="alert alert-danger text-center">Chyba: Nemáte oprávnenie na úpravu produktov.</div>';
        }
    }
    ?>
    <?php loadPart("footer"); ?>
</body>

</html>