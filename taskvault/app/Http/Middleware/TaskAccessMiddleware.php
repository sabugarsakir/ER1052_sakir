<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Demonstration of a middleware: log task access or creation
        \Log::info('TaskAccessMiddleware triggered for URL: ' . $request->url());

        return $next($request);
    }
}
