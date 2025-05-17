<?php
namespace users;
ini_set("display_errors", "On");
require_once(__ROOT__ . "/db/dbfunctions.php");
use Exception, databaza\Database;

class Users extends Database
{
    private $idrola;

    public function __construct()
    {
        $this->idrola = 1; // predvolená rola
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function handlerRegister()
    {
        $meno = $_POST['meno'];
        $priezvisko = $_POST['priezvisko'];
        $email = $_POST['email'];
        $heslo = $_POST['heslo'];
        $heslo_confirm = $_POST['heslo_confirm'];

        if (empty($meno) || empty($priezvisko) || empty($email) || empty($heslo)) {
            throw new Exception("Všetky polia sú povinné.");
        } else if ($heslo !== $heslo_confirm) {
            throw new Exception("Heslá sa nezhodujú.");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Neplatný formát e-mailu.");
        } else if (strlen($heslo) < 6) {
            throw new Exception("Heslo musí mať aspoň 6 znakov.");
        } else if (!preg_match('/[0-9]/', $heslo)) {
            throw new Exception("Heslo musí obsahovať aspoň jedno číslo.");
        }
        $this->register($meno, $priezvisko, $email, $heslo);
    }

    public function handlerLogin()
    {
        $email = $_POST['email'];
        $heslo = $_POST['heslo'];
        if (empty($email) || empty($heslo)) {
            throw new Exception("Všetky polia sú povinné.");
        }
        $this->login($email, $heslo);
    }

    private function register($meno, $priezvisko, $email, $heslo)
    {
        $hashedPassword = password_hash($heslo, PASSWORD_BCRYPT);
        $sql = "SELECT * FROM pouzivatel WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            throw new Exception("Email už existuje.");
        }
        $sql = "INSERT INTO pouzivatel (meno, priezvisko, email, heslo, rola_idrola) VALUES (:meno, :priezvisko, :email, :heslo, :rola_idrola)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':meno', $meno);
        $stmt->bindParam(':priezvisko', $priezvisko);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':heslo', $hashedPassword);
        $stmt->bindParam(':rola_idrola', $this->idrola);
        $stmt->execute();
        $this->connection = null; // uzavrie pripojenie nastavením na null
    }

    private function login($email, $heslo)
    {
        $sql = "SELECT * FROM pouzivatel WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
        if (!$user) {
            throw new Exception("Používateľ s daným e-mailom neexistuje.");
        }
        if (!password_verify($heslo, $user['heslo'])) {
            throw new Exception("Nesprávne heslo.");
        }
        $_SESSION['user_id'] = $user['idpouzivatel'];
        $_SESSION['user_meno'] = $user['meno'];
        $_SESSION['user_priezvisko'] = $user['priezvisko'];
        $_SESSION['user_idrola'] = $user['rola_idrola'];
        $_SESSION['user_email'] = $user['email'];
        $this->connection = null; // uzavrie pripojenie nastavením na null
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;
    }

    public function getName()
    {
        return $_SESSION['user_meno'] . " " . $_SESSION['user_priezvisko'];
    }

    public function getEmail()
    {
        return $_SESSION['user_email'];
    }
    public function getRole()
    {
        $sql = "SELECT nazov FROM rola WHERE idrola = :idrola";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':idrola', $_SESSION['user_idrola']);
        $stmt->execute();
        $role = $stmt->fetchColumn();
        return $role;
    }
}
?>