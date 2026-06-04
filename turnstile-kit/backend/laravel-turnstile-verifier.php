<?php

use Illuminate\Support\Facades\Http;

if (! function_exists('verify_turnstile_token')) {
    function verify_turnstile_token(string $token, ?string $ip = null): bool
    {
        $secret = (string) env('TURNSTILE_SECRET_KEY', '');
        $verifyUrl = (string) env('TURNSTILE_VERIFY_URL', 'https://challenges.cloudflare.com/turnstile/v0/siteverify');

        if ($secret === '' || $token === '') {
            return false;
        }

        try {
            $response = Http::asForm()->timeout(10)->post($verifyUrl, [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $ip,
            ]);
        } catch (\Throwable $th) {
            return false;
        }

        if (! $response->ok()) {
            return false;
        }

        return (bool) $response->json('success', false);
    }
}
