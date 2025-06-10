<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<?php
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
WebFunc::loadPart("head");

require_once(__ROOT__ . "\php\users.php");
require_once(__ROOT__ . "\php\accountFunctions.php");
require_once(__ROOT__ . "\php\contactFunctions.php");
require_once(__ROOT__ . "\php\pcbuildFunctions.php");
require_once(__ROOT__ . "\php\productsFunctions.php");
use users\Users, account\AccountFunctions, contact\ContactFunctions, pcbuild\PCBuildFunctions, products\ProductsFunctions;

$users = new Users();
$accountFunctions = new AccountFunctions();
$contactFunctions = new ContactFunctions();
$pcbuildFunctions = new PcBuildFunctions();
$productsFunctions = new ProductsFunctions();

if (!$users->isLoggedIn()) {
    header("Location: login.php");
    exit();
}
$users->reloadData();
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    $users->logout();
    header("Location: index.php");
    exit();
}

if (isset($_GET['deleteaccount']) && $_GET['deleteaccount'] === 'true') {
    $users->deleteAccount();
    header("Location: index.php");
    exit();
}
?>

<body class="main-layout inner_posituong">
    <header>
        <?php WebFunc::loadPart("header"); ?>
    </header>

    <div class="container my-5" style="max-width: 800px;">
        <div class="row">
            <!-- Sidebar -->
            <?php
            $accountFunctions->sidebarGenerator();
            ?>
            <!-- Content -->
            <div class="col-md-8">
                <?php
                $elements = $accountFunctions->getSidebarElements();
                function valueOrSession($key, $sessionKey)
                {
                    return (isset($_POST[$key]) && $_POST[$key] !== '') ? $_POST[$key] : $_SESSION[$sessionKey];
                }

                function getSessionValue($key)
                {
                    return !empty($_SESSION[$key]) ? $_SESSION[$key] : 'Neuvedené';
                }

                $page = $_GET['page'] ?? 'details';
                $securityEdit = $_GET['edit'] ?? null;
                $message = $_GET['message'] ?? null;

                switch ($page) {
                    case 'details':
                        if (in_array('details', $elements)) {
                            echo "<div>";
                            echo "<h2>Podrobnosti o používateľovi</h2>";
                            echo "Dobrý deň, <b>" . htmlspecialchars($users->getName()) . "</b>!<br>";
                            echo "Vaša rola je: <b>" . htmlspecialchars($users->getRole()) . "</b><br>";
                            echo "</div>";

                            echo "<div class='mt-2'>";
                            echo "Váš email je: <b>" . htmlspecialchars(getSessionValue('user_email')) . "</b><br>";
                            echo "Vaše telefónne číslo je: <b>" . htmlspecialchars(getSessionValue('user_tel_cislo')) . "</b><br>";
                            echo "</div>";

                            echo "<div class='mt-2'>";
                            echo "Vaša krajina je: <b>" . htmlspecialchars(getSessionValue('user_krajina')) . "</b><br>";
                            echo "Vaše mesto je: <b>" . htmlspecialchars(getSessionValue('user_mesto')) . "</b><br>";
                            echo "Vaše PSČ je: <b>" . htmlspecialchars(getSessionValue('user_psc')) . "</b><br>";
                            echo "Vaša ulica je: <b>" . htmlspecialchars(getSessionValue('user_ulica')) . "</b><br>";
                            echo "Vaše číslo domu je: <b>" . htmlspecialchars(getSessionValue('user_cislo_domu')) . "</b><br>";
                            echo '<div class="mt-2">
                                <a href="?logout=true" class="text-decoration-underline">Odhlásiť sa</a>
                                </div>';
                            echo "</div>";
                        }
                        break;

                    case 'adminpanel':
                        if (in_array('adminpanel', $elements)) {
                            echo "<h2>Panel správcu</h2>";
                            $idrola = $_SESSION['user_idrola'];
                            $form = isset($_GET['form']) ? $_GET['form'] : null;
                            if ($idrola == 5) {
                                echo "<h4>Pre administrátora</h4>";
                                // Správa rolí používateľov
                                echo '<div class="card shadow mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="mb-0 text-white"><i class="bi bi-person-gear mr-2"></i>Správa rolí používateľov</h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="request" action="?page=adminpanel&form=edit-user-roles" method="post">
                                        <div class="form-group mb-3">
                                            <label for="email">E-mail používateľa:</label>
                                            <input class="form-control" type="email" id="email" name="email"
                                                placeholder="Zadajte e-mail používateľa">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="rola">Rola:</label>
                                            <select class="form-control" id="rola" name="rola">';
                                $roles = $users->getRolesList();
                                foreach ($roles as $role) {
                                    echo '<option value="' . $role['idrola'] . '">' . htmlspecialchars($role['nazov']) . '</option>';
                                }
                                echo '</select>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="width:50%;">Uložiť</button>
                                    </form>
                                    </div>
                                </div>';
                                if ($form == "edit-user-roles" && $_SERVER['REQUEST_METHOD'] === 'POST') {
                                    try {
                                        if (empty($_POST['email']) || empty($_POST['rola'])) {
                                            throw new Exception("Nezadan e-mail používateľa alebo rola.");
                                        }
                                        if (!in_array($_POST['email'], $users->getUsersEmailList())) {
                                            throw new Exception("Používateľ s týmto e-mailom neexistuje.");
                                        }
                                        $users->setUserRole(
                                            $_POST['email'],
                                            $_POST['rola']
                                        );
                                        echo '<p id="spravaRoliInfo" class="text-success mb-4">Rola bola úspešne zmenená.</p>';
                                    } catch (Exception $e) {
                                        echo '<p id="spravaRoliInfo" class="text-danger mb-4">' . $e->getMessage() . '</p>';
                                    }
                                }
                            }
                            if (in_array($idrola, [2, 4, 5])) {
                                echo "<h4>Pre správcov zostáv počítačov alebo tovarov</h4>";
                                // Správa počítačových komponentov
                                $pcbuildFunctions->generateAddComponentsForm($form);
                                $pcbuildFunctions->removeComponentsForm($form);

                            }
                            if (in_array($idrola, [4, 5])) {
                                echo "<h4>Pre správcov tovarov</h4>";
                                // Správa objednávok
                                $productsFunctions->generateAddProductsForm($form);
                                $productsFunctions->generateRemoveProductsForm($form);
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Nemáte prístup k tejto sekcii.</div>';
                        }
                        break;

                    case 'contactmsg':
                        if (in_array('contactmsg', $elements)) {
                            echo "<h2>Kontaktné správy</h2>";
                            if ($message) {
                                $contactFunctions->generateContactMessage($message);
                            } else {
                                $contactFunctions->generateContactMsgList();
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Nemáte prístup k tejto sekcii.</div>';
                        }
                        break;

                    case 'pcbuildmsg':
                        if (in_array('pcbuildmsg', $elements)) {
                            echo "<h2>Žiadosti o zostavenie počítačov</h2>";
                            if ($message) {
                                $pcbuildFunctions->generateMessage($message);
                            } else {
                                $pcbuildFunctions->generateMessagesList();
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Nemáte prístup k tejto sekcii.</div>';
                        }
                        break;

                    case 'productsmsg':
                        if (in_array('productsmsg', $elements)) {
                            echo "<h2>Objednávky</h2>";
                            if ($message) {
                                $productsFunctions->generateMessage($message);
                            } else {
                                $productsFunctions->generateMessagesList();
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Nemáte prístup k tejto sekcii.</div>';
                        }
                        break;

                    case 'edit':
                        if (in_array('edit', $elements)) {
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
                                    // ak sú polia príliš dlhé, vyhodíme výnimku
                                    if (mb_strlen($_POST['meno']) > 45 || mb_strlen($_POST['priezvisko']) > 45 || mb_strlen($_POST['tel_cislo']) > 20 || mb_strlen($_POST['krajina']) > 45 || mb_strlen($_POST['mesto']) > 45 || mb_strlen($_POST['psc']) > 15 || mb_strlen($_POST['ulica']) > 45) {
                                        throw new Exception("Niektoré polia prekračujú maximálnu dĺžku.");
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
                        }
                        break;

                    case 'security':
                        if (in_array('security', $elements)) {
                            echo "<h2>Bezpečnosť</h2>";
                            echo '<div>';
                            echo '<h4 id="emailChangeForm">Zmena e-mailu</h4>';
                            echo '<form action="?page=security&edit=email#emailChangeForm" method="post">
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
                            if ($securityEdit == 'email' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                                try {
                                    if (empty($_POST["heslo"]))
                                        throw new Exception("Nie je zadané heslo.");
                                    if ($users->checkPassword($_POST['heslo'])) {
                                        $users->editEmail(
                                            $_POST['email'],
                                        );
                                        echo '<p class="text-success mt-3">E-mail bol úspešne zmenený.</p>';
                                    } else {
                                        throw new Exception("Nesprávne heslo.");
                                    }

                                } catch (Exception $e) {
                                    echo '<p class="text-danger mt-3">' . $e->getMessage() . '</p>';
                                }
                            }
                            echo '<div class="mt-5">';
                            echo '<h4 id="passwordChangeForm">Zmena hesla</h4>';
                            echo '<form action="?page=security&edit=password#passwordChangeForm" method="post">
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
                            if ($securityEdit == 'password' && $_SERVER['REQUEST_METHOD'] === 'POST') {
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
                                        echo '<p class="text-success mt-3">Heslo bolo úspešne zmenené.</p>';
                                    } else {
                                        throw new Exception("Nesprávne heslo.");
                                    }
                                } catch (Exception $e) {
                                    echo '<p class="text-danger mt-3">' . $e->getMessage() . '</p>';
                                }
                            }
                            echo '<div class="mt-4">
                                <a href="?page=security&deleteaccount=true" class="text-decoration-underline" onclick="return confirm(\'Naozaj chcete odstrániť svoj účet?\');">Odstrániť účet</a>
                                </div>';
                            echo "</div>";
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
    WebFunc::loadPart("footer");
    ?>
</body>

</html>