<?php

namespace App\Http\Middleware;

use App\Helpers\Cryptor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RecursiveDecryptIdRequestMiddleware
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

                // Replace the encrypted ID with the decrypted one, only if decryption was successful
                if ($decryptedId !== false) {
                    $route->setParameter('id', $decryptedId);
                }
            }
        }

        // Decrypt all request parameters that end with '_id'
        $this->decryptRequestIds($request, $cryptor);

        return $next($request);
    }

    /**
     * Decrypt all request parameters that end with '_id'
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Helpers\Cryptor  $cryptor
     * @return void
     */
    protected function decryptRequestIds(Request $request, Cryptor $cryptor)
    {
        // Dekripsi params dari query string (GET)
        $queryParams = $request->query();
        $processedQueryParams = $this->processArrayRecursively($queryParams, $cryptor);
        foreach ($processedQueryParams as $key => $value) {
            $request->query->set($key, $value);
        }

        // Dekripsi params dari form/input (POST, PUT, dll)
        $inputParams = $request->all();
        $processedInputParams = $this->processArrayRecursively($inputParams, $cryptor);
        $request->replace($processedInputParams);

        // Khusus untuk JSON request body
        if ($request->isJson()) {
            $jsonParams = $request->json()->all();
            $processedJsonParams = $this->processArrayRecursively($jsonParams, $cryptor);
            $request->replace($processedJsonParams);
        }
    }

    /**
     * Process array and its children recursively to decrypt '_id' fields
     *
     * @param  array  $data
     * @param  \App\Helpers\Cryptor  $cryptor
     * @return array
     */
    protected function processArrayRecursively($data, Cryptor $cryptor)
    {
        if (!is_array($data)) {
            return $data;
        }

        $result = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // Recursively process nested arrays/objects
                $result[$key] = $this->processArrayRecursively($value, $cryptor);
            } elseif (is_string($value) && !empty($value) && $this->shouldDecrypt($key)) {
                // Try to decrypt if the key ends with '_id'
                try {
                    $decryptedValue = $cryptor->decrypt($value);
                    // Gunakan nilai asli jika hasil dekripsi adalah false
                    $result[$key] = ($decryptedValue !== false) ? $decryptedValue : $value;
                } catch (\Exception $e) {
                    // Keep original value if decryption fails
                    $result[$key] = $value;
                }
            } else {
                // Keep other values unchanged
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Determine if a key should be decrypted
     *
     * @param  string  $key
     * @return bool
     */
    protected function shouldDecrypt($key)
    {
        // Dekripsi field yang berakhiran dengan '_id'
        return str_ends_with($key, '_id');
    }
}
