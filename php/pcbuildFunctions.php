<?php
namespace pcbuild;
error_reporting(E_ALL);
ini_set("display_errors", "On");
require_once(__ROOT__ . "/db/dbfunctions.php");
require_once(__ROOT__ . "/php/functions.php");
use Exception, databaza\Database;

class PcBuildFunctions extends Database
{
    public function __construct()
    {
        $this->connect();
        $this->connection = $this->getConnection();
    }
    public function handler()
    {
        $idpouzivatel = $_SESSION['user_id'];
        if (empty($idpouzivatel)) {
            throw new Exception("Nie ste prihlásený.");
        }
        $rozpocet = $_POST['rozpocet'];
        $poznamka = $_POST['poznamka'] ?? null;
        $idzakladna_doska = $_POST['zakladna_doska'];
        $idgraficka_karta = $_POST['graficka_karta'];
        $idprocesor = $_POST['procesor'];
        $idoperacna_pamat = $_POST['operacna_pamat'];
        $idnapajaci_zdroj = $_POST['napajaci_zdroj'];
        $idchladenie = $_POST['chladenie'];
        $idoperacny_system = $_POST['operacny_system'];
        $idulozisko = $_POST['ulozisko'];
        $this->insertObjednavka_Zostavenie($rozpocet, $poznamka, $idpouzivatel, $idzakladna_doska, $idgraficka_karta, $idprocesor, $idoperacna_pamat, $idnapajaci_zdroj, $idchladenie, $idoperacny_system, $idulozisko);
        $this->connection = null; // uzavrie pripojenie nastavením na null
    }

    private function insertObjednavka_Zostavenie($rozpocet, $poznamka, $idpouzivatel, $idzakladna_doska, $idgraficka_karta, $idprocesor, $idoperacna_pamat, $idnapajaci_zdroj, $idchladenie, $idoperacny_system, $idulozisko)
    {
        $sql = "INSERT INTO objednavka_zostavenie (dorucene, datum, rozpocet, poznamka, idpouzivatel, idzakladna_doska, idgraficka_karta, idprocesor, idoperacna_pamat, idnapajaci_zdroj, idchladenie, idoperacny_system, idulozisko) VALUES (0, CURRENT_TIMESTAMP, :rozpocet, :poznamka, :idpouzivatel, :idzakladna_doska, :idgraficka_karta, :idprocesor, :idoperacna_pamat, :idnapajaci_zdroj, :idchladenie, :idoperacny_system, :idulozisko)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':rozpocet', $rozpocet);
        $stmt->bindParam(':poznamka', $poznamka);
        $stmt->bindParam(':idpouzivatel', $idpouzivatel);
        $stmt->bindParam(':idzakladna_doska', $idzakladna_doska);
        $stmt->bindParam(':idgraficka_karta', $idgraficka_karta);
        $stmt->bindParam(':idprocesor', $idprocesor);
        $stmt->bindParam(':idoperacna_pamat', $idoperacna_pamat);
        $stmt->bindParam(':idnapajaci_zdroj', $idnapajaci_zdroj);
        $stmt->bindParam(':idchladenie', $idchladenie);
        $stmt->bindParam(':idoperacny_system', $idoperacny_system);
        $stmt->bindParam(':idulozisko', $idulozisko);
        $stmt->execute();
    }

    public function generateForm()
    {
        $components = [
            "graficka_karta" => "Vyberte grafickú kartu:",
            "zakladna_doska" => "Vyberte základnú dosku:",
            "procesor" => "Vyberte procesor:",
            "operacna_pamat" => "Vyberte operačnú pamäť:",
            "napajaci_zdroj" => "Vyberte napájací zdroj:",
            "chladenie" => "Vyberte chladenie:",
            "operacny_system" => "Vyberte operačný systém:",
            "ulozisko" => "Vyberte úložisko:"
        ];

        echo '<form id="request" class="main_form" action="thxyou_pcbuild.php" method="post">
                  <div class="row">';

        foreach ($components as $component => $label) {
            echo '<div class="col-md-12">';
            echo '<label for="' . $component . '">' . $label . '</label><br>';
            echo '<select id="' . $component . '" name="' . $component . '">';
            $data = $this->getData($component);
            foreach ($data as $row) {
                echo '<option value="' . $row['id' . $component] . '">' . $row['nazov'] . '</option>';
            }
            echo '</select>';
            echo '</div>';
        }
        echo '<div class="col-md-12">
                        <label for="rozpocet">Zadajte rozpočet:</label><br>
                        <input type="number" id="rozpocet" name="rozpocet" placeholder="Zadajte rozpočet" min="0"
                           step="1" required><br>
                     </div>
                     <div class="col-md-12">
                     <label for="poznamka">Zadajte poznámku:</label><br>
                        <textarea class="textarea" placeholder="Zadajte poznámku" name="poznamka" id="poznamka"></textarea>
                     </div>
                     <div class="col-md-12">
                        <button class="send_btn" type="submit">Odoslať</button>
                     </div>
                  </div>
               </form>';
    }

    public function generateMessage($id)
    {
        if (!is_numeric($id)) {
            echo '<div class="alert alert-danger" role="alert">Neplatné ID správy.</div>';
            return;
        }
        // Ak bola stlačená tlačidlo "Označiť ako preskúmané", aktualizuje sa stav správy na preskúmané
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['oznacit_dorucene'])) {
            $stmt = $this->connection->prepare("UPDATE objednavka_zostavenie SET dorucene = " . $_POST['oznacit_dorucene'] . " WHERE idobjednavka_zostavenie = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        $sql = "SELECT o.idobjednavka_zostavenie AS id, o.dorucene AS dorucene, o.datum AS datum, o.rozpocet AS rozpocet, o.poznamka AS poznamka, o.idpouzivatel AS idpouzivatel, pouzivatel.meno AS meno, pouzivatel.priezvisko AS priezvisko, pouzivatel.email AS email, pouzivatel.tel_cislo AS tel_cislo, pouzivatel.krajina AS krajina, pouzivatel.mesto AS mesto, pouzivatel.PSC AS PSC, pouzivatel.ulica AS ulica, pouzivatel.cislo_domu AS cislo_domu,  zakladna_doska.nazov AS zakladna_doska, graficka_karta.nazov AS graficka_karta, procesor.nazov AS procesor, napajaci_zdroj.nazov AS napajaci_zdroj, ulozisko.nazov AS ulozisko, operacna_pamat.nazov AS operacna_pamat, chladenie.nazov AS chladenie, operacny_system.nazov AS operacny_system, zakladna_doska.idzakladna_doska AS idzakladna_doska, graficka_karta.idgraficka_karta AS idgraficka_karta, procesor.idprocesor AS idprocesor, napajaci_zdroj.idnapajaci_zdroj AS idnapajaci_zdroj, ulozisko.idulozisko AS idulozisko, operacna_pamat.idoperacna_pamat AS idoperacna_pamat, chladenie.idchladenie AS idchladenie, operacny_system.idoperacny_system AS idoperacny_system FROM objednavka_zostavenie AS o " .
            "INNER JOIN pouzivatel ON o.idpouzivatel = pouzivatel.idpouzivatel " .
            "INNER JOIN zakladna_doska ON o.idzakladna_doska = zakladna_doska.idzakladna_doska " .
            "INNER JOIN graficka_karta ON o.idgraficka_karta = graficka_karta.idgraficka_karta " .
            "INNER JOIN procesor ON o.idprocesor = procesor.idprocesor " .
            "INNER JOIN napajaci_zdroj ON o.idnapajaci_zdroj = napajaci_zdroj.idnapajaci_zdroj " .
            "INNER JOIN ulozisko ON o.idulozisko = ulozisko.idulozisko " .
            "INNER JOIN operacna_pamat ON o.idoperacna_pamat = operacna_pamat.idoperacna_pamat " .
            "INNER JOIN chladenie ON o.idchladenie = chladenie.idchladenie " .
            "INNER JOIN operacny_system ON o.idoperacny_system = operacny_system.idoperacny_system " .
            "WHERE o.idobjednavka_zostavenie = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch();
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
                            <div>' . $data["meno"] . ' ' . $data["priezvisko"] . '</div>
                        </div>
                        <div class="col-md-6">
                            <strong>E-mail:</strong>
                            <div>' . $data["email"] . '</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Telefónne číslo:</strong>
                            <div>' . neuvedeneIfNull($data['tel_cislo']) . '</div>
                        </div>
                        <div class="col-md-6">
                            <strong>Dátum odoslania:</strong>
                            <div>' . $data["datum"] . '</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Adresa:</strong>
                            <div>' . neuvedeneIfNull($data["ulica"]) . ' ' . neuvedeneIfNull($data["cislo_domu"]) . ', ' . neuvedeneIfNull($data["mesto"]) . ', ' . neuvedeneIfNull($data["PSC"]) . ', ' . neuvedeneIfNull($data["krajina"]) . '</div>
                        </div>
                        <div class="col-md-6">
                            <strong>Rozpočet:</strong>
                            <div>' . $data["rozpocet"] . '€</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong class="mr-1">Stav:</strong>
                            <span class="badge bg-' . ($data['dorucene'] == 0 ? 'warning text-dark">Nedoručené' : 'success text-white">Doručené') . '</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="mb-3 p-3 rounded border border-info bg-light">
                                <h5 class="text-info mb-1"><strong>Komponenty počítača:</strong></h5>
                                <dl class="row mb-0">
                                    <dt class="col-sm-5">Základná doska:</dt>
                                    <dd class="col-sm-7 mb-2">' . $data["zakladna_doska"] . '</dd>

                                    <dt class="col-sm-5">Grafická karta:</dt>
                                    <dd class="col-sm-7 mb-2">' . $data["graficka_karta"] . '</dd>

                                    <dt class="col-sm-5">Procesor:</dt>
                                    <dd class="col-sm-7 mb-2">' . $data["procesor"] . '</dd>

                                    <dt class="col-sm-5">Operačná pamäť:</dt>
                                    <dd class="col-sm-7 mb-2">' . $data["operacna_pamat"] . '</dd>

                                    <dt class="col-sm-5">Napájací zdroj:</dt>
                                    <dd class="col-sm-7 mb-2">' . $data["napajaci_zdroj"] . '</dd>

                                    <dt class="col-sm-5">Chladenie:</dt>
                                    <dd class="col-sm-7 mb-2">' . $data["chladenie"] . '</dd>

                                    <dt class="col-sm-5">Operačný systém:</dt>
                                    <dd class="col-sm-7 mb-2">' . $data["operacny_system"] . '</dd>

                                    <dt class="col-sm-5">Úložisko:</dt>
                                    <dd class="col-sm-7 mb-2">' . $data["ulozisko"] . '</dd>
                                </dl>
                            </div>
                        </div>
                    </div>';
            if ($data['poznamka'] != null) {
                echo '<div class="mb-4">
                        <strong>Poznámka:</strong>
                        <div class="border rounded p-3 bg-light mt-2" style="min-height:100px;">' . $data["poznamka"] . '</div>
                    </div>';
            }
            echo '<div class="mb-12">
                        <a href="mailto:' . $data["email"] . '" class="btn btn-outline-primary col-md-12">
                            <i class="bi bi-envelope"></i> Odpovedať na e-mail
                        </a>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <form method="post" action="">
                                    <input type="hidden" name="oznacit_dorucene" value="' . 1 - $data["dorucene"] . '">
                                    <button type="submit" class="btn btn-' . ($data["dorucene"] == 0 ? 'success' : 'warning') . ' w-100">
                                        <i class="bi bi-' . ($data["dorucene"] == 0 ? 'check' : 'exclamation') . '-circle"></i> Ozn. ako ' . ($data["dorucene"] == 0 ? 'doručené' : 'nedoruč.') . '
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <a href="?page=pcbuildmsg" class="btn btn-secondary w-100">
                                    <i class="bi bi-arrow-left"></i> Späť
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }

    public function generateMessagesList()
    {
        $dictionaryFilter = [
            'all' => '',
            'not-delivered' => 'WHERE dorucene = 0',
            'delivered' => 'WHERE dorucene = 1'
        ];
        $dictionarySort = [
            'date-desc' => 'ORDER BY datum DESC',
            'date-asc' => 'ORDER BY datum ASC',
            'name' => 'ORDER BY meno ASC',
            'email' => 'ORDER BY email ASC',
            'budget-asc' => 'ORDER BY rozpocet ASC',
            'budget-desc' => 'ORDER BY rozpocet DESC'
        ];

        $filter = $_GET['filter'] ?? 'all';
        $sort = $_GET['sort'] ?? 'date-desc';
        echo '<form id="request" method="get" class="f">
                <input type="hidden" name="page" value="pcbuildmsg">
                <div class="row justify-content-between">
                   <div class="col-md-6 ">
                      <select id="filter" name="filter" onchange="this.form.submit()">
                         <option value="all" ' . optionSelect($filter, "all") . '>Zobraziť všetky</option>
                         <option value="not-delivered" ' . optionSelect($filter, "not-delivered") . '>Nedoručené</option>
                         <option value="delivered" ' . optionSelect($filter, "delivered") . '>Doručené</option>
                         </select>
                   </div>
                   <div class="col-md-6 ">
                      <select id="sort" name="sort" onchange="this.form.submit()">
                         <option value="date-desc" ' . optionSelect($sort, "date-desc") . '>Zoradiť od najnovších</option>
                         <option value="date-asc" ' . optionSelect($sort, "date-asc") . '>Zoradiť od najstarších</option>
                         <option value="name" ' . optionSelect($sort, "name") . '>Zoradiť podľa mena</option>
                         <option value="email" ' . optionSelect($sort, "email") . '>Zoradiť podľa e-mailu</option>
                                                  <option value="budget-desc" ' . optionSelect($sort, "budget-desc") . '>Zoradiť podľa rozpočtu (od najvyššieho)</option>
                         <option value="budget-asc" ' . optionSelect($sort, "budget-asc") . '>Zoradiť podľa rozpočtu (od najnižšieho)</option>
                      </select>
                   </div>
                </div>
            </form>';
        $sql = "SELECT o.idobjednavka_zostavenie AS id, o.dorucene AS dorucene, o.datum AS datum, o.rozpocet AS rozpocet, o.poznamka AS poznamka, o.idpouzivatel AS idpouzivatel, pouzivatel.meno AS meno, pouzivatel.priezvisko AS priezvisko, pouzivatel.email AS email, zakladna_doska.nazov AS zakladna_doska, graficka_karta.nazov AS graficka_karta, procesor.nazov AS procesor, napajaci_zdroj.nazov AS napajaci_zdroj, ulozisko.nazov AS ulozisko, operacna_pamat.nazov AS operacna_pamat, chladenie.nazov AS chladenie, operacny_system.nazov AS operacny_system FROM objednavka_zostavenie AS o " .
            "INNER JOIN pouzivatel ON o.idpouzivatel = pouzivatel.idpouzivatel " .
            "INNER JOIN zakladna_doska ON o.idzakladna_doska = zakladna_doska.idzakladna_doska " .
            "INNER JOIN graficka_karta ON o.idgraficka_karta = graficka_karta.idgraficka_karta " .
            "INNER JOIN procesor ON o.idprocesor = procesor.idprocesor " .
            "INNER JOIN napajaci_zdroj ON o.idnapajaci_zdroj = napajaci_zdroj.idnapajaci_zdroj " .
            "INNER JOIN ulozisko ON o.idulozisko = ulozisko.idulozisko " .
            "INNER JOIN operacna_pamat ON o.idoperacna_pamat = operacna_pamat.idoperacna_pamat " .
            "INNER JOIN chladenie ON o.idchladenie = chladenie.idchladenie " .
            "INNER JOIN operacny_system ON o.idoperacny_system = operacny_system.idoperacny_system " . $dictionaryFilter[$filter] . " " . $dictionarySort[$sort];
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach ($data as $row) {
            echo '<div class="row row-cols-1 g-3 mt-3 increaseSizeHover">
                <div class="col">
                    <form method="post" action="?page=pcbuildmsg&message=' . $row['id'] . '">
                            <div class="card shadow-sm border-' . ($row['dorucene'] == 0 ? "warning" : "success") . '">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <h5 class="card-title mb-0 pb-0">' . $row['meno'] . ' ' . $row['priezvisko'] . '</h5>
                                            <small class="text-muted">' . $row['email'] . '</small>
                                        </div>
                                        <span class="badge bg-' . ($row['dorucene'] == 0 ? 'warning text-dark">Nedoručené' : 'success text-white">Doručené') . '</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-weight-bold">Komponenty: </span>' . $row['zakladna_doska'] . ', ' . $row['graficka_karta'] . ', ' . $row['procesor'] . ', ' . $row['napajaci_zdroj'] . ', ' . $row['ulozisko'] . ', ' . $row['operacna_pamat'] . ', ' . $row['chladenie'] . ', ' . $row['operacny_system'] . '
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-weight-bold">Rozpočet: </span>' . $row['rozpocet'] . '€
                                    </div>';

            if ($row['poznamka'] != null) {
                echo '<div class="mb-2">
                        <span class="font-weight-bold">Poznámka:</span>
                        <div class="text-muted limitedText">' . $row['poznamka'] . '</div>
                      </div>';
            }
            echo '<div class="text-end">
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