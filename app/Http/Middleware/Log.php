<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Log
{
    public function handle($request, Closure $next)
    {
        // Your logic here

        return $next($request);
    }
}
