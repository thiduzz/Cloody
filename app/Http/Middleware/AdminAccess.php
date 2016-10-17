<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {

            if ($request->ajax() || $request->wantsJson()) {
                return response(401);
            } else {
                return redirect()->guest('login');
            }
        }
        if (Auth::user()->hasRole('admin')) {
            if (Auth::user()->isImpersonating() == false) {
                if (($request->ajax() || $request->wantsJson()) && $request->route()->getPrefix() != 'api') {
                    return response(401);
                }
            }
            return $next($request);
        }

        abort(401, 'Unauthorized.');
    }
}
