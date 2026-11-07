<?php

namespace App\Http\Middleware;

use App\Helpers\Cryptor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DecryptIdRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $route = Route::getCurrentRoute();

        if ($route && array_key_exists('id', $route->parameters())) {
            $id = (new Cryptor)->decryptId($route->parameter('id'));

            if ($id === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found',
                    'data' => null,
                ], 404);
            }

            $route->setParameter('id', $id);
        }

        return $next($request);
    }
}
