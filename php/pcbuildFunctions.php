<?php
namespace pcbuild;
error_reporting(E_ALL);
ini_set("display_errors", "On");
require_once(__ROOT__ . "/db/dbfunctions.php");
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
        $rozpocet = $_POST['rozpocet'] ?? 0;
        $idzakladna_doska = $_POST['zakladna_doska'] ?? 0;
        $idgraficka_karta = $_POST['graficka_karta'] ?? 0;
        $idprocesor = $_POST['procesor'] ?? 0;
        $idoperacna_pamat = $_POST['operacna_pamat'] ?? 0;
        $idnapajaci_zdroj = $_POST['napajaci_zdroj'] ?? 0;
        $idchladenie = $_POST['chladenie'] ?? 0;
        $idoperacny_system = $_POST['operacny_system'] ?? 0;
        $idulozisko = $_POST['ulozisko'] ?? 0;
        $this->insertObjednavka_Zostavenie($rozpocet, $idpouzivatel, $idzakladna_doska, $idgraficka_karta, $idprocesor, $idoperacna_pamat, $idnapajaci_zdroj, $idchladenie, $idoperacny_system, $idulozisko);
        $this->connection = null; // uzavrie pripojenie nastavením na null
    }

    private function insertObjednavka_Zostavenie($rozpocet, $idpouzivatel, $idzakladna_doska, $idgraficka_karta, $idprocesor, $idoperacna_pamat, $idnapajaci_zdroj, $idchladenie, $idoperacny_system, $idulozisko)
    {
        $sql = "INSERT INTO objednavka_zostavenie (dorucene, datum, rozpocet, idpouzivatel, idzakladna_doska, idgraficka_karta, idprocesor, idoperacna_pamat, idnapajaci_zdroj, idchladenie, idoperacny_system, idulozisko) VALUES (0, CURRENT_TIMESTAMP, :rozpocet, :idpouzivatel, :idzakladna_doska, :idgraficka_karta, :idprocesor, :idoperacna_pamat, :idnapajaci_zdroj, :idchladenie, :idoperacny_system, :idulozisko)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':rozpocet', $rozpocet);
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
                        <button class="send_btn" type="submit">Odoslať</button>
                     </div>
                  </div>
               </form>';
    }
}
?>