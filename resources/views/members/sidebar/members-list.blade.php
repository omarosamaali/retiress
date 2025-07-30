<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>{{ __('app.board_members_page_title') }}</title>
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
        .board-member-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .board-member-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 30px;
            margin-bottom: 15px;
            border: 3px solid #eee;
        }

        .board-member-card h2 {
            font-size: 1.5rem;
            margin-bottom: 5px;
            color: #333;
        }

        .board-member-card h3 {
            font-size: 1.1rem;
            color: #666;
        }

        .board-members-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .board-members-grid>div {
            flex: 0 0 calc(50% - 30px);
            max-width: calc(50% - 30px);
        }

        @media (max-width: 768px) {
            .board-members-grid>div {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .board-member-card {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 25px;
            max-width: 500px;
            width: 100%;
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* تحريك الخطوط */
        @keyframes moveLines {
            0% {
                transform: translateX(-60px) translateY(-60px);
            }

            100% {
                transform: translateX(0px) translateY(0px);
            }
        }

        .board-member-card img {
            width: 150px;
            height: 150px;
            border-radius: 15px;
            object-fit: cover;
            border: 4px solid rgba(102, 126, 234, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
            transition: transform 0.3s ease;
        }

        .board-member-card:hover img {
            transform: scale(1.05);
        }

        .board-member-card>div {
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .board-member-card h2 {
            margin: 0 0 10px 0;
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .board-member-card h3 {
            margin: 0;
            font-size: 18px;
            color: #0e6939;
            font-weight: 500;
            opacity: 0.8;
        }

        /* خطوط زينة جانبية */
        .decorative-lines {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            z-index: 2;
        }

        .decorative-lines::before,
        .decorative-lines::after {
            content: '';
            position: absolute;
            background: linear-gradient(45deg, #0e6939, #0e6939);
            border-radius: 2px;
        }

        .decorative-lines::before {
            width: 30px;
            height: 3px;
            top: 10px;
            right: 0;
            opacity: 0.6;
        }

        .decorative-lines::after {
            width: 20px;
            height: 3px;
            top: 20px;
            right: 10px;
            opacity: 0.4;
        }

    </style>
</head>

<body>
    <x-guest-header></x-guest-header>
<div id="in-cont">
    <div class="inn-title" style="padding-top: 150px">
        <h2>
            <span><a href="{{ url('/') }}">{{ __('app.home_breadcrumb') }}</a> &raquo;</span>
            {{ __('app.board_members_page_title') }}
        </h2>
    </div>
    <div style="padding-top: 50px; padding-bottom: 50px;">
        <h3 style="text-align: center; margin-bottom: 10px;">{{ __('app.board_members_page_title') }}</h3>
        <div class="container-i1t">
            <div class="board-members-grid">
                @forelse($members as $member)
                <div class="board-member-card">
                    {{-- Display alt text based on current locale --}}
                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ app()->getLocale() == 'ar' ? ($member->name_ar ?? 'عضو مجلس إدارة') : ($member->name_en ?? 'Board Member') }}">
                    <div>
                        {{-- Display name based on current locale --}}
                        <h2>{{ app()->getLocale() == 'ar' ? $member->name_ar : $member->name_en }}</h2>
                        {{-- Display position based on current locale --}}
                        <h3>{{ app()->getLocale() == 'ar' ? $member->position_ar : $member->position_en }}</h3>
                    </div>
                </div>
                @empty
                <div style="text-align: center; width: 100%;">
                    {{-- Display message if no board members are available --}}
                    <p>{{ __('app.no_board_members_available') }}</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>

    <x-footer-section></x-footer-section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    </div>
</body>

</html>
