<?php

class Blacklist
{
    private static $list;

    public static function contains($value)
    {
        if (!self::$list) {
            self::$list = require('../application/config/blacklist.php');
        }

        if (in_array($value, self::$list)){
            return true;
        }else{
            return false;
        }
    }
}
