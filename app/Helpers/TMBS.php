<?php
namespace App\Helpers;

use URL;

class TMBS{
    public static function url($url)
    {
        $account = auth()->user()->current_acc;
        return URL::to($account . '/' . $url);
    }
    public static function acc()
    {
        return auth()->user()->current_acc;
    }
}
