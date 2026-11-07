<?php

namespace App\Http\Middleware;

use App\Helpers\Cryptor;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EncryptIdResponseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $cryptor = new Cryptor;
            $content = json_decode($response->getContent(), true);

            if (isset($content['success']) && $content['success'] === true) {
                if (isset($content['data'])) {
                    $content['data'] = $this->processArrayRecursively($content['data'], $cryptor);
                    $response->setContent(json_encode($content));
                }
            }
        }

        return $response;
    }

    protected function processArrayRecursively($data, Cryptor $cryptor)
    {
        if (! is_array($data)) {
            return $data;
        }

        $result = [];

        foreach ($data as $key => $value) {
            if (is_string($key) && str_ends_with($key, '_id') && $this->isIdValue($value)) {
                $result[$key] = $cryptor->encrypt($value);
            } elseif ($key === 'id' && $this->isIdValue($value)) {
                $result[$key] = $cryptor->encrypt($value);
            } elseif (is_array($value)) {
                $result[$key] = $this->processArrayRecursively($value, $cryptor);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    protected function isIdValue($value): bool
    {
        if (is_null($value) || is_array($value)) {
            return false;
        }

        if (is_int($value)) {
            return true;
        }

        if (is_string($value) && is_numeric($value)) {
            return true;
        }

        return false;
    }
}
