<?php
namespace products;
error_reporting(E_ALL);
ini_set("display_errors", "On");
require_once(__ROOT__ . "/db/dbfunctions.php");
require_once(__ROOT__ . "/php/functions.php");
use Exception, databaza\Database;

class ProductsFunctions extends Database
{
    public function __construct()
    {
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function generateMessage($id)
    {
        if (!is_numeric($id)) {
            echo '<div class="alert alert-danger" role="alert">Neplatné ID Objednávky.</div>';
            return;
        }
        // Ak bola stlačená tlačidlo "Označiť ako preskúmané", aktualizuje sa stav objednávky na preskúmané
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['oznacit_dorucene'])) {
            $stmt = $this->connection->prepare("UPDATE objednavka_tovar SET dorucene = " . $_POST['oznacit_dorucene'] . " WHERE idobjednavka_tovar = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        $sql = "SELECT o.idobjednavka_tovar AS id, o.dorucene, o.datum, p.meno, p.priezvisko, p.email, p.tel_cislo, p.krajina, p.mesto, p.PSC, p.ulica, p.cislo_domu, t.nazov, t.popis, t.cena, t.obrazok FROM objednavka_tovar o
                INNER JOIN pouzivatel p ON o.idpouzivatel = p.idpouzivatel
                INNER JOIN tovar t ON o.idtovar = t.idtovar 
                WHERE o.idobjednavka_tovar = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch();
        if (empty($data)) {
            echo '<div class="alert alert-danger" role="alert">Objednávka neexistuje.</div>';
        } else {
            echo '<div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white">Detaily objednávky</h4>
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
                        <div class="col-md-12">
                            <strong>Adresa:</strong>
                            <div>' . neuvedeneIfNull($data["ulica"]) . ' ' . neuvedeneIfNull($data["cislo_domu"]) . ', ' . neuvedeneIfNull($data["mesto"]) . ', ' . neuvedeneIfNull($data["PSC"]) . ', ' . neuvedeneIfNull($data["krajina"]) . '</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong class="mr-1">Stav:</strong>
                            <span class="badge bg-' . ($data['dorucene'] == 0 ? 'warning text-dark">Nedoručené' : 'success text-white">Doručené') . '</span>
                        </div>
                    </div>
                    <hr>
                    <img src="data:image/png;base64,' . base64_encode($data['obrazok']) . '" style="width: 30%; height: auto;" class="img-fluid" alt="' . $data['nazov'] . '">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Názov produktu:</strong>
                            <div>' . $data["nazov"] . '</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Popis produktu:</strong>
                            <div>' . $data["popis"] . '</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Cena:</strong>
                            <div>' . $data["cena"] . '€</div>
                        </div>
                    </div>';
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
                                <a href="?page=productsmsg" class="btn btn-secondary w-100">
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
            'cena-asc' => 'ORDER BY cena ASC',
            'cena-desc' => 'ORDER BY cena DESC'
        ];

        $filter = $_GET['filter'] ?? 'all';
        $sort = $_GET['sort'] ?? 'date-desc';
        echo '<form id="request" method="get" class="f">
                <input type="hidden" name="page" value="productsmsg">
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
                         <option value="cena-asc" ' . optionSelect($sort, "cena-asc") . '>Zoradiť podľa ceny (od najnižšej)</option>
                         <option value="cena-desc" ' . optionSelect($sort, "cena-desc") . '>Zoradiť podľa ceny (od najvyššej)</option>
                         <option value="budget-asc" ' . optionSelect($sort, "budget-asc") . '>Zoradiť podľa rozpočtu (od najnižšieho)</option>
                      </select>
                   </div>
                </div>
            </form>';
        $sql = "SELECT o.idobjednavka_tovar AS id, o.dorucene, o.datum, p.meno, p.priezvisko, p.email, t.nazov, t.cena, t.obrazok FROM objednavka_tovar o
                INNER JOIN pouzivatel p ON o.idpouzivatel = p.idpouzivatel
                INNER JOIN tovar t ON o.idtovar = t.idtovar " . $dictionaryFilter[$filter] . " " . $dictionarySort[$sort];
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        foreach ($data as $row) {
            $base64 = base64_encode($row['obrazok']);
            echo '<div class="row row-cols-1 g-3 mt-3 increaseSizeHover">
                <div class="col">
                    <form method="post" action="?page=productsmsg&message=' . $row['id'] . '">
                            <div class="card shadow-sm border-' . ($row['dorucene'] == 0 ? "warning" : "success") . '">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <h5 class="card-title mb-0 pb-0">' . $row['meno'] . ' ' . $row['priezvisko'] . '</h5>
                                            <small class="text-muted">' . $row['email'] . '</small>
                                        </div>
                                        <span class="badge bg-' . ($row['dorucene'] == 0 ? 'warning text-dark">Nedoručené' : 'success text-white">Doručené') . '</span>
                                    </div>';
            echo '<div class="mb-2">
                                        <span class="font-weight-bold">Tovar: </span>' . $row['nazov'] . '
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-weight-bold">Cena: </span>' . $row['cena'] . '€
                                    </div>';
            echo '<img src="data:image/png;base64,' . $base64 . '" style="width: 20%; height: auto;" class="img-fluid mb-2" alt="' . $row['nazov'] . '">';
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