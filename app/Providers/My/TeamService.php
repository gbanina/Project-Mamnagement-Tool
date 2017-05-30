<?php

namespace App\Providers\My;

use Illuminate\Support\ServiceProvider;
use App\Providers\Admin\UserServiceProvider;

class TeamService extends ServiceProvider
{
    public function __construct(){
        //
    }

   public function all() {
        $userService = new UserServiceProvider();
        return $userService->all();
   }
}
