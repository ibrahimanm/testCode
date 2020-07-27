<?php

namespace App\Http\Middleware;

use Closure;

class Dashboard
{
    public function handle($request, Closure $next, $guard = null)
    {
        app()->setLocale('ar');

        return $next($request);
    }
}
