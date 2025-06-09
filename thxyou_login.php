<?php
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
WebFunc::loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php
        $userException = null;
        error_reporting(E_ALL);
        ini_set("display_errors", "On");
        require_once(__ROOT__ . "\php\users.php");
        use users\Users;
        // načítanie údajov o používateľovi
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['captcha'] != $_POST['captcha1'] + $_POST['captcha2']) {
                $userException = "Nesprávny výsledok CAPTCHA!";
            } else {
                try {
                    $users = new Users();
                    $users->handlerLogin();
                } catch (Exception $e) {
                    $userException = $e->getMessage();
                }
            }
        }
        WebFunc::loadPart("header"); ?>
    </header>

    <?php
    echo '<div class="thxyou text-center">';

    // odosielanie údajov z formulára
    if ($userException == null) {
        echo '<h1>Úspešne ste sa prihlásili do účtu!</h1>';
        echo '<p>Vitajte na PCBASE!</p>';
    } else {
        echo '<h1 class="text-danger">Chyba pri prihlásení: ' . $userException . '</h1>';
    }
    echo '</div>';
    // načítanie dolnej časti stránky
    WebFunc::loadPart("footer");
    ?>
</body>

</html>