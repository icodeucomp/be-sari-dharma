<?php

namespace App\Http\Middleware;

use App\Helpers\Cryptor;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UniversalIdCryptorMiddleware
{
    protected $resources = [
        'featured_service',
        'specialist_service',
        'services',
        'schedule',
        'health_package',
        'health_article',
        'community_event',
        'quality_indicator',
        'career',
        'social_media_content',
        'certification_award',
        'category',
        'job',
    ];

    public function handle(Request $request, Closure $next)
    {
        $this->decryptRequestIds($request);

        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $this->encryptResponseIds($response);
        }

        return $response;
    }

    protected function decryptRequestIds(Request $request)
    {
        $cryptor = new Cryptor;
        $route = Route::getCurrentRoute();

        if (! $route) {
            return;
        }

        $parameters = $route->parameters();

        foreach ($this->resources as $resource) {
            $resourceParam = 'id';

            if (isset($parameters[$resourceParam])) {
                try {
                    $decryptedId = $cryptor->decrypt($parameters[$resourceParam]);
                    $route->setParameter($resourceParam, $decryptedId);
                } catch (\Exception $e) {
                }
            }
        }
    }

    protected function encryptResponseIds(JsonResponse $response)
    {
        $cryptor = new Cryptor;
        $content = json_decode($response->getContent(), true);

        if (isset($content['success']) && $content['success'] === true && isset($content['data'])) {
            if (isset($content['data']['data']) && is_array($content['data']['data'])) {
                foreach ($content['data']['data'] as &$item) {
                    if (isset($item['id']) && $this->isIdValue($item['id'])) {
                        $item['id'] = $cryptor->encrypt($item['id']);
                    }
                }
            } elseif (is_array($content['data'])) {
                if (array_is_list($content['data'])) {
                    foreach ($content['data'] as &$item) {
                        if (isset($item['id']) && $this->isIdValue($item['id'])) {
                            $item['id'] = $cryptor->encrypt($item['id']);
                        }
                    }
                } elseif (isset($content['data']['id']) && $this->isIdValue($content['data']['id'])) {
                    $content['data']['id'] = $cryptor->encrypt($content['data']['id']);
                }
            }

            $response->setContent(json_encode($content));
        }
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
