<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The API documentation lists every endpoint and its rules, so it is not public.
 * It is available on a local machine, or to a request that carries a valid API token.
 * Everyone else gets a plain 404, as if the page did not exist.
 */
class RestrictApiDocumentation
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('local') || $request->user('api')) {
            return $next($request);
        }

        abort(404);
    }
}
