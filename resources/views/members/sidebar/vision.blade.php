<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>الرؤية والرسالة والأهداف</title>
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
            <li class="icon-right">
                <span style="margin-top:-5px;">{{ __('app.our_vision') }}</span>
                <div class="icon-holder">
                    @if($vision)
                    <img src="{{ asset('storage/' . $vision->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? ($vision->title_ar ?? __('app.our_vision')) : ($vision->title_en ?? __('app.our_vision')) }}">
                    @else
                    {{-- Optional: Add a placeholder image or text if no vision image --}}
                    <p>{{ __('app.no_vision_available') }}</p>
                    @endif
                </div>
            </li>

            <li class="text-left">
                <div class="text-holder">
                    @if($vision)
                    <h3 class="main-titles">{{ app()->getLocale() == 'ar' ? $vision->title_ar : $vision->title_en }}</h3>
                    <p class="info vision container-info" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        <span class="box"></span>
                        <span class="info vision">{{ app()->getLocale() == 'ar' ? $vision->description_ar : $vision->description_en }}</span>
                    </p>
                    @else
                    <p>{{ __('app.no_vision_available') }}</p>
                    @endif
                </div>
            </li>

            <li class="-mt-9 icon-left">
                <span>{{ __('app.our_goals') }}</span>
                <div class="icon-holder">
                    @if($company_message) {{-- Assuming $company_message holds goals --}}
                    <img src="{{ asset('storage/' . $company_message->main_image) }}" class="goalsimg" alt="{{ app()->getLocale() == 'ar' ? ($company_message->title_ar ?? __('app.our_goals')) : ($company_message->title_en ?? __('app.our_goals')) }}">
                    @else
                    {{-- Optional: Add a placeholder image or text if no goals image --}}
                    <p>{{ __('app.no_goals_available') }}</p>
                    @endif
                </div>
            </li>

            <li class="-mt-9 text-right">
                <div class="text-holder">
                    @if($company_message) {{-- Assuming $company_message holds goals --}}
                    <h3 class="main-titles">{{ app()->getLocale() == 'ar' ? $company_message->title_ar : $company_message->title_en }}</h3>
                    <ul class="info goals" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        <li>{{ app()->getLocale() == 'ar' ? $company_message->description_ar : $company_message->description_en }}</li>
                    </ul>
                    @else
                    <p>{{ __('app.no_goals_available') }}</p>
                    @endif
                </div>
            </li>

            {{-- Uncomment and translate this section if you want to include "Our Mission" --}}
            {{--
            <li class="-mt-9 icon-left">
                <span>{{ __('app.our_message') }}</span>
            <div class="icon-holder">
                @if($values) // Assuming $values holds mission details
                <img src="{{ asset('storage/' . $values->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? ($values->title_ar ?? __('app.our_message')) : ($values->title_en ?? __('app.our_message')) }}">
                @else
                <p>{{ __('app.no_message_available') }}</p>
                @endif
            </div>
            </li>

            <li class="-mt-9 text-right">
                <div class="text-holder">
                    @if($values) // Assuming $values holds mission details
                    <h3 class="main-titles">{{ app()->getLocale() == 'ar' ? $values->title_ar : $values->title_en }}</h3>
                    <ul class="info message" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        <li>{{ app()->getLocale() == 'ar' ? $values->description_ar : $values->description_en }}</li>
                    </ul>
                    @else
                    <p>{{ __('app.no_message_available') }}</p>
                    @endif
                </div>
            </li>
            --}}
        </ul>
    </div>
</div>

    </div>
    <x-footer-section></x-footer-section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
</body>

</html>
