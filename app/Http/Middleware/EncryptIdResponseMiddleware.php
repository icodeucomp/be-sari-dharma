<?php

namespace App\Http\Middleware;

use App\Helpers\Cryptor;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EncryptIdResponseMiddleware
{
    /**
     * Handle an outgoing response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $cryptor = new Cryptor();
            $content = json_decode($response->getContent(), true);

            if (isset($content['success']) && $content['success'] === true) {
                if (isset($content['data'])) {
                    // Check if the data is paginated
                    if (isset($content['data']['data']) && is_array($content['data']['data'])) {
                        // Process paginated data
                        foreach ($content['data']['data'] as &$item) {
                            if (isset($item['id'])) {
                                $item['id'] = $cryptor->encrypt($item['id']);
                            }
                        }
                    } elseif (is_array($content['data'])) {
                        // Process non-paginated array data
                        if (array_is_list($content['data'])) {
                            foreach ($content['data'] as &$item) {
                                if (isset($item['id'])) {
                                    $item['id'] = $cryptor->encrypt($item['id']);
                                }
                            }
                        } else {
                            // Single object
                            if (isset($content['data']['id'])) {
                                $content['data']['id'] = $cryptor->encrypt($content['data']['id']);
                            }
                        }
                    }
                }
                $response->setContent(json_encode($content));
            }
        }

        return $response;
    }
}
