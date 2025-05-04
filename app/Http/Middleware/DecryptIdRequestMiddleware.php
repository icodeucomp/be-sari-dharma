<?php

namespace App\Http\Middleware;

use App\Helpers\Cryptor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DecryptIdRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cryptor = new Cryptor();

        // Get the current route
        $route = Route::getCurrentRoute();

        if ($route) {
            // Check if the route has 'id' parameter
            $parameters = $route->parameters();

            if (isset($parameters['id'])) {
                // Decrypt the ID
                $decryptedId = $cryptor->decrypt($parameters['id']);

                // Replace the encrypted ID with the decrypted one
                $route->setParameter('id', $decryptedId);
            }

            // You can add more resource types here
            // For example: 'layanan_spesialis', 'karir', etc.
        }

        return $next($request);
    }
}
