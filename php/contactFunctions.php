<?php
namespace contact;
error_reporting(E_ALL);
ini_set("display_errors", "On");
require_once(__ROOT__ . "/db/dbfunctions.php");
require_once(__ROOT__ . "/php/helpers.php");
use Exception, databaza\Database, functions\Helpers;

class ContactFunctions extends Database
{
    public function __construct()
    {
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function handlerContact()
    {
        $meno = $_POST['meno'] ?? '';
        $email = $_POST['email'] ?? '';
        $tel_cislo = $_POST['tel_cislo'] ?? '';
        $sprava = $_POST['sprava'] ?? '';
        $this->insertContact($meno, $email, $tel_cislo, $sprava);
        $this->connection = null; // uzavrie pripojenie nastavením na null
    }

    private function insertContact($meno, $email, $tel_cislo, $sprava)
    {
        try {
            $sql = "INSERT INTO objednavka_kontakt (meno, email, tel_cislo, sprava, preskumane, datum) VALUES (:meno, :email, :tel_cislo, :sprava, 0, CURRENT_TIMESTAMP)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':meno', $meno);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':tel_cislo', $tel_cislo);
            $stmt->bindParam(':sprava', $sprava);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Chyba: " . $e->getMessage();
            return false;
        }
    }

    public function generateContactMessage($id)
    {
        if (!is_numeric($id)) {
            echo '<div class="alert alert-danger" role="alert">Neplatné ID správy.</div>';
            return;
        }
        // Ak bola stlačená tlačidlo "Označiť ako preskúmané", aktualizuje sa stav správy na preskúmané
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['oznacit_preskumane'])) {
            $stmt = $this->connection->prepare("UPDATE objednavka_kontakt SET preskumane = " . $_POST['oznacit_preskumane'] . " WHERE idobjednavka_kontakt = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        $data = $this->getData("objednavka_kontakt", additionally: "WHERE idobjednavka_kontakt = $id", single: true);
        if (empty($data)) {
            echo '<div class="alert alert-danger" role="alert">Správa neexistuje.</div>';
        } else {
            echo '<div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white">Detaily správy</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Používateľské meno:</strong>
                            <div>' . htmlspecialchars($data["meno"]) . '</div>
                        </div>
                        <div class="col-md-6">
                            <strong>E-mail:</strong>
                            <div>' . htmlspecialchars($data["email"]) . '</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Telefónne číslo:</strong>
                            <div>' . Helpers::neuvedeneIfNull($data['tel_cislo']) . '</div>
                        </div>
                        <div class="col-md-6">
                            <strong>Dátum odoslania:</strong>
                            <div>' . $data["datum"] . '</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong class="mr-1">Stav:</strong>
                            <span class="badge bg-' . ($data['preskumane'] == 0 ? 'warning text-dark">Nepreskúmané' : 'success text-white">Preskúmané') . '</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <strong>Správa:</strong>
                        <div class="border rounded p-3 bg-light mt-2" style="min-height:100px;">' . htmlspecialchars($data["sprava"]) . '</div>
                    </div>
                    <div class="mb-12">
                        <a href="mailto:' . htmlspecialchars($data["email"]) . '" class="btn btn-outline-primary col-md-12">
                            <i class="bi bi-envelope"></i> Odpovedať na e-mail
                        </a>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <form method="post" action="">
                                    <input type="hidden" name="oznacit_preskumane" value="' . 1 - $data["preskumane"] . '">
                                    <button type="submit" class="btn btn-' . ($data["preskumane"] == 0 ? 'success' : 'warning') . ' w-100">
                                        <i class="bi bi-' . ($data["preskumane"] == 0 ? 'check' : 'exclamation') . '-circle"></i> Ozn. ako ' . ($data["preskumane"] == 0 ? 'preskúmané' : 'nepreskúm.') . '
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <a href="?page=contactmsg" class="btn btn-secondary w-100">
                                    <i class="bi bi-arrow-left"></i> Späť
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }

    public function generateContactMsgList()
    {
        $dictionaryFilter = [
            'all' => '',
            'not-checked' => 'WHERE preskumane = 0',
            'checked' => 'WHERE preskumane = 1'
        ];
        $dictionarySort = [
            'date-desc' => 'ORDER BY datum DESC',
            'date-asc' => 'ORDER BY datum ASC',
            'name' => 'ORDER BY meno ASC',
            'email' => 'ORDER BY email ASC'
        ];

        $filter = $_GET['filter'] ?? 'all';
        $sort = $_GET['sort'] ?? 'date-desc';
        echo '<form id="request" method="get" class="f">
                <input type="hidden" name="page" value="contactmsg">
                <div class="row justify-content-between">
                   <div class="col-md-6 ">
                      <select id="filter" name="filter" onchange="this.form.submit()">';
        Helpers::optionSelect($filter, "all", "Zobraziť všetky");
        Helpers::optionSelect($filter, "not-checked", "Nepreskúmané");
        Helpers::optionSelect($filter, "checked", "Preskúmané");
        echo '</select>
                   </div>
                   <div class="col-md-6 ">
                      <select id="sort" name="sort" onchange="this.form.submit()">';
        Helpers::optionSelect($sort, "date-desc", "Zoradiť od najnovších");
        Helpers::optionSelect($sort, "date-asc", "Zoradiť od najstarších");
        Helpers::optionSelect($sort, "name", "Zoradiť podľa mena");
        Helpers::optionSelect($sort, "email", "Zoradiť podľa e-mailu");
        echo '</select>
                   </div>
                </div>
            </form>';
        $data = $this->getData("objednavka_kontakt", additionally: $dictionaryFilter[$filter] . " " . $dictionarySort[$sort]);
        foreach ($data as $row) {
            echo '<div class="row row-cols-1 g-3 mt-3 increaseSizeHover">
                <div class="col">
                    <form method="post" action="?page=contactmsg&message=' . $row['idobjednavka_kontakt'] . '">
                            <div class="card shadow-sm border-' . ($row['preskumane'] == 0 ? "warning" : "success") . '">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <h5 class="card-title mb-0 pb-0">' . htmlspecialchars($row['meno']) . '</h5>
                                            <small class="text-muted">' . htmlspecialchars($row['email']) . '</small>
                                        </div>
                                        <span class="badge bg-' . ($row['preskumane'] == 0 ? 'warning text-dark">Nepreskúmané' : 'success text-white">Preskúmané') . '</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-weight-bold">Telefón: </span>' . Helpers::neuvedeneIfNull($row['tel_cislo']) . '
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-weight-bold">Správa:</span>
                                        <div class="text-muted limitedText">' . htmlspecialchars($row['sprava']) . '</div>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-secondary">' . $row['datum'] . '</small>
                                    </div>
                                    <div class="text-end mt-2">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Zobraziť</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>';
        }
    }

}
?>