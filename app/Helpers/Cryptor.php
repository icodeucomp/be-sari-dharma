<?php

namespace App\Helpers;

class Cryptor
{
    private const METHOD = 'AES-256-CBC';

    private function keyAndIv(): array
    {
        $secretKey = (string) config('services.cryptor.key');
        $secretIv = (string) config('services.cryptor.iv');

        return [
            hash('sha256', $secretKey),
            substr(hash('sha256', $secretIv), 0, 16),
        ];
    }

    public function encrypt(string|int $id): bool|string
    {
        [$key, $iv] = $this->keyAndIv();

        $output = openssl_encrypt((string) $id, self::METHOD, $key, 0, $iv);

        return $output === false ? false : base64_encode($output);
    }

    public function decrypt($encrypted): bool|string
    {
        if (! is_string($encrypted) || $encrypted === '') {
            return false;
        }

        $decoded = base64_decode($encrypted, true);
        if ($decoded === false) {
            return false;
        }

        [$key, $iv] = $this->keyAndIv();

        $output = openssl_decrypt($decoded, self::METHOD, $key, 0, $iv);
        if ($output === false) {
            return false;
        }

        if (str_contains($output, '::')) {
            $output = explode('::', $output)[0];
        }

        return $output;
    }

    public function decryptId($encrypted): ?int
    {
        $plain = $this->decrypt($encrypted);

        if ($plain === false || ! ctype_digit($plain) || (int) $plain < 1) {
            return null;
        }

        return (int) $plain;
    }
}
