<?php
require_once("php/functions.php");
loadPart("head");
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
                    $users->handlerRegister();
                } catch (Exception $e) {
                    $userException = $e->getMessage();
                }
            }
        }
        loadPart("header");
        ?>
    </header>

    <?php
    echo '<div class="thxyou text-center">';

    // odosielanie údajov z formulára
    if ($userException == null) {
        echo '<h1>Váš účet bol úspešne zaregistrovaný!</h1>';
        echo '<p>Vitajte na PCBASE!</p>';
    } else {
        echo '<h1 class="text-danger">Chyba pri registrácii: ' . $userException . '</h1>';
    }
    echo '</div>';
    // načítanie dolnej časti stránky
    loadPart("footer");
    ?>
</body>

</html>