<?php
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
WebFunc::loadPart("head");
?>

<body class="main-layout inner_posituong">
    <?php
    // načítanie hlavičky
    WebFunc::loadPart("header");

    echo '<div class="thxyou text-center">';

    // odosielanie údajov z formulára
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    require_once(__ROOT__ . "\php\contactFunctions.php");
    use contact\ContactFunctions;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $contact = new ContactFunctions();
            $contact->handlerContact();
            echo '<h1>Ďakujeme za kontakt s nami!</h1>';
            echo '<p>Odpovieme vám v priebehu 24 hodín.</p>';
        } catch (Exception $e) {
            echo '<h1 class="text-danger">Chyba pri odosielaní údajov: ' . $e->getMessage() . '</h1>';
        }
    }
    echo '</div>';
    // načítanie dolnej časti stránky
    WebFunc::loadPart("footer");
    ?>
</body>

</html>