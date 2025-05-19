<?php
function loadPart(string $name)
{
    $path = "parts/" . $name . ".php";
    if (!require_once($path)) {
        echo "Chyba: Nepodarilo sa načítať" . $name . ".php";
    }
}
function neuvedeneIfNull($value)
{
    return !empty($value) ? $value : 'Neuvedené';
}

function optionSelect($variable, $value)
    {
        return $variable == $value ? 'selected' : '';
    }

?>