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
                    // Proses data secara rekursif untuk mengenkripsi semua ID
                    $content['data'] = $this->processArrayRecursively($content['data'], $cryptor);
                    $response->setContent(json_encode($content));
                }
            }
        }

        return $response;
    }

    /**
     * Memproses array/objek secara rekursif untuk mengenkripsi semua field *_id
     *
     * @param mixed $data
     * @param Cryptor $cryptor
     * @return mixed
     */
    protected function processArrayRecursively($data, Cryptor $cryptor)
    {
        // Jika bukan array, kembalikan langsung
        if (!is_array($data)) {
            return $data;
        }

        $result = [];

        // Untuk setiap elemen dalam array
        foreach ($data as $key => $value) {
            // Jika key mengandung _id di akhir dan nilai numerik
            if (is_string($key) && str_ends_with($key, '_id') && $this->isIdValue($value)) {
                // Enkripsi nilai
                $result[$key] = $cryptor->encrypt($value);
            }
            // Khusus untuk key id di level teratas dan nilai numerik
            elseif ($key === 'id' && $this->isIdValue($value)) {
                $result[$key] = $cryptor->encrypt($value);
            }
            // Jika nilai adalah array, proses rekursif
            elseif (is_array($value)) {
                $result[$key] = $this->processArrayRecursively($value, $cryptor);
            }
            // Untuk field lainnya, simpan nilai asli
            else {
                $result[$key] = $value;
            }
        }

        return $result;
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
