<?php

namespace App\Http\Middleware;

use Closure;

class Breadcrumb
{
    public function handle($request, Closure $next, $breadcrumb)
    {
        view()->share('breadcrumb', $breadcrumb);
        return $next($request);
    }
}
