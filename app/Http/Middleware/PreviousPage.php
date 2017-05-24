<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Illuminate\Http\Request;

class PreviousPage
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
        $currentUrl = Request::capture()->fullUrl();

        if($currentUrl != \Session::get('real-current-url')) {
            \Session::put('real-previous-url', \Session::get('real-current-url'));
            \Session::put('real-current-url',$currentUrl);
            \Session::save();
        }

        return $next($request);
    }
}
