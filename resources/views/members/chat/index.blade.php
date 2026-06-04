<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styleU.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    <x-guest-header></x-guest-header>

    <main class="site-chat-page">
        <div class="container" style="max-width: 1100px; margin: 130px auto 40px;">
            <h1 class="h4 mb-3 text-center" style="color: #016330;">{{ $pageTitle }}</h1>
            <p class="text-center text-muted small mb-4">{{ __('app.chat_member_hint') }}</p>

            <x-chat-interface
                :contacts="$contacts"
                :contacts-title="__('app.administration_team')"
                :empty-hint="__('app.select_admin_to_chat')"
            />
        </div>
    </main>

    <x-footer-section></x-footer-section>
</body>
</html>
