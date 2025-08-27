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
    <style>
        html[lang="en"] .title--t5n,
        html[lang="en"] .title--t6n {
            text-align: left;
        }

        .title--t5n {
            font-size: 32px;
            margin-bottom: 0px;
            color: #b68a35;
        }

        .title--t6n {
            margin: 10px 0px;
            font-size: 20px;
            color: #6e4c3e;
            padding-top: 30px;
        }

        .ul-custom {
            list-style: none;
            padding: 0;
            margin-right: 23px;
        }

        .ul-custom li {
            position: relative;
            padding-right: 25px;
        }

        .ul-custom li::before {
            content: "■";
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%) rotate(130deg);
            color: #d4af37;
            font-size: 20px;
            font-weight: bold;
        }

        .container--grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
            margin-top: 20px;
        }

        .border-box {
            border: 2px solid #d4af37;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        p {
            line-height: 29px !important;
        }

    </style>
</head>
<body>
    <x-guest-header></x-guest-header>

    <div class="membership" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div style="margin-bottom: 20px;">
            @auth
            <a href="{{ route('members.membership-show') }}" id="reg" class="btn-qhr btn-primary-t6n">
                {{ __('app.register') }}
            </a>
            @else
            <a href="#" id="reg" class="btn-qhr btn-primary-t6n">{{ __('app.register') }}</a>
            @endauth
        </div>

        <div dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
            <h5 class="title--t5n">
                {{ app()->getLocale() == 'ar' ? $sections[0]->title_ar : $section[0]->title_en }}
            </h5>

            @php
            $text = app()->getLocale() == 'ar' ? $sections[0]->description_ar : $sections[0]->description_en;
            $lines = preg_split('/\r\n|\r|\n/', $text);
            @endphp

            @foreach($lines as $line)
            @if(preg_match('/^\s*\d+\s*[-–]\s*/u', $line))
            <h6 class="title--t6n">{{ preg_replace('/^\s*\d+\s*[-–]\s*/u', '', $line) }}</h6>
            @else
            <p>{{ $line }}</p>
            @endif
            @endforeach

            <ul class="ul-custom">
                <h5 class="title--t5n">
                    {{ app()->getLocale() == 'ar' ? $sections[1]->title_ar : $section[1]->title_en }}
                </h5>
                @php
                $text = app()->getLocale() == 'ar' ? $sections[1]->description_ar : $sections[1]->description_en;
                $lines = preg_split('/\r\n|\r|\n/', trim($text));
                @endphp

                <ul class="ul-custom">
                    @foreach($lines as $line)
                    @if(!empty(trim($line)))
                    <li>{{ $line }}</li>
                    @endif
                    @endforeach
                </ul>
            </ul>

            <h5 class="title--t5n">
                {{ app()->getLocale() == 'ar' ? $sections[2]->title_ar : $section[2]->title_en }}
            </h5>
            <p>{{ app()->getLocale() == 'ar' ? $sections[2]->description_ar : $section[2]->description_en }}</p>

            <div class="container--grid">
                <div class="border-box">
                    <h5 class="title--t6n" style="padding-top: 0px;">
                        {{ app()->getLocale() == 'ar' ? $sections[3]->title_ar : $section[3]->title_en }}</h5>
                    @php
                    $text = app()->getLocale() == 'ar' ? $sections[3]->description_ar : $sections[3]->description_en;
                    $lines = preg_split('/\r\n|\r|\n/', trim($text));
                    @endphp

                    <ul class="ul-custom">
                        @foreach($lines as $line)
                        @if(!empty(trim($line)))
                        <li>{{ $line }}</li>
                        @endif
                        @endforeach
                    </ul>
                </div>

                <div class="border-box">
                    <h5 class="title--t6n" style="padding-top: 0px;">
                        {{ app()->getLocale() == 'ar' ? $sections[4]->title_ar : $section[4]->title_en }}</h5>
                    @php
                    $text = app()->getLocale() == 'ar' ? $sections[4]->description_ar : $sections[4]->description_en;
                    $lines = preg_split('/\r\n|\r|\n/', trim($text));
                    @endphp

                    <ul class="ul-custom">
                        @foreach($lines as $line)
                        @if(!empty(trim($line)))
                        <li>{{ $line }}</li>
                        @endif
                        @endforeach
                    </ul>
                </div>

                <div class="border-box">
                    <h5 class="title--t6n" style="padding-top: 0px;">
                        {{ app()->getLocale() == 'ar' ? $sections[5]->title_ar : $section[5]->title_en }}</h5>
                    @php
                    $text = app()->getLocale() == 'ar' ? $sections[5]->description_ar : $sections[5]->description_en;
                    $lines = preg_split('/\r\n|\r|\n/', trim($text));
                    @endphp

                    <ul class="ul-custom">
                        @foreach($lines as $line)
                        @if(!empty(trim($line)))
                        <li>{{ $line }}</li>
                        @endif
                        @endforeach
                    </ul>
                </div>

                <div class="border-box">
                    <h5 class="title--t6n" style="padding-top: 0px;">
                        {{ app()->getLocale() == 'ar' ? $sections[6]->title_ar : $section[6]->title_en }}</h5>
                    @php
                    $text = app()->getLocale() == 'ar' ? $sections[6]->description_ar : $sections[6]->description_en;
                    $lines = preg_split('/\r\n|\r|\n/', trim($text));
                    @endphp

                    <ul class="ul-custom">
                        @foreach($lines as $line)
                        @if(!empty(trim($line)))
                        <li>{{ $line }}</li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <h5 class="title--t5n">{{ app()->getLocale() == 'ar' ? $sections[7]->title_ar : $section[7]->title_en }}</h5>
            @php
            $text = app()->getLocale() == 'ar' ? $sections[7]->description_ar : $sections[7]->description_en;
            $lines = preg_split('/\r\n|\r|\n/', trim($text));

            $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" style="margin-right: -3px; font-size: 38px; top: 7px; position: relative;" viewBox="0 0 24 24" fill="none">
                <path d="M8 7V17H12C14.8 17 17 14.8 17 12C17 9.2 14.8 7 12 7H8Z" stroke="#d4af37" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6.5 11H18.5" stroke="#d4af37" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6.5 13H12.5H18.5" stroke="#d4af37" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>';
            @endphp

            <ul class="ul-custom">
                @foreach($lines as $line)
                @if(!empty(trim($line)))
                <li>{!! str_replace('درهم', $icon, $line) !!} </li>
                @endif
                @endforeach
            </ul>

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
