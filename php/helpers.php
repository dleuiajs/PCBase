<?php
namespace functions;
class Helpers
{
    public static function neuvedeneIfNull($value)
    {
        return !empty($value) ? $value : 'Neuvedené';
    }

    public static function optionSelect($variable, $value)
    {
        return $variable == $value ? 'selected' : '';
    }
}
?>