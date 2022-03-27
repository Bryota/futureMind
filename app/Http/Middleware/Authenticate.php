<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $user_route = 'login';
        $company_route = 'company.login';
        $admin_route = 'admin.login';
        if (!$request->expectsJson()) {
            if (Route::is('company.*')) {
                return route($company_route);
            } else if (Route::is('admin.*')) {
                return route($admin_route);
            } else {
                return route($user_route);
            }
        }
    }
}
