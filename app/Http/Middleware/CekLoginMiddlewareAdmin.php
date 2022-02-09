<?php

namespace App\Http\Middleware;

use Closure;

class CekLoginMiddlewareAdmin
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
        if(!session('gotodashboardadmin')){
            return redirect('/');
        }
        return $next($request);
    }
}
