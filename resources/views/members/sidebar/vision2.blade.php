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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">

    <style>
        .vision-mission-container {
            background: linear-gradient(135deg, #2c5530 0%, #1a4d2e 100%);
            padding: 80px 0;
            min-height: 100vh;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 60px;
            padding-top: 40px;
        }

        .page-title {
            color: #fff;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .breadcrumb {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            margin-bottom: 0;
        }

        .breadcrumb a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: #ffd700;
        }

        .vision-mission-grid {
            display: grid;
            gap: 40px;
            margin-bottom: 60px;
        }

        .section-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .section-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .goals-card {
            display: grid;
            grid-template-columns: 1fr 300px;
            align-items: center;
            min-height: 350px;
        }

        .values-card {
            display: grid;
            grid-template-columns: 300px 1fr;
            align-items: center;
            min-height: 350px;
        }

        .card-content {
            padding: 40px;
        }

        .card-image {
            height: 350px;
            position: relative;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .section-card:hover .card-image img {
            transform: scale(1.1);
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #2c5530, #1a4d2e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
            margin: 0;
        }

        .icon-overlay {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.9);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #2c5530;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .values-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .values-list li {
            position: relative;
            padding: 12px 0 12px 30px;
            font-size: 1.1rem;
            line-height: 1.7;
            color: #555;
        }

        .values-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 12px;
            color: #2c5530;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .no-data-message {
            text-align: center;
            padding: 60px 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            border: 2px dashed rgba(255, 255, 255, 0.3);
        }

        .no-data-message i {
            font-size: 3rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 20px;
        }

        .no-data-message p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.2rem;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.2rem;
            }

            .goals-card,
            .values-card {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .card-image {
                height: 250px;
            }

            .card-content {
                padding: 30px 20px;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .section-description,
            .values-list li {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .vision-mission-container {
                padding: 40px 0;
            }

            .content-wrapper {
                padding: 0 15px;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .card-content {
                padding: 25px 15px;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }

    </style>
</head>

<body>
    <x-guest-header></x-guest-header>

    <div class="vision-mission-container">
        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">{{ __('app.vision_mission_goals_title') }}</h1>
                <p class="breadcrumb">
                    <a href="{{ url('/') }}">{{ __('app.home_breadcrumb') }}</a>
                    <i class="fas fa-chevron-left mx-2"></i>
                    {{ __('app.vision_mission_goals_title') }}
                </p>
            </div>

            <div class="vision-mission-grid">
                <!-- Goals Section (First Mission) -->
                @if($goals)
                <div class="section-card goals-card">
                    <div class="card-content">
                        <h2 class="section-title">{{ app()->getLocale() == 'ar' ? $goals->title_ar : $goals->title_en }}</h2>
                        <p class="section-description" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                            {{ app()->getLocale() == 'ar' ? $goals->description_ar : $goals->description_en }}
                        </p>
                    </div>
                    <div class="card-image">
                        <img src="{{ asset('storage/' . $goals->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? ($goals->title_ar ?? __('app.our_mission')) : ($goals->title_en ?? __('app.our_mission')) }}">
                        <div class="icon-overlay">
                            <i class="fas fa-bullseye"></i>
                        </div>
                    </div>
                </div>
                @else
                <div class="no-data-message">
                    <i class="fas fa-bullseye"></i>
                    <p>{{ __('app.no_mission_available') }}</p>
                </div>
                @endif

                <!-- Values Section (Second Mission) -->
                @if($values)
                <div class="section-card values-card">
                    <div class="card-image">
                        <img src="{{ asset('storage/' . $values->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? ($values->title_ar ?? __('app.our_mission')) : ($values->title_en ?? __('app.our_mission')) }}">
                        <div class="icon-overlay">
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="section-title">{{ app()->getLocale() == 'ar' ? $values->title_ar : $values->title_en }}</h2>
                        <div dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                            @php
                            $description = app()->getLocale() == 'ar' ? $values->description_ar : $values->description_en;
                            $valuesList = explode("\n", $description);
                            @endphp
                            <ul class="values-list">
                                @foreach($valuesList as $value)
                                @if(trim($value))
                                <li>{{ trim($value) }}</li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @else
                <div class="no-data-message">
                    <i class="fas fa-heart"></i>
                    <p>{{ __('app.no_values_available') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <x-footer-section></x-footer-section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
</body>

</html>
