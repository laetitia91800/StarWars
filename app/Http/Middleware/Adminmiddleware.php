<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Adminmiddleware
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
        $role= Auth::user()->role;

        if($role !='administrator') {
            return redirect('/');
        }

        return $next($request);

    }
}