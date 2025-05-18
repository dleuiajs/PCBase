<?php
namespace account;
error_reporting(E_ALL);
ini_set("display_errors", "On");
require_once(__ROOT__ . "/db/dbfunctions.php");
use Exception, databaza\Database;

class AccountFunctions extends Database
{
    public function __construct()
    {
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function getPCBuildMsg()
    {
        return $this->getData("objednavka_zostavenie");
    }

    public function getProductsMsg()
    {
        return $this->getData("objednavka_tovar");
    }

    public function getSidebarElements()
    {
        $elements = [];
        // načítanie údajov zo súboru json
        $data = json_decode(file_get_contents("json/accountSidebar.json"), true);
        // pre každý odkaz
        foreach ($data['accountSidebar'] as $item) {
            if (in_array($_SESSION['user_idrola'], $item['roles'])) {
                $elements[] = $item['href'];
            }
        }
        return $elements;
    }

    public function sidebarGenerator()
    {
        echo '<div class="col-md-4">
                <ul class="list-group">';
        // načítanie údajov zo súboru json
        $data = json_decode(file_get_contents("json/accountSidebar.json"), true);
        // pre každý odkaz
        foreach ($data['accountSidebar'] as $item) {
            if (in_array($_SESSION['user_idrola'], $item['roles'])) {
                echo '<li class="list-group-item">';
                echo '<a href="?page=' . $item['href'] . '">' . $item['text'] . '</a>';
                echo '</li>';
            }
        }
        echo '</ul>
            </div>';
    }
}
?>