<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            if (Request::is(app()->getLocale() . '/customer/dashboard')) {
                return route('selection');
            } else {
                return route('selection');
            }
        } else {
            return route('selection');
        }
        // return $request->expectsJson() ? null : route('login');
    }
}
