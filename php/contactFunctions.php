<?php
namespace contact;
error_reporting(E_ALL);
ini_set("display_errors", "On");
require_once(__ROOT__ . "/db/dbfunctions.php");
use Exception, databaza\Database;

class ContactFunctions extends Database
{
    protected $connection;

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
    }

    private function insertContact($meno, $email, $tel_cislo, $sprava)
    {
        try {
            $sql = "INSERT INTO objednavka_kontakt (meno, email, tel_cislo, sprava, preskumane) VALUES (:meno, :email, :tel_cislo, :sprava, 0)";
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
}
?>