<?php
namespace App\Helpers;

class Helper
{
    public static function toInt($str)
    {
        return (int)preg_replace("/\..+$/i", "", preg_replace("/[^0-9\.]/i", "", $str));
    }
}
