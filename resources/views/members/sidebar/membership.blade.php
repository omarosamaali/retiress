<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>{{ __('app.membership_description_title_fallback') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/other-devices.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styleU.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    <x-guest-header></x-guest-header>

<div class="membership" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div>
        @auth
        <a href="{{ route('members.membership-show') }}" id="reg" class="btn-qhr btn-primary-t6n">
            {{ __('app.register') }}
        </a>
        @else
        <a href="#" id="reg" class="btn-qhr btn-primary-t6n">{{ __('app.register') }}</a>
        @endauth
    </div>
    <div>
        @forelse ($sections as $section)
        <div>
            @if ($section->section == 'membership_description')
            <div class="container-membership">
                <div>
                    <h5 class="member-title">
                        {{ app()->getLocale() == 'ar' ? ($section->title_ar ?? __('app.membership_description_title_fallback')) : ($section->title_en ?? __('app.membership_description_title_fallback')) }}
                    </h5>
                    <p>
                        {{ app()->getLocale() == 'ar' ? ($section->description_ar ?? __('app.membership_description_fallback')) : ($section->description_en ?? __('app.membership_description_fallback')) }}
                    </p>
                </div>
                <div class="img-container">
                    <img src="{{ asset('assets/images/new-logo.png') }}" alt="{{ __('app.membership_logo_alt') }}">
                </div>
            </div>
            @elseif ($section->section == 'value')
            <h5 class="member-title">
                {{ app()->getLocale() == 'ar' ? ($section->title_ar ?? __('app.value_title_fallback')) : ($section->title_en ?? __('app.value_title_fallback')) }}
            </h5>
            <p>
                {{ app()->getLocale() == 'ar' ? ($section->description_ar ?? __('app.membership_description_fallback')) : ($section->description_en ?? __('app.membership_description_fallback')) }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="margin-right: 3px;" viewBox="0 0 24 24" fill="none">
                    <path d="M8 7V17H12C14.8 17 17 14.8 17 12C17 9.2 14.8 7 12 7H8Z" stroke="#000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M6.5 11H18.5" stroke="#000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M6.5 13H12.5H18.5" stroke="#000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </p>
            @else
            {{-- Default case for other sections --}}
            <h5 class="member-title">
                {{ app()->getLocale() == 'ar' ? ($section->title_ar ?? ($sectionTypes[$section->section] ?? $section->section)) : ($section->title_en ?? ($sectionTypes[$section->section] ?? $section->section)) }}
            </h5>
            <p>
                {{ app()->getLocale() == 'ar' ? ($section->description_ar ?? __('app.membership_description_fallback')) : ($section->description_en ?? __('app.membership_description_fallback')) }}
            </p>
            @endif
        </div>
        @empty
        <div class="text-center py-4">
            <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2">{{ __('app.no_sections_data') }}</p>
        </div>
        @endforelse
    </div>
</div>

    <x-footer-section></x-footer-section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/amazingcarousel.js') }}"></script>
    <script src="{{ asset('assets/js/initcarousel-1.js') }}"></script>
    <script src="{{ asset('assets/js/amazingslider.js') }}"></script>
    <script src="{{ asset('assets/js/initslider-2.js') }}"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const regLink = document.getElementById('reg');
            regLink.addEventListener('click', function(e) {
                @guest
                e.preventDefault();
                Swal.fire({
                    title: 'غير مسجل الدخول'
                    , text: 'يرجى تسجيل الدخول للوصول إلى هذه الصفحة'
                    , icon: 'warning'
                    , confirmButtonText: 'تسجيل الدخول'
                    , showCancelButton: true
                    , cancelButtonText: 'إلغاء'
                    , confirmButtonColor: '#b28b46'
                    , cancelButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('members.login') }}";
                    }
                });
                @endguest
            });
        });

    </script>
</body>
</html>
