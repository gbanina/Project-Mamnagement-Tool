<?php
/*App\Helpers\PMTypesHelper*/
namespace App\Helpers;

class PMTypesHelper{

    public static function dateToSQL($date){
        $arr = explode('/', $date);
        return $arr[2] . '-' . $arr[0] . '-' . $arr[1];
    }

    public static function dateToHuman($date){
        $arr = explode('-', $date);
        if(count ($arr) != 3) return 'N/A';
        return $arr[1] . '/' . $arr[2] . '/' . $arr[0];
    }

    public static function fieldTypeSelect(){
        return array('NUMBER' => 'Number',
                        'INPUT' => 'Word',
                        'TEXTAREA' => 'Text',
                        'DATE' => 'Date',
                        'USER' => 'User',
            );
    }
}
