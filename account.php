<?php
require_once("php/functions.php");
loadPart("head");

require_once(__ROOT__ . "\php\users.php");
use users\Users;
$users = new Users();
if (!$users->isLoggedIn()) {
    header("Location: login.php");
    exit();
}
$users->reloadData();
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    $users->logout();
    header("Location: /");
    exit();
}
?>

<body class="main-layout inner_posituong">
    <header>
        <?php loadPart("header"); ?>
    </header>

    <div class="container my-5" style="max-width: 800px;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="?page=details">Podrobnosti o používateľovi</a>
                    </li>
                    <li class="list-group-item">
                        <a href="?page=edit">Upraviť profil</a>
                    </li>
                    <li class="list-group-item">
                        <a href="?page=security">Bezpečnosť</a>
                    </li>
                </ul>
            </div>
            <!-- Content -->
            <div class="col-md-8">
                <?php
                function valueOrSession($key, $sessionKey)
                {
                    return (isset($_POST[$key]) && $_POST[$key] !== '') ? $_POST[$key] : $_SESSION[$sessionKey];
                }

                function getSessionValue($key)
                {
                    return !empty($_SESSION[$key]) ? $_SESSION[$key] : 'Neuvedené';
                }

                $page = isset($_GET['page']) ? $_GET['page'] : 'details';
                $securityEdit = isset($_GET['edit']) ? $_GET['edit'] : null;

                switch ($page) {
                    case 'details':
                        echo "<div>";
                        echo "<h2>Podrobnosti o používateľovi</h2>";
                        echo "Dobrý deň, <b>" . $users->getName() . "</b>!<br>";
                        echo "Vaša rola je: <b>" . $users->getRole() . "</b><br>";
                        echo "</div>";

                        echo "<div class='mt-2'>";
                        echo "Váš email je: <b>" . getSessionValue('user_email') . "</b><br>";
                        echo "Vaše telefónne číslo je: <b>" . getSessionValue('user_tel_cislo') . "</b><br>";
                        echo "</div>";

                        echo "<div class='mt-2'>";
                        echo "Vaša krajina je: <b>" . getSessionValue('user_krajina') . "</b><br>";
                        echo "Vaše mesto je: <b>" . getSessionValue('user_mesto') . "</b><br>";
                        echo "Vaše PSČ je: <b>" . getSessionValue('user_psc') . "</b><br>";
                        echo "Vaša ulica je: <b>" . getSessionValue('user_ulica') . "</b><br>";
                        echo "Vaše číslo domu je: <b>" . getSessionValue('user_cislo_domu') . "</b><br>";
                        echo '<div class="mt-2">
                                <a href="?logout=true" class="text-decoration-underline">Odhlásiť sa</a>
                                </div>';
                        echo "</div>";
                        break;

                    case 'edit':
                        echo '<h2>Upraviť profil</h2>';
                        echo '<form id="request" action="#editInfo" method="post">
                                    <div class="form-group mb-3">
                                        <label for="meno">Meno:</label>
                                        <input class="form-control" id="meno" name="meno" placeholder="Zadajte váše meno">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="priezvisko">Priezvisko:</label>
                                        <input class="form-control" id="priezvisko" name="priezvisko" placeholder="Zadajte váše priezvisko">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tel_cislo">Telefónne číslo:</label>
                                        <input class="form-control" type="tel" id="tel_cislo" name="tel_cislo"
                                            placeholder="Zadajte vaše telefónne číslo">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="krajina">Krajina:</label>
                                        <input class="form-control" id="krajina" name="krajina" placeholder="Zadajte vašu krajinu">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="mesto">Mesto:</label>
                                        <input class="form-control" id="mesto" name="mesto" placeholder="Zadajte vaše mesto">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="psc">PSČ:</label>
                                        <input class="form-control" id="psc" name="psc" placeholder="Zadajte vaše PSČ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="ulica">Ulica:</label>
                                        <input class="form-control" id="ulica" name="ulica" placeholder="Zadajte vašu ulicu">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="cislo_domu">Číslo domu:</label>
                                        <input class="form-control" type="number" min="0" step="1" id="cislo_domu" name="cislo_domu"
                                            placeholder="Zadajte číslo domu">
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width:50%;">Uložiť</button>
                                </form>';
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            try {
                                // ak je formulár prázdny, vyhodíme výnimku
                                if (empty($_POST['meno']) && empty($_POST['priezvisko']) && empty($_POST['tel_cislo']) && empty($_POST['krajina']) && empty($_POST['mesto']) && empty($_POST['psc']) && empty($_POST['ulica']) && empty($_POST['cislo_domu'])) {
                                    throw new Exception("Žiadne údaje na aktualizáciu.");
                                }
                                // ak je formulár odoslaný, upravíme profil
                                $users->editProfile(
                                    valueOrSession('meno', 'user_meno'),
                                    valueOrSession('priezvisko', 'user_priezvisko'),
                                    valueOrSession('tel_cislo', 'user_tel_cislo'),
                                    valueOrSession('krajina', 'user_krajina'),
                                    valueOrSession('mesto', 'user_mesto'),
                                    valueOrSession('psc', 'user_psc'),
                                    valueOrSession('ulica', 'user_ulica'),
                                    valueOrSession('cislo_domu', 'user_cislo_domu')
                                );
                                echo '<p id="editInfo" class="text-success mt-3">Profil bol aktualizovaný.</p>';
                            } catch (Exception $e) {
                                echo '<p id="editInfo" class="text-danger mt-3">' . $e->getMessage() . '</p>';
                            }
                        }
                        break;

                    case 'security':
                        echo "<h2>Bezpečnosť</h2>";
                        echo '<div>';
                        echo '<h4>Zmena e-mailu</h4>';
                        echo '<form id="request" action="?page=security&edit=email" method="post">
                                    <div class="form-group mb-3">
                                        <label for="email">E-mail:</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Zadajte váš e-mail" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="heslo">Heslo:</label>
                                        <input class="form-control" type="password" id="heslo" name="heslo"
                                            placeholder="Zadajte vaše heslo" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width:50%;">Uložiť</button>
                                </form>';
                        echo '</div>';
                        if ($securityEdit == 'email') {
                            try {
                                if (empty($_POST["heslo"]))
                                    throw new Exception("Nie je zadané heslo.");
                                if ($users->checkPassword($_POST['heslo'])) {
                                    $users->editEmail(
                                        $_POST['email'],
                                    );
                                    echo '<p id="emailEditInfo" class="text-success mt-3">E-mail bol úspešne zmenený.</p>';
                                } else {
                                    throw new Exception("Nesprávne heslo.");
                                }

                            } catch (Exception $e) {
                                echo '<p id="emailEditInfo" class="text-danger mt-3">' . $e->getMessage() . '</p>';
                            }
                        }
                        echo '<div class="mt-5">';
                        echo '<h4>Zmena hesla</h4>';
                        echo '<form id="request" action="?page=security&edit=password#passwordEditInfo" method="post">
                                    <div class="form-group mb-3">
                                        <label for="old_heslo">Staré heslo:</label>
                                        <input class="form-control" type="password" id="old_heslo" name="old_heslo"
                                            placeholder="Zadajte vaše staré heslo" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="heslo">Nové heslo:</label>
                                        <input type="password" class="form-control" id="heslo" name="heslo" placeholder="Zadajte vaše nové heslo" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="heslo_confirm">Potvrďte heslo:</label>
                                        <input type="password" class="form-control" id="heslo_confirm" name="heslo_confirm"
                                            placeholder="Zopakujte vaše nové heslo" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width:50%;">Uložiť</button>
                                </form>';
                        echo '</div>';

                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if ($securityEdit == 'password') {
                                try {
                                    if (empty($_POST['old_heslo']))
                                        throw new Exception("Pre zmenu hesla je potrebné zadať aj staré heslo.");
                                    if (empty($_POST['heslo_confirm'])) {
                                        throw new Exception("Nezadali ste potvrdenie nového hesla.");
                                    }
                                    if ($users->checkPassword($_POST['old_heslo'])) {
                                        $users->editPassword(
                                            $_POST['heslo'],
                                            $_POST['heslo_confirm']
                                        );
                                        echo '<p id="passwordEditInfo" class="text-success mt-3">Heslo bolo úspešne zmenené.</p>';
                                    } else {
                                        throw new Exception("Nesprávne heslo.");
                                    }
                                } catch (Exception $e) {
                                    echo '<p id="passwordEditInfo" class="text-danger mt-3">' . $e->getMessage() . '</p>';
                                }
                            }
                        }
                        break;

                    default:
                        echo "<p>Vyberte možnosť z menu.</p>";
                        break;
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    // načítanie dolnej časti stránky
    loadPart("footer");
    ?>

    <!-- Javascript files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>