<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

class Turnstile
{
    public static function verify(?string $token, ?string $ip = null): bool
    {
        $secret = (string) config('services.turnstile.secret');
        $verifyUrl = (string) config('services.turnstile.verify_url');

        // لو المفتاح مش متحدد → تخطَّ التحقق
        if ($secret === '') {
            return true;
        }

        if (empty($token)) {
            return false;
        }

        try {
            $response = Http::asForm()->timeout(10)->post($verifyUrl, [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $ip,
            ]);
        } catch (\Throwable) {
            return false;
        }

        if (! $response->ok()) {
            return false;
        }

        return (bool) $response->json('success', false);
    }
}
