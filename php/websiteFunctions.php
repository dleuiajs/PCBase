<?php
namespace functions;

class WebsiteFunctions
{
    public static function loadPart(string $name)
    {
        $path = "parts/" . $name . ".php";
        if (!require_once($path)) {
            echo "Chyba: Nepodarilo sa načítať" . $name . ".php";
        }
    }
}
?>