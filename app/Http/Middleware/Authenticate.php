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
        if (! $request->expectsJson()) {
            if(Route::is('user.*') || Route::is('diagnosis.*')) {
                return route($user_route);
            } elseif (Route::is('company.*')) {
                return redirect('/');
            }
        }
    }
}
