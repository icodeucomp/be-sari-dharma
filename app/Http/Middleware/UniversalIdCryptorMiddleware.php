<?php

namespace App\Http\Middleware;

use App\Helpers\Cryptor;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class UniversalIdCryptorMiddleware
{
    /**
     * Resource names that should have their IDs encrypted/decrypted.
     */
    protected $resources = [
        'layanan_unggulan',
        'layanan_spesialis',
        'layanan_fasilitas',
        'jadwal_dokter',
        'paket_kesehatan',
        'artikel_kesehatan',
        'event_community',
        'indikator_mutu',
        'karir',
        'konten_social_media',
        'sertifikasi_penghargaan',
        'master_kategori',
        'job',
    ];

    /**
     * Handle both incoming requests and outgoing responses.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Handle incoming request - decrypt IDs
        $this->decryptRequestIds($request);

        // Process the request
        $response = $next($request);

        // Handle outgoing response - encrypt IDs
        if ($response instanceof JsonResponse) {
            $this->encryptResponseIds($response);
        }

        return $response;
    }

    /**
     * Decrypt IDs in the request.
     */
    protected function decryptRequestIds(Request $request)
    {
        $cryptor = new Cryptor();
        $route = Route::getCurrentRoute();

        if (!$route) return;

        $parameters = $route->parameters();

        foreach ($this->resources as $resource) {
            // Convert resource name from snake_case to kebab-case for route param comparison
            // $resourceParam = str_replace('_', '-', $resource);
            $resourceParam = 'id';

            // For individual resource routes (show, update, delete)
            if (isset($parameters[$resourceParam])) {
                try {
                    $decryptedId = $cryptor->decrypt($parameters[$resourceParam]);
                    $route->setParameter($resourceParam, $decryptedId);
                } catch (\Exception $e) {
                    // If decryption fails, leave the parameter as is
                    // This handles cases where the ID might not be encrypted
                }
            }
        }
    }

    /**
     * Encrypt IDs in the response.
     */
    protected function encryptResponseIds(JsonResponse $response)
    {
        $cryptor = new Cryptor();
        $content = json_decode($response->getContent(), true);

        if (isset($content['success']) && $content['success'] === true && isset($content['data'])) {
            // Handle paginated data
            if (isset($content['data']['data']) && is_array($content['data']['data'])) {
                foreach ($content['data']['data'] as &$item) {
                    if (isset($item['id']) && $this->isIdValue($item['id'])) {
                        $item['id'] = $cryptor->encrypt($item['id']);
                    }
                }
            }
            // Handle array data
            elseif (is_array($content['data'])) {
                if (array_is_list($content['data'])) {
                    foreach ($content['data'] as &$item) {
                        if (isset($item['id']) && $this->isIdValue($item['id'])) {
                            $item['id'] = $cryptor->encrypt($item['id']);
                        }
                    }
                }
                // Handle single object data
                elseif (isset($content['data']['id']) && $this->isIdValue($content['data']['id'])) {
                    $content['data']['id'] = $cryptor->encrypt($content['data']['id']);
                }
            }

            $response->setContent(json_encode($content));
        }
    }

    /**
     * Memeriksa apakah suatu nilai adalah nilai ID yang valid untuk dienkripsi
     * 
     * @param mixed $value
     * @return bool
     */
    protected function isIdValue($value): bool
    {
        // ID harus bukan null, bukan array, dan nilai numerik
        if (is_null($value) || is_array($value)) {
            return false;
        }

        // Cek apakah nilai numerik (integer atau string numerik)
        if (is_int($value)) {
            return true;
        }

        // Jika string, cek apakah bisa dikonversi ke integer
        if (is_string($value) && is_numeric($value)) {
            return true;
        }

        return false;
    }
}
