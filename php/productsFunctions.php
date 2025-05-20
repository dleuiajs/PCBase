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

    public function generateRemoveProductsForm($form)
    {
        $textinfo = null;
        if ($form == "remove-products" && $_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = $_POST['id'];
                $sql = "SELECT obrazok FROM tovar WHERE idtovar = :id";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch();
                if ($result) {
                    $obrazok = $result['obrazok'];
                    if (file_exists($obrazok)) {
                        unlink($obrazok);
                    }
                } else {
                    throw new Exception("Obrázok neexistuje.");
                }
                $sql = "DELETE FROM tovar WHERE idtovar = :id";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $sql = "DELETE FROM podrobnosti_tovara WHERE idpodrobnosti_tovara = :id";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $sql = "DELETE FROM podrobnosti_tovara_has_graficka_karta WHERE idpodrobnosti_tovara = :id";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $textinfo = '<p class="text-success mb-4">Tovar bol úspešne odstránený.</p>';
            } catch (Exception $e) {
                $textinfo = '<p class="text-danger mb-4">' . $e->getMessage() . '</p>';
            }
        }
        echo '<div class="card shadow mb-4" id="removeProductsCard">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-white"><i class="bi bi-trash mr-2"></i>Odstránenie produktov</h4>
            </div>
            <div class="card-body">
                <form id="request" action="?page=adminpanel&form=remove-products#removeProductsCard" method="post">
                    <div class="form-group mb-3">
                        <label for="id">Vyberte produkt</label>
                        <select class="form-control" id="id" name="id" required>
                            <option value="" disabled selected>Vyberte produkt</option>';
        $products = $this->getData("tovar");
        foreach ($products as $product) {
            echo '          <option value="' . $product['idtovar'] . '">' . $product['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-danger" type="submit">Odstrániť</button>
                    </div>
                </form>
            </div>
        </div>';
        if ($textinfo) {
            echo $textinfo;
        }
    }

    public function generateAddProductsForm($form)
    {
        echo '<div class="card shadow mb-4" id="addProductsCard">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-white"><i class="bi bi-plus-square mr-2"></i>Pridanie produktov</h4>
            </div>
            <div class="card-body">
                <form id="request" action="?page=adminpanel&form=add-products#addProductsCard" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="nazov">Zadajte názov produktu</label>
                        <input type="text" class="form-control" id="nazov" name="nazov" placeholder="Názov produktu" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="popis">Zadajte popis produktu</label>
                        <textarea class="form-control" id="popis" name="popis" rows="3" placeholder="Popis produktu" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cena">Zadajte cenu produktu</label>
                        <input type="number" class="form-control" id="cena" name="cena" placeholder="Cena produktu" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="obrazok">Zadajte obrázok produktu</label>
                        <input type="file" class="form-control" id="obrazok" name="obrazok" accept="image/*" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="mnozstvo">Zadajte množstvo produktu</label>
                        <input type="number" class="form-control" id="mnozstvo" name="mnozstvo" placeholder="Množstvo produktu" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idkategoria_tovara">Vyberte kategóriu produktu</label>
                        <select class="form-control" id="idkategoria_tovara" name="idkategoria_tovara" required>
                            <option value="" disabled selected>Vyberte kategóriu</option>';
        $categories = $this->getData("kategoria_tovara");
        foreach ($categories as $category) {
            echo '          <option value="' . $category['idkategoria_tovara'] . '">' . $category['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group-mb-3">
                        <label for="rozmery">Zadajte rozmer produktu</label>
                        <input type="text" class="form-control" id="rozmery" name="rozmery" placeholder="Rozmer produktu" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="hmotnost">Zadajte hmotnosť produktu</label>
                        <input type="text" class="form-control" id="hmotnost" name="hmotnost" placeholder="Hmotnosť produktu" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="zaruka">Uveďte dĺžku záruky</label>
                        <input type="text" class="form-control" id="zaruka" name="zaruka" placeholder="Dĺžka záruky" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idzakladna_doska">Vyberte základnú dosku</label>
                        <select class="form-control" id="idzakladna_doska" name="idzakladna_doska" required>
                            <option value="" disabled selected>Vyberte základnú dosku</option>';
        $motherboards = $this->getData("zakladna_doska");
        foreach ($motherboards as $motherboard) {
            echo '          <option value="' . $motherboard['idzakladna_doska'] . '">' . $motherboard['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idprocesor">Vyberte procesor</label>
                        <select class="form-control" id="idprocesor" name="idprocesor" required>
                            <option value="" disabled selected>Vyberte procesor</option>';
        $processors = $this->getData("procesor");
        foreach ($processors as $processor) {
            echo '          <option value="' . $processor['idprocesor'] . '">' . $processor['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idchladenie">Vyberte chladenie</label>
                        <select class="form-control" id="idchladenie" name="idchladenie" required>
                            <option value="" disabled selected>Vyberte chladenie</option>';
        $coolings = $this->getData("chladenie");
        foreach ($coolings as $cooling) {
            echo '          <option value="' . $cooling['idchladenie'] . '">' . $cooling['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idnapajaci_zdroj">Vyberte napájací zdroj</label>
                        <select class="form-control" id="idnapajaci_zdroj" name="idnapajaci_zdroj" required>
                            <option value="" disabled selected>Vyberte napájací zdroj</option>';
        $powerSupplies = $this->getData("napajaci_zdroj");
        foreach ($powerSupplies as $powerSupply) {
            echo '          <option value="' . $powerSupply['idnapajaci_zdroj'] . '">' . $powerSupply['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idoperacna_pamat">Vyberte operačnú pamäť</label>
                        <select class="form-control" id="idoperacna_pamat" name="idoperacna_pamat" required>
                            <option value="" disabled selected>Vyberte operačnú pamäť</option>';
        $memories = $this->getData("operacna_pamat");
        foreach ($memories as $memory) {
            echo '          <option value="' . $memory['idoperacna_pamat'] . '">' . $memory['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idgraficka_karta">Vyberte grafickú kartu</label>
                        <select class="form-control" id="idgraficka_karta" name="idgraficka_karta" required>
                            <option value="" disabled selected>Vyberte grafickú kartu</option>';
        $graphicsCards = $this->getData("graficka_karta");
        foreach ($graphicsCards as $graphicsCard) {
            echo '          <option value="' . $graphicsCard['idgraficka_karta'] . '">' . $graphicsCard['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idulozisko">Vyberte úložisko</label>
                        <select class="form-control" id="idulozisko" name="idulozisko" required>
                            <option value="" disabled selected>Vyberte úložisko</option>';
        $storage = $this->getData("ulozisko");
        foreach ($storage as $storageItem) {
            echo '          <option value="' . $storageItem['idulozisko'] . '">' . $storageItem['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idoperacny_system">Vyberte operačný systém</label>
                        <select class="form-control" id="idoperacny_system" name="idoperacny_system" required>
                            <option value="" disabled selected>Vyberte operačný systém</option>';
        $operatingSystems = $this->getData("operacny_system");
        foreach ($operatingSystems as $operatingSystem) {
            echo '          <option value="' . $operatingSystem['idoperacny_system'] . '">' . $operatingSystem['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>';
        echo '<div class="form-group mb-3">
                    <button class="btn btn-primary" type="submit">Pridať</button>
                  </div>';
        echo '  </form>
            </div>
        </div>';
        if ($form == "add-products" && $_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // nahravanie obrazka
                $targetDir = "uploads/";
                $originalFileName = basename($_FILES["obrazok"]["name"]);
                $targetFile = $targetDir . time() . "_" . $originalFileName;
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                $validTypes = ['jpg', 'jpeg', 'png'];
                if (!in_array($imageFileType, $validTypes)) {
                    throw new Exception("Nepovolený formát obrázku.");
                }

                if (!move_uploaded_file($_FILES["obrazok"]["tmp_name"], $targetFile)) {
                    throw new Exception("Nepodarilo sa nahrať obrázok.");
                }

                $sql = "SELECT idtovar + 1 AS id FROM tovar ORDER BY idtovar DESC LIMIT 1";
                $stmt = $this->connection->prepare($sql);
                if ($stmt->execute())
                    $id = $stmt->fetch()['id'];
                else
                    $id = 1;

                $sql = "INSERT INTO podrobnosti_tovara (idpodrobnosti_tovara, rozmery, hmotnost, zaruka, idzakladna_doska, idprocesor, idchladenie, idnapajaci_zdroj, idoperacna_pamat, idulozisko, idoperacny_system) 
                    VALUES (:idpodrobnosti_tovara, :rozmery, :hmotnost, :zaruka, :idzakladna_doska, :idprocesor, :idchladenie, :idnapajaci_zdroj, :idoperacna_pamat, :idulozisko, :idoperacny_system)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':idpodrobnosti_tovara', $id);
                $stmt->bindParam(':rozmery', $_POST['rozmery']);
                $stmt->bindParam(':hmotnost', $_POST['hmotnost']);
                $stmt->bindParam(':zaruka', $_POST['zaruka']);
                $stmt->bindParam(':idzakladna_doska', $_POST['idzakladna_doska']);
                $stmt->bindParam(':idprocesor', $_POST['idprocesor']);
                $stmt->bindParam(':idchladenie', $_POST['idchladenie']);
                $stmt->bindParam(':idnapajaci_zdroj', $_POST['idnapajaci_zdroj']);
                $stmt->bindParam(':idoperacna_pamat', $_POST['idoperacna_pamat']);
                $stmt->bindParam(':idulozisko', $_POST['idulozisko']);
                $stmt->bindParam(':idoperacny_system', $_POST['idoperacny_system']);
                $stmt->execute();

                $sql = "INSERT INTO podrobnosti_tovara_has_graficka_karta (idpodrobnosti_tovara, idgraficka_karta)
                    VALUES (:idpodrobnosti_tovara, :idgraficka_karta)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':idpodrobnosti_tovara', $id);
                $stmt->bindParam(':idgraficka_karta', $_POST['idgraficka_karta']);
                $stmt->execute();

                $sql = "INSERT INTO tovar (idtovar, nazov, popis, mnozstvo, cena, obrazok, idpodrobnosti_tovara, idkategoria_tovara)
                    VALUES (:idtovar, :nazov, :popis, :mnozstvo, :cena, :obrazok, :idpodrobnosti_tovara, :idkategoria_tovara)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':idtovar', $id);
                $stmt->bindParam(':nazov', $_POST['nazov']);
                $stmt->bindParam(':popis', $_POST['popis']);
                $stmt->bindParam(':mnozstvo', $_POST['mnozstvo']);
                $stmt->bindParam(':cena', $_POST['cena']);
                $stmt->bindParam(':obrazok', $targetFile);
                $stmt->bindParam(':idpodrobnosti_tovara', $id);
                $stmt->bindParam(':idkategoria_tovara', $_POST['idkategoria_tovara']);
                $stmt->execute();
                echo '<p class="text-success mb-4">Tovar bol úspešne pridaný.</p>';
            } catch (Exception $e) {
                echo '<p class="text-danger mb-4">' . $e->getMessage() . '</p>';
            }

        }
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