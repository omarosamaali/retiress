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
            <h2><span><a href="{{ url('/') }}">الرئيسية</a> &raquo;</span>
                الرؤية والرسالة والأهداف </h2>
        </div>
        <div id="iconsblocks">
            <ul id="alliconsandtext">
                <li class="icon-right">
                    <span style="margin-top:-5px;">رؤيتنا</span>
                    <div class="icon-holder">
                        @if($vision)
                        <img src="{{ asset('storage/' . $vision->main_image) }}" alt="{{ $vision->title_ar }}">
                        @endif
                    </div>
                </li>

                <li class="text-left">
                    <div class="text-holder">
                        @if($vision)
                        <h3 class="main-titles">{{ $vision->title_ar }}</h3>
                        <p class="info vision container-info">
                            <span class="box"></span>
                            <span class="info vision">{{ $vision->description_ar }}</span>
                        </p>
                        @endif
                    </div>
                </li>

                <li class="-mt-9 icon-left">
                    <span>رسالتنا</span>
                    <div class="icon-holder">
                        @if($goals)
                        <img src="{{ asset('storage/' . $goals->main_image) }}" alt="{{ $goals->title_ar }}">
                        @endif
                    </div>
                </li>

                <li class="-mt-9 text-right">
                    <div class="text-holder">
                        @if($goals)
                        <h3 class="main-titles">{{ $goals->title_ar }}</h3>
                        <p class="info vision container-info">
                            <span class="box"></span>
                            <span class="info vision">{{ $goals->description_ar }}</span>
                        </p>
                        @endif
                    </div>
                </li>

                <li class="-mt-9 icon-right">
                    <span>أهدافنا</span>
                    <div class="icon-holder">
                        @if($company_message)
                        <img src="{{ asset('storage/' . $company_message->main_image) }}" class="goalsimg">
                        @endif
                    </div>
                </li>

                <li class="-mt-9 text-left">
                    <div class="text-holder">
                        @if($company_message)
                        <h3 class="main-titles">{{ $company_message->title_ar }}</h3>
                        <ul class="info goals">
                            <li>{{ $company_message->description_ar }}</li>
                        </ul>
                        @endif
                    </div>
                </li>

                <li class="-mt-9 icon-left">
                    <span>رسالتنا</span>
                    <div class="icon-holder">
                        @if($values)
                        <img src="{{ asset('storage/' . $values->main_image) }}" alt="{{ $values->title_ar }}">
                        @endif
                    </div>
                </li>

                <li class="-mt-9 text-right">
                    <div class="text-holder">
                        @if($values)
                        <h3 class="main-titles">{{ $values->title_ar }}</h3>
                        <ul class="info message">
                            <li>{{ $values->description_ar }}</li>
                        </ul>
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
    </div>
</body>

</html>
