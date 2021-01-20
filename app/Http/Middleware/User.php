<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {
        if (Auth::guard($guard)->check()) {

            if (Session::get('AdvisorRedireact')) {
                $id = Session::get('AdvisorRedireact');
                session()->forget('AdvisorRedireact');
                return redirect(route('Web.ProfileMoshaver', ['id' => $id]));
            }
            return $next($request);
        } else {
            return redirect(route('Web.index'));
        }
    }
}
