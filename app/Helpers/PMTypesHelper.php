<?php
/*App\Helpers\PMTypesHelper*/
namespace App\Helpers;
use DateTime;

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

    public static function timeElapsedString($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
