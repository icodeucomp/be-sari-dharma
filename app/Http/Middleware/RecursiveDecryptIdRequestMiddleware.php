<?php

namespace App\Http\Middleware;

use App\Helpers\Cryptor;
use Closure;
use Illuminate\Http\Request;

class RecursiveDecryptIdRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $cryptor = new Cryptor;

        $this->decryptRequestIds($request, $cryptor);

        return $next($request);
    }

    protected function decryptRequestIds(Request $request, Cryptor $cryptor)
    {
        $queryParams = $request->query();
        $processedQueryParams = $this->processArrayRecursively($queryParams, $cryptor);
        foreach ($processedQueryParams as $key => $value) {
            $request->query->set($key, $value);
        }

        $inputParams = $request->all();
        $processedInputParams = $this->processArrayRecursively($inputParams, $cryptor);
        $request->replace($processedInputParams);
    }

    protected function processArrayRecursively($data, Cryptor $cryptor)
    {
        if (! is_array($data)) {
            return $data;
        }

        $result = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->processArrayRecursively($value, $cryptor);
            } elseif (is_string($value) && ! empty($value) && $this->shouldDecrypt($key)) {
                try {
                    $decryptedValue = $cryptor->decrypt($value);
                    $result[$key] = ($decryptedValue !== false) ? $decryptedValue : $value;
                } catch (\Exception $e) {
                    $result[$key] = $value;
                }
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    protected function shouldDecrypt($key)
    {
        return str_ends_with($key, '_id');
    }
}
