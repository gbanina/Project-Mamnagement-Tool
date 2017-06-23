<?php
namespace App\Helpers;

use URL;
use App\Models\UserAccounts;
use App\Models\WorkingOn;

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
    public static function isOwner()
    {
        $account = UserAccounts::where('user_id', auth()->user()->id)
                                ->where('account_id', auth()->user()->current_acc)->first();
        if($account != null) {
            if($account->type == 'OWNER') {
                return true;
            }
        }

        return false;
    }

    public static function timeCounter()
    {
        $working = WorkingOn::where('account_id', auth()->user()->current_acc)
                            ->where('user_id', auth()->user()->id)->first();
        if($working == null) {
            return '';
        }
        //$start = str_replace('-', '/', $working->start_time);
        $start = str_replace(' ', 'T', $working->start_time);
        $html = '<li>
                  <div class="menu-count-wrap">
                    <h2>'. str_limit($working->task->name, $limit = 40, $end = '...') .' -
                    <span id="tmb-count" class="tmb-count">
                    </span>
                    <span class="stop-count-button">
                        <a href="' . TMBS::url('workingon/end/'.$working->task->id) . '">
                            <i class="fa fa-power-off"></i>
                        </a>
                    </span>
                    </h2>
                  </div>
                </li>
                <script>
                $( document ).ready(function() {
                    tmbsUpdateClock("'.$working->start_time.'", "'.$working->task->name.'");
                    setInterval(\'tmbsUpdateClock("'.$working->start_time.'", "'.$working->task->name.'")\', 1000 );
                });
                </script>';

        return $html;
    }
    public static function siteTitle()
    {
        $working = WorkingOn::where('account_id', auth()->user()->current_acc)
                            ->where('user_id', auth()->user()->id)->first();
        if($working == null) {
            return '<title id="clock">TeamBiosis</title>';
        }
        return '<title id="tmb-count-title" class="tmb-count-title"></title>';
    }
}
