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
            $skipPaths = [
                '/save-geo-data',
                '/save-share',
                '/push-notification-token',
                '/files',
                '/admin',
                '/check_unique_val'
            ];
            $skipPathsLogin = [
                '/check_unique_val',
                '/admin',
            ];
            if($user->type != getenv('USERS_TYPE_USER')) {
                return redirect('/admin');
            }
            if (strpos($requestUrl, '/files/') !== false) {
                $requestUrl = '/files';
            }
            if (strpos($requestUrl, '/admin') !== false) {
                $requestUrl = '/admin';
            }
            if (strpos($requestUrl, '/check_unique_val') !== false) {
                $requestUrl = '/check_unique_val';
            }
            if ($user->type != getenv('USERS_TYPE_USER') && $requestUrl != '/logout' && !in_array($requestUrl, $skipPaths)) {
                $needRedirect = true;
                $path = '/logout';
            } else {
                if (!in_array($requestUrl, $skipPathsLogin)) {
                    Auth::loginUsingId($user->id, true);
                }
                if (!$user->phone && $requestUrl != '/phone-validation' && !in_array($requestUrl, $skipPaths)) {
                    $path = '/phone-validation';
                    $needRedirect = true;
                }else if (!$user->varification_pending && !$user->is_verified && $requestUrl != getenv('VALIDATION_PAGE') && !in_array($requestUrl, $skipPaths)) {
                    $path = '/validation';
                    $needRedirect = true;
                } else if ($user->varification_pending && !$user->is_verified && $requestUrl == getenv('BASE_LOGEDIN_PAGE') && !in_array($requestUrl, $skipPaths)) {
                    $path = '/profile?show_pending_popup=1';
                    $needRedirect = true;
                }
                if ($request->has('show_profile_setup_profile') && $requestUrl == getenv('BASE_LOGEDIN_PAGE')) {
                    $path = '/profile?show_profile_setup_profile=1';
                    $needRedirect = true;
                }
            }
        }
        if ($needRedirect) {
            if ($request->ajax() || $request->wantsJson()) {
                return response(['redirect' => url($path)], 401, ['Content-Type: application/json']);
            } else {
                return redirect($path);
            }
        }

        return $next($request);
    }
}
