<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminAccess
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
        $accountType = Auth::user()->getCurrentRoleAttribute();

        if ($accountType == 'OWNER' || $accountType == 'ADMIN') {
            return $next($request);
        }
        return redirect('home');
    }
}
