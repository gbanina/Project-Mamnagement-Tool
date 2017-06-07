<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use URL;
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
        $currentUrl = URL::previous();

        if($currentUrl != \Session::get('real-last-url')) {
                \Session::put('real-previous-url', \Session::get('real-last-url'));
                \Session::put('real-last-url',$currentUrl);
                \Session::save();
            }
        return $next($request);
    }
}
