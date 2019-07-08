<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserRedirects
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::user();
        $path = '/';
        $needRedirect = false;
        $requestUrl = $request->getPathInfo();
        if ($user) {
            if (!$user->varification_pending && !$user->is_verified && $requestUrl != getenv('VALIDATION_PAGE')) {
                $path = '/validation';
                $needRedirect = true;
            } else if ($user->varification_pending && !$user->is_verified && $requestUrl == getenv('BASE_LOGEDIN_PAGE')) {
                $path = '/profile?show_pending_popup=1';
                $needRedirect = true;
            }
            if ($request->has('show_profile_setup_profile') && $requestUrl == getenv('BASE_LOGEDIN_PAGE')) {
                $path = '/profile?show_profile_setup_profile=1';
                $needRedirect = true;
            }
        }
        if ($needRedirect) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('', 401)->json(['redirect' => url($path)]);
            } else {
                return redirect($path);
            }
        }

        return $next($request);
    }
}
