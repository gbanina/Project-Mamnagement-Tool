<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Illuminate\Http\Request;
use App\Providers\Admin\AccountService;

class AccountVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         $account = explode('/', $_SERVER['REQUEST_URI']);
         $account = $account[1];

         if(auth()->user()->current_acc != $account) {
            $accountService = new AccountService();
            $accountService->switch($account);
         }
        //dd($acc);
        return $next($request);
    }
}
