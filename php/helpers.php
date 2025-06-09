<?php
namespace functions;
class Helpers
{
    public static function neuvedeneIfNull($value)
    {
        return !empty($value) ? htmlspecialchars($value) : 'Neuvedené';
    }

    public static function optionSelect($variable, $value, $name)
    {
        echo '<option value="'.$value.'" ' . ($variable == $value ? 'selected' : '') . '>' . $name . '</option>';
    }
}
?>