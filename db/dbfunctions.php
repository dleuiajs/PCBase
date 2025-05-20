<?php
namespace databaza;
require_once("db/config.php");
use PDO, PDOException;

class Database
{
    protected $connection;
    protected function connect()
    {
        $config = DATABASE;
        // možnosti
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // nastaví režim hlásenia chýb na výnimky
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // nastaví predvolený režim načítanie dát do asociatívnych polí
        );

        // pripojenie PDO
        try {
            $conn = new PDO("mysql:host=" . $config["HOST"] . ";dbname=" . $config["DBNAME"] . ";port=" . $config["PORT"], $config["USER_NAME"], $config["PASSWORD"], $options);
            return $conn;
        } catch (PDOException $e) {
            die("Chyba propojenia: " . $e->getMessage());
        }
    }

    protected function getConnection()
    {
        return $this->connect();
    }

    protected function getData($nazov, $orderDesc = null, $additionally = null, $single = false)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM ' . $nazov . ($additionally !== null ? ' ' . $additionally . ' ' : '') . ($orderDesc !== null ? ' ORDER BY ' . $orderDesc . ' DESC' : ''));
            $stmt->execute();
            if ($single) {
                return $stmt->fetch();
            } else {
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            echo "Chyba: " . $e->getMessage();
            return false;
        }
    }

    protected function getColumnNames($nazov)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM ' . $nazov . ' LIMIT 1');
            $stmt->execute();
            return array_keys($stmt->fetch());
        } catch (PDOException $e) {
            echo "Chyba: " . $e->getMessage();
            return false;
        }
    }
}
?>