<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>{{ __('app.vision_mission_goals_title') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/other-devices.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styleU.css') }}" />
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/amazingcarousel.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-1.css') }}">
    <script src="{{ asset('assets/js/initcarousel-1.js') }}"></script>
    <script src="{{ asset('assets/js/amazingslider.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-2.css') }}">
    <script src="{{ asset('assets/js/initslider-2.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset(path: 'assets/css/custom.css') }}">

    <style>
        .container-info {
            margin-right: 5px;
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 5px;
        }

        .box {
            height: 7px;
            width: 7px;
            background-color: white;
            border-radius: 0px;
        }

        .-mt-9 {
            margin-top: -9px;
        }
    </style>
</head>

<body>
    <x-guest-header></x-guest-header>
<div id="in-cont">
    <div class="inn-title" style="padding-top: 150px">
        <h2>
            <span><a href="{{ url('/') }}">{{ __('app.home_breadcrumb') }}</a> &raquo;</span>
            {{ __('app.vision_mission_goals_title') }}
        </h2>
    </div>
    <div id="iconsblocks">
        <ul id="alliconsandtext">
            {{-- This section seems to be for "Our Mission" based on the text "رسالتنا" --}}
            <li class="-mt-9 icon-left">
                <span>{{ __('app.our_mission') }}</span>
                <div class="icon-holder">
                    @if($goals) {{-- Assuming $goals contains the Mission data here --}}
                    <img src="{{ asset('storage/' . $goals->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? ($goals->title_ar ?? __('app.our_mission')) : ($goals->title_en ?? __('app.our_mission')) }}">
                    @else
                    {{-- Optional: Add a placeholder image or text if no mission image --}}
                    <p>{{ __('app.no_mission_available') }}</p>
                    @endif
                </div>
            </li>

            <li class="-mt-9 text-right">
                <div class="text-holder">
                    @if($goals) {{-- Assuming $goals contains the Mission data here --}}
                    <h3 class="main-titles">{{ app()->getLocale() == 'ar' ? $goals->title_ar : $goals->title_en }}</h3>
                    <p class="info vision container-info" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        <span class="box"></span>
                        <span class="info vision">{{ app()->getLocale() == 'ar' ? $goals->description_ar : $goals->description_en }}</span>
                    </p>
                    @else
                    <p>{{ __('app.no_mission_available') }}</p>
                    @endif
                </div>
            </li>

            {{-- This section also labeled "رسالتنا" (Our Mission), but uses a different variable $values.
                 It might represent 'Values' or a second mission statement.
                 I'll translate it as 'Our Mission' but you might want to adjust the key
                 if it truly represents 'Our Values' or another distinct concept. --}}
            <li class="-mt-9 icon-right">
                <span>{{ __('app.our_mission') }}</span> {{-- Consider changing this key if it's "Our Values" --}}
                <div class="icon-holder">
                    @if($values) {{-- Assuming $values contains the Values/Second Mission data here --}}
                    <img src="{{ asset('storage/' . $values->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? ($values->title_ar ?? __('app.our_mission')) : ($values->title_en ?? __('app.our_mission')) }}">
                    @else
                    {{-- Optional: Add a placeholder image or text if no values image --}}
                    <p>{{ __('app.no_values_available') }}</p>
                    @endif
                </div>
            </li>

            <li class="-mt-9 text-left">
                <div class="text-holder">
                    @if($values) {{-- Assuming $values contains the Values/Second Mission data here --}}
                    <h3 class="main-titles">{{ app()->getLocale() == 'ar' ? $values->title_ar : $values->title_en }}</h3>
                    <ul class="info message" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        <li>{{ app()->getLocale() == 'ar' ? $values->description_ar : $values->description_en }}</li>
                    </ul>
                    @else
                    <p>{{ __('app.no_values_available') }}</p>
                    @endif
                </div>
            </li>
        </ul>
    </div>
</div>

    </div>
    <x-footer-section></x-footer-section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
</body>

</html>
