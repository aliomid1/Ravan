<?php

namespace App\Http\Middleware;

use Closure;

class MustBeUser
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
        
        if (auth()->user()) {
            return $next($request);
        }
        return redirect(route('Web.auth.Login'));
    }
}
