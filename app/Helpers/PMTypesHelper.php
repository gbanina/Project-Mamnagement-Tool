<?php

namespace App\Helpers;

class PMTypesHelper{

    public static function dateToSQL($date){
        $arr = explode('/', $date);
        return $arr[2] . '-' . $arr[0] . '-' . $arr[1];
    }

    public static function dateToHuman($date){
        $arr = explode('-', $date);
        return $arr[1] . '/' . $arr[2] . '/' . $arr[0];
    }
}
