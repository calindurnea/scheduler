<?php

namespace App\Http\Middleware;

use Closure;

class Manager
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
        if (auth()->check() && (auth()->user()->is('admin') || auth()->user()->is('manager'))){
            return $next($request);
        }
        return redirect('users')->with('error', 'Action permitted only for manager');
    }
}
