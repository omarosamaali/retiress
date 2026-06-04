<?php

// Example inside a controller action

$token = (string) $request->input('captcha_token', '');

if (! verify_turnstile_token($token, $request->ip())) {
    return response()->json([
        'success' => false,
        'message' => 'CAPTCHA verification failed. Please try again.',
        'errors' => [
            'captcha_token' => ['CAPTCHA verification failed.'],
        ],
    ], 400);
}

// Continue your endpoint logic...
