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

    public function buyProduct($productid, $userid)
    {
        if ($productid) {
            $sql = "SELECT mnozstvo FROM tovar WHERE idtovar = :idtovar";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':idtovar', $productid);
            $stmt->execute();
            $product = $stmt->fetch();
            if ($product) {
                if ($product['mnozstvo'] == 0) {
                    throw new Exception('Produkt nie je na sklade');
                }
            } else {
                throw new Exception('Produkt nebol nájdený');
            }
            if ($userid) {
                $sql = "INSERT INTO objednavka_tovar (dorucene, datum, idpouzivatel, idtovar) VALUES (0, NOW(), :idpouzivatel, :idtovar)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':idpouzivatel', $userid);
                $stmt->bindParam(':idtovar', $productid);
                $stmt->execute();

                $sql = "UPDATE tovar SET mnozstvo = mnozstvo - 1 WHERE idtovar = :idtovar";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':idtovar', $productid);
                $stmt->execute();
                return true;

            } else {
                throw new Exception('Musíte byť prihlásený, aby ste mohli zakúpiť produkt');
            }
        } else {
            throw new Exception('Produkt nebol nájdený');
        }
    }

    public function generateWriteReviewForm()
    {
        $productid = $_GET['product_id'] ?? null;
        if ($productid === null) {
            header("Location: products.php");
            exit();
        }
        echo '<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="text-white">Zanechajte recenziu na tovar</h3>
                </div>
                <div class="card-body">
                    <form method="post" class="f" enctype="multipart/form-data" action="product.php?id=' . $productid . '"> 
                        <div class="mb-3">
                            <label for="rating" class="form-label">Hodnotenie</label>
                            <select class="form-select" id="rating" name="rating" required>
                                <option value="" disabled selected>Vyberte hodnotenie</option>
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★☆</option>
                                <option value="3">★★★☆☆</option>
                                <option value="2">★★☆☆☆</option>
                                <option value="1">★☆☆☆☆</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="review" class="form-label">Vaša recenzia</label>
                            <textarea class="form-control" id="review" name="review" rows="5" required maxlength="1000" placeholder="Podeľte sa o svoj názor na tovar..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Priložiť fotografie (max. 5)</label>
                            <input class="form-control" type="file" id="images" name="images[]" multiple accept=".jpg, .jpeg, .png">
                            <div class="form-text text-muted">Môžete nahrať až 5 obrázkov vo formáte JPG alebo PNG</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Odoslať recenziu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>';
    }

    public function generateProduct($idtovar)
    {
        $sql = "SELECT t.idtovar AS idtovar, t.nazov AS nazov, t.popis AS popis, t.cena AS cena, t.obrazok AS obrazok, t.mnozstvo AS mnozstvo, p.rozmery AS rozmery, p.hmotnost AS hmotnost, p.zaruka AS zaruka, p.idzakladna_doska AS idzakladna_doska, p.idprocesor AS idprocesor, p.idchladenie AS idchladenie, p.idnapajaci_zdroj AS idnapajaci_zdroj, p.idoperacna_pamat AS idoperacna_pamat, p.idulozisko AS idulozisko, p.idoperacny_system AS idoperacny_system, k.nazov AS kategoria, c.nazov AS chladenie, z.nazov AS zakladna_doska, pr.nazov AS procesor, o.nazov AS operacna_pamat, u.nazov AS ulozisko, n.nazov AS napajaci_zdroj, os.nazov AS operacny_system
        FROM tovar t
        INNER JOIN podrobnosti_tovara p ON t.idpodrobnosti_tovara = p.idpodrobnosti_tovara
        INNER JOIN kategoria_tovara k ON t.idkategoria_tovara = k.idkategoria_tovara
        INNER JOIN chladenie c ON p.idchladenie = c.idchladenie
        INNER JOIN zakladna_doska z ON p.idzakladna_doska = z.idzakladna_doska
        INNER JOIN procesor pr ON p.idprocesor = pr.idprocesor
        INNER JOIN operacna_pamat o ON p.idoperacna_pamat = o.idoperacna_pamat
        INNER JOIN ulozisko u ON p.idulozisko = u.idulozisko
        INNER JOIN napajaci_zdroj n ON p.idnapajaci_zdroj = n.idnapajaci_zdroj
        INNER JOIN operacny_system os ON p.idoperacny_system = os.idoperacny_system
        WHERE idtovar = :idtovar";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':idtovar', $idtovar);
        $stmt->execute();
        $product = $stmt->fetch();
        if (empty($product)) {
            echo '<p class="text-danger mb-4">Tovar nebol nájdený.</p>';
            return;
        }

        $sql = "SELECT p.idgraficka_karta, g.nazov FROM podrobnosti_tovara_has_graficka_karta p
        INNER JOIN graficka_karta g ON p.idgraficka_karta = g.idgraficka_karta
        WHERE idpodrobnosti_tovara = :idpodrobnosti_tovara";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':idpodrobnosti_tovara', $idtovar);
        $stmt->execute();
        $graphicsCards = $stmt->fetchAll();

        $sql = "SELECT r.idrecenzia_tovara, r.text, r.hodnotenie, r.datum, p.meno, r.idpouzivatel, CONCAT(LEFT(p.priezvisko, 1), '.') AS priezvisko FROM recenzia_tovara r
        INNER JOIN tovar t ON r.idtovar = t.idtovar
        INNER JOIN pouzivatel p ON r.idpouzivatel = p.idpouzivatel
        WHERE t.idtovar = :idtovar";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':idtovar', $idtovar);
        $stmt->execute();
        $reviews = $stmt->fetchAll();

        $reviewExists = false;
        foreach ($reviews as $review) {
            if ($review['idpouzivatel'] == $_SESSION['user_id']) {
                $reviewExists = true;
                break;
            }
        }

        $sql = "SELECT dorucene FROM objednavka_tovar WHERE idpouzivatel = :idpouzivatel AND idtovar = :idtovar";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':idpouzivatel', $_SESSION['user_id']);
        $stmt->bindParam(':idtovar', $idtovar);
        $stmt->execute();
        $orders = $stmt->fetchAll();
        $orderExists = false;
        if (!empty($orders)) {
            foreach ($orders as $order) {
                if ($order['dorucene'] == 1) {
                    $orderExists = true;
                    break;
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['rating']) && isset($_POST['review'])) {
            $sql = "SELECT idrecenzia_tovara FROM recenzia_tovara WHERE idtovar = :idtovar AND idpouzivatel = :idpouzivatel";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':idtovar', $idtovar);
            $stmt->bindParam(':idpouzivatel', $_SESSION['user_id']);
            $stmt->execute();
            $existingReview = $stmt->fetch();
            if (!$existingReview) {

                $rating = $_POST['rating'];
                $review = $_POST['review'];
                $images = $_FILES['images'] ?? null;

                if ($images) {
                    $imageCount = count($images['name']);
                    if ($imageCount > 5) {
                        echo '<p class="text-danger mt-5 text-center">Môžete nahrať maximálne 5 obrázkov.</p>';
                    } else {
                        for ($i = 0; $i < $imageCount; $i++) {
                            if ($images['error'][$i] == 0) {
                                $targetDir = "uploads/reviews/";
                                if (!is_dir($targetDir)) {
                                    mkdir($targetDir, 0777, true);
                                }
                                $targetFile = $targetDir . time() . "_" . basename($images["name"][$i]);
                                move_uploaded_file($images["tmp_name"][$i], $targetFile);
                            }
                        }
                    }
                }

                try {
                    $sql = "INSERT INTO recenzia_tovara (hodnotenie, text, idtovar, idpouzivatel, datum) VALUES (:hodnotenie, :text, :idtovar, :idpouzivatel, CURRENT_DATE())";
                    $stmt = $this->connection->prepare($sql);
                    $stmt->bindParam(':hodnotenie', $rating);
                    $stmt->bindParam(':text', $review);
                    $stmt->bindParam(':idtovar', $idtovar);
                    $stmt->bindParam(':idpouzivatel', $_SESSION['user_id']);
                    $stmt->execute();
                    $sql = "SELECT idrecenzia_tovara FROM recenzia_tovara WHERE idtovar = :idtovar AND idpouzivatel = :idpouzivatel";
                    $stmt = $this->connection->prepare($sql);
                    $stmt->bindParam(':idtovar', $idtovar);
                    $stmt->bindParam(':idpouzivatel', $_SESSION['user_id']);
                    $stmt->execute();
                    $idrecenzia_tovara = $stmt->fetch()['idrecenzia_tovara'];

                    if ($images) {
                        foreach ($images['name'] as $i => $image) {
                            if ($images['error'][$i] == 0) {
                                $targetDir = "uploads/reviews/";
                                $targetFile = $targetDir . time() . "_" . basename($images["name"][$i]);
                                move_uploaded_file($images["tmp_name"][$i], $targetFile);
                                $sql = "INSERT INTO obrazok_recenzia (idrecenzia_tovara, obrazok) VALUES (:idrecenzia_tovara, :obrazok)";
                                $stmt = $this->connection->prepare($sql);
                                $stmt->bindValue(':idrecenzia_tovara', $idrecenzia_tovara);
                                $stmt->bindValue(':obrazok', $targetFile);
                                $stmt->execute();
                            }
                        }
                    }


                    echo '<p class="text-success mt-5 text-center">Recenzia bola úspešne pridaná.</p>';
                } catch (Exception $e) {
                    echo '<p class="text-danger mt-5 text-center">Nastala chyba pri pridávaní recenzie: ' . $e->getMessage() . '</p>';
                }
            }
        }

        echo '<div class="tovar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="product-image">
                        <img src="' . $product['obrazok'] . '" alt="' . $product['nazov'] . '" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-info">
                        <p class="name">' . $product['nazov'] . '</p>
                        <p class="description">' . $product['popis'] . '</p>
                        <p class="availability ' . ($product['mnozstvo'] > 0 ? 'in-stock' : 'out-of-stock') . '">' . ($product['mnozstvo'] > 0 ? 'Na sklade' : 'Vypredané') . '</p>
                        <p class="price">' . $product['cena'] . '</p>
                        <div class="row col-md-12">
                        <form method="post" action="thxyou.php">
                            <input type="hidden" name="product_id" value="' . $product['idtovar'] . '">
                            <button type="submit" class="btn btn-primary mr-2 mb-2" style="width:160px;" ' . ($product['mnozstvo'] == 0 ? "disabled" : "") . '>Kúpiť</button>
                        </form>';
        if ($orderExists && !$reviewExists) {

            echo '          <form method="get" action="writereview.php">
                            <input type="hidden" name="product_id" value="' . $product['idtovar'] . '">
                            <button type="submit" class="btn btn-primary" style="width:220px;">Zanechať recenziu</button>
                        </form>';
        }
        echo '      </div>
        </div>
                </div>
            </div>
            <!-- Detailed Description Section -->
            <div class="row mt-5 mb-5">
                <div class="col-md-12">
                    <div class="product-details">
                        <h3 class="text-center mb-4">Podrobnosti o tovare</h3>
                        <div class="product-specs">
                            <div class="spec-item">
                                <span class="spec-label">Typ procesora:</span>
                                <span class="spec-value">' . $product['procesor'] . '</span>
                            </div>';
        $gpuAmount = 0;
        foreach ($graphicsCards as $graphicsCard) {
            $gpuAmount++;
            echo '<div class="spec-item">
                                <span class="spec-label">Grafická karta' . (count($graphicsCards) > 1 ? "#" . $gpuAmount : "") . ':</span>
                                <span class="spec-value">' . $graphicsCard['nazov'] . '</span>
                            </div>';
        }
        echo '<div class="spec-item">
                                <span class="spec-label">RAM:</span>
                                <span class="spec-value">' . $product['operacna_pamat'] . '</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Úložisko:</span>
                                <span class="spec-value">' . $product['ulozisko'] . '</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Operačný systém:</span>
                                <span class="spec-value">' . $product['operacny_system'] . '</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Chladenie:</span>
                                <span class="spec-value">' . $product['chladenie'] . '</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Rozmery:</span>
                                <span class="spec-value">' . $product['rozmery'] . '</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Hmotnosť:</span>
                                <span class="spec-value">' . $product['hmotnost'] . '</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Záruka:</span>
                                <span class="spec-value">' . $product['zaruka'] . '</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        if (!empty($reviews)) {
            echo '<!-- Customer Reviews Section -->
<div class="row mt-5 mb-5">
    <div class="col-md-12">
        <div class="reviews-section">
            <h3 class="text-center mb-4">Recenzie zákazníkov</h3>';

            foreach ($reviews as $review) {
                $stars = str_repeat('★', $review['hodnotenie']) . str_repeat('☆', 5 - $review['hodnotenie']);
                echo '<div class="review-card mb-4 p-3 shadow-sm rounded">
            <div class="d-flex align-items-start w-100">
                <div>
                    <img src="images/avatars/avatar1.jpg" alt="avatar" class="img-fluid rounded-circle mr-3" style="object-fit: cover; width: 50px; height: auto;">
                </div>
                <div class="review-content flex-grow-1">
                    <h5>' . $review['meno'] . ' ' . $review['priezvisko'] . '</h5>
                    <div class="stars mb-2 text-warning" style="font-size: 1.2rem;">' . $stars . '</div>
                    <p class="mb-2">' . nl2br(htmlspecialchars($review['text'])) . '</p>';

                $sql = "SELECT obrazok FROM obrazok_recenzia WHERE idrecenzia_tovara = :idrecenzia_tovara";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(':idrecenzia_tovara', $review['idrecenzia_tovara']);
                $stmt->execute();
                $images = $stmt->fetchAll();

                if (!empty($images)) {
                    echo '<div class="review-images mb-2 mt-3">
                <h4>Priložené fotografie:</h4>
                <div class="d-flex flex-wrap gap-2">';
                    foreach ($images as $image) {
                        echo '<div class="review-image mr-2" style="">
                    <img src="' . $image['obrazok'] . '" alt="review image" class="img-fluid img-thumbnail rounded">
                  </div>';
                    }
                    echo '</div></div>';
                }

                echo '      </div>
                <div class="text-muted small text-end">
                    ' . date("d.m.Y", strtotime($review['datum'])) . '
                </div>
            </div>
          </div>';
            }

            echo '      </div>
    </div>
</div>';

        }
        echo '</div>
    </div>';
    }

    public function generateProductsList()
    {
        $dictionarySort = [
            'default' => 'ORDER BY t.idtovar DESC',
            'popularity' => 'ORDER BY (SELECT COUNT(*) FROM objednavka_tovar WHERE idtovar = t.idtovar) DESC, t.idtovar DESC',
            'cena-asc' => 'ORDER BY cena ASC',
            'cena-desc' => 'ORDER BY cena DESC'
        ];

        $nazov = $_GET['search'] ?? '';
        $sort = $_GET['sort'] ?? 'default';

        echo ' <div class="tovary">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Tovary</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="our_tovary" id="productsList">
                     <div class="row">
                        <div class="col-md-12 margin_bottom1">
                           <form id="request" method="get" action="#productsList" class="">
                              <div class="row justify-content-between">
                                 <div class="col-md-6 ">
                                    <label for="search">Zadajte názov</label><br>
                                    <input class="search" type="text" name="search" placeholder="Zadajte názov" value="' . htmlspecialchars($nazov) . '">
                                 </div>
                                 <div class="col-md-6 ">
                                    <label for="sort">Zoradiť podľa:</label><br>
                                    <select id="sort" name="sort" onchange="this.form.submit()">
                                       <option value="default" ' . optionSelect($sort, "default") . '>Predvolené zoradenie</option>
                                       <option value="cena-asc" ' . optionSelect($sort, "cena-asc") . '>Cena: od najnižšej</option>
                                       <option value="cena-desc" ' . optionSelect($sort, "cena-desc") . '>Cena: od najvyššej</option>
                                       <option value="popularity" ' . optionSelect($sort, "popularity") . '>Podľa obľúbenosti</option>
                                    </select>
                                 </div>
                              </div>
                           </form>
                        </div>';
        $sql = 'SELECT idtovar, nazov, popis, cena, obrazok, mnozstvo FROM tovar t
        WHERE nazov LIKE :nazov
        ' . $dictionarySort[$sort];
        $stmt = $this->connection->prepare($sql);
        $nazov = '%' . $nazov . '%';
        $stmt->bindParam(':nazov', $nazov);
        $stmt->execute();
        $products = $stmt->fetchAll();
        if (empty($products)) {
            echo '<div class="col-md-12">
            <p class="text-danger mb-4">Žiadne tovary nenájdené.</p>
            </div>';
        } else {
            foreach ($products as $product) {
                echo '<div class="col-md-3">
                           <a href="product.php?id=' . $product['idtovar'] . '">
                              <div class="product_box">
                                 <figure><img src="' . $product['obrazok'] . '" alt="' . $product['nazov'] . '" style="object-fit: cover;" class="p-2"/></figure>
                                 <p class="name">' . $product['nazov'] . '</p>
                                 <p class="availability ' . ($product['mnozstvo'] > 0 ? 'in-stock' : 'out-of-stock') . '">' . ($product['mnozstvo'] > 0 ? 'Na sklade' : 'Vypredané') . '</p>
                                 <p class="price">' . $product['cena'] . '</p>
                              </div>
                           </a>
                        </div>';
            }
        }
        echo '</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>';
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
                $sql = "DELETE FROM objednavka_tovar WHERE idtovar = :id";
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
                <h4 class="mb-0 text-white"><i class="bi bi-trash mr-2"></i>Odstránenie tovarov</h4>
            </div>
            <div class="card-body">
                <form id="request" action="?page=adminpanel&form=remove-products#removeProductsCard" method="post">
                    <div class="form-group mb-3">
                        <label for="id">Vyberte tovar</label>
                        <select class="form-control" id="id" name="id" required>
                            <option value="" disabled selected>Vyberte tovar</option>';
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
                <h4 class="mb-0 text-white"><i class="bi bi-plus-square mr-2"></i>Pridanie tovarov</h4>
            </div>
            <div class="card-body">
                <form id="request" action="?page=adminpanel&form=add-products#addProductsCard" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="nazov">Zadajte názov tovaru</label>
                        <input type="text" class="form-control" id="nazov" name="nazov" placeholder="Názov tovaru" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="popis">Zadajte popis tovaru</label>
                        <textarea class="form-control" id="popis" name="popis" rows="3" placeholder="Popis tovaru" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cena">Zadajte cenu tovaru</label>
                        <input type="number" class="form-control" id="cena" name="cena" placeholder="Cena tovaru" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="obrazok">Zadajte obrázok tovaru</label>
                        <input type="file" class="form-control" id="obrazok" name="obrazok" accept="image/*" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="mnozstvo">Zadajte množstvo tovaru</label>
                        <input type="number" class="form-control" id="mnozstvo" name="mnozstvo" placeholder="Množstvo tovaru" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="idkategoria_tovara">Vyberte kategóriu tovaru</label>
                        <select class="form-control" id="idkategoria_tovara" name="idkategoria_tovara" required>
                            <option value="" disabled selected>Vyberte kategóriu</option>';
        $categories = $this->getData("kategoria_tovara");
        foreach ($categories as $category) {
            echo '          <option value="' . $category['idkategoria_tovara'] . '">' . $category['nazov'] . '</option>';
        }
        echo '          </select>
                    </div>
                    <div class="form-group-mb-3">
                        <label for="rozmery">Zadajte rozmer tovaru</label>
                        <input type="text" class="form-control" id="rozmery" name="rozmery" placeholder="Rozmer tovaru" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="hmotnost">Zadajte hmotnosť tovaru</label>
                        <input type="text" class="form-control" id="hmotnost" name="hmotnost" placeholder="Hmotnosť tovaru" required>
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
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
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
                    <img src="' . $data['obrazok'] . '" style="width: 30%; height: auto;" class="img-fluid mb-2" alt="' . $data['nazov'] . '">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Názov tovaru:</strong>
                            <div>' . $data["nazov"] . '</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Popis tovaru:</strong>
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
            echo '<img src="' . $row['obrazok'] . '" style="width: 20%; height: auto;" class="img-fluid mb-2" alt="' . $row['nazov'] . '">';
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