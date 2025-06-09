<?php
require_once("php/functions.php");
loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php loadPart("header"); ?>
    </header>

    <?php
    echo '<div class="thxyou text-center">';

    // odosielanie údajov z formulára
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    require_once(__ROOT__ . "\php\pcbuildFunctions.php");
    use pcbuild\PcBuildFunctions;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $pcbuild = new PcBuildFunctions();
            $pcbuild->handler();
            echo '<h1>Ďakujeme za objednávku zostavy PC!</h1>';
            echo '<p>Spravíme vám zostavu PC do 3 dní</p>';
        } catch (Exception $e) {
            echo '<h1 class="text-danger">Chyba pri odosielaní údajov: ' . $e->getMessage() . '</h1>';
        }
    }
    echo '</div>';
    // načítanie dolnej časti stránky
    loadPart("footer");
    ?>
</body>

</html>