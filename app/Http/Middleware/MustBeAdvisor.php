<?php

namespace App\Http\Middleware;

use Closure;

class MustBeAdvisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $guard = 'advisor')
    {
        if (auth()->guard($guard)->check()) {
            return $next($request);
        }
        abort(403, 'براي دسترسي به اين صفحه بايد به عنوان مشاور ثبت نام کرده باشید.');
    }
}
