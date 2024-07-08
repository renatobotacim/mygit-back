<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request as RequestAlias;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param RequestAlias $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(RequestAlias $request, Closure $next): mixed
    {
        // Log request details
        Log::info('Request Details:', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'input' => $request->all()
        ]);

        return $next($request);
    }
}
