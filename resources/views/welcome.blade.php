<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="images/fav.png" />
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#b68a35">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="المتقاعدين">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/new-logo.png') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>جمعية الإمارات للمتقاعدين</title>
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
    <link rel="icon" href="http://127.0.0.1:8000/assets/img/Group.png" type="image/x-icon">

    <style>
        .floating-clouds {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 1000;
            overflow: hidden;
        }

        .cloud {
            position: absolute;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(230, 230, 255, 0.2), rgba(255, 255, 255, 0.1));
            border-radius: 50px;
            opacity: 0.8;
            animation: float-cloud linear infinite;
            will-change: transform;
            filter: blur(1px);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }

        .cloud:before {
            content: '';
            position: absolute;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.4), rgba(240, 240, 255, 0.3), rgba(255, 255, 255, 0.2));
            border-radius: 60px;
            filter: blur(2px);
        }

        .cloud:after {
            content: '';
            position: absolute;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(250, 250, 255, 0.1), rgba(255, 255, 255, 0.3));
            border-radius: 40px;
            filter: blur(1.5px);
        }

        .cloud1 { width:120px; height:60px; top:10%; animation-duration:25s; animation-delay:0s; }
        .cloud1:before { width:80px; height:80px; top:-40px; left:20px; }
        .cloud1:after  { width:100px; height:60px; top:-25px; left:50px; }

        .cloud2 { width:90px; height:45px; top:25%; animation-duration:30s; animation-delay:-8s; }
        .cloud2:before { width:60px; height:60px; top:-30px; left:15px; }
        .cloud2:after  { width:75px; height:45px; top:-15px; left:35px; }

        .cloud3 { width:150px; height:75px; top:45%; animation-duration:35s; animation-delay:-15s; }
        .cloud3:before { width:100px; height:100px; top:-50px; left:25px; }
        .cloud3:after  { width:125px; height:75px; top:-30px; left:60px; }

        .cloud4 { width:110px; height:55px; top:65%; animation-duration:28s; animation-delay:-22s; }
        .cloud4:before { width:70px; height:70px; top:-35px; left:18px; }
        .cloud4:after  { width:90px; height:55px; top:-20px; left:45px; }

        .cloud5 { width:130px; height:65px; top:80%; animation-duration:32s; animation-delay:-30s; }
        .cloud5:before { width:85px; height:85px; top:-42px; left:22px; }
        .cloud5:after  { width:105px; height:65px; top:-25px; left:55px; }

        @keyframes float-cloud {
            0%   { transform: translateX(-200px) translateY(0px); opacity: 0; }
            10%  { opacity: 0.8; }
            90%  { opacity: 0.8; }
            100% { transform: translateX(calc(100vw + 200px)) translateY(-10px); opacity: 0; }
        }

        /* إخفاء السحب على الموبايل فقط */
        @media (max-width: 768px) {
            .floating-clouds { display: none !important; }
        }

        @media (min-width: 769px) {
            .swiper-slide {
                background: #cfa046c7 !important;
            }
        }

        @media (max-width: 768px) {
            .hero-banner-img {
                display: none !important;
            }
            #headerholdert {
                background: #fff;
            }
            .swiper-slide {
                background: none !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }
            .quoteSwiper {
                background: transparent !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
                box-shadow: none !important;
                border: none !important;
            }
            .quote-slide {
                background: transparent !important;
            }
            .quote-slide::before {
                display: none !important;
            }
            .quote-text blockquote {
                color: #b68a35 !important;
            }
            .quote-icon {
                color: rgba(182, 138, 53, 0.3) !important;
            }

            /* البانر وموضع السلايدر */
            #headerholdert {
                height: 260px !important;
                margin-top: 100px !important;
            }
            .quoteSwiper {
                top: 8px !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
                max-width: 90% !important;
                min-height: 150px !important;
                border-radius: 14px !important;
            }
            .quote-slide {
                min-height: 150px !important;
                padding: 16px 14px !important;
            }

            /* إخفاء الزر الطافي "مميزات العضوية" */
            a#reg[style*="position: fixed"],
            a#reg[style*="position:fixed"] {
                display: none !important;
            }
        }
    </style>
</head>

<body ng-app="myApp">

{{-- ── PWA Splash Screen ── --}}
<div id="pwa-splash">
    <img src="{{ asset('assets/evorq.jpeg') }}" alt="Evorq" id="pwa-splash__logo">
    <p id="pwa-splash__text">By Evorq Technology</p>
</div>
<style>
    #pwa-splash {
        position: fixed;
        inset: 0;
        z-index: 999999;
        background: #000;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 20px;
        transition: opacity .5s ease;
    }
    #pwa-splash.hidden {
        opacity: 0;
        pointer-events: none;
    }
    #pwa-splash__logo {
        width: 160px;
        height: auto;
        border-radius: 16px;
    }
    #pwa-splash__text {
        color: #fff;
        font-family: "Cairo", sans-serif;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 1px;
        margin: 0;
    }
</style>
<script>
    (function() {
        var splash = document.getElementById('pwa-splash');
        var isStandalone = window.matchMedia('(display-mode: standalone)').matches
                        || window.navigator.standalone === true;
        if (!isStandalone) {
            splash.style.display = 'none';
            return;
        }
        setTimeout(function() {
            splash.classList.add('hidden');
            setTimeout(function() { splash.style.display = 'none'; }, 500);
        }, 2000);
    })();
</script>

    <div class="floating-clouds">
        <div class="cloud cloud1"></div>
        <div class="cloud cloud2"></div>
        <div class="cloud cloud3"></div>
        <div class="cloud cloud4"></div>
        <div class="cloud cloud5"></div>
        <div class="cloud cloud1" style="animation-delay:-40s;"></div>
        <div class="cloud cloud2" style="animation-delay:-45s;"></div>
        <div class="cloud cloud3" style="animation-delay:-50s;"></div>
    </div>

    <div id="headerholdert"
        style="position: relative; width: 100%; height: 82vh; overflow: hidden; margin-top: 145px;">
        <img src="{{ Storage::url($banner?->image) }}" alt="Header Background"
            style="width: 100%; height: 100%; object-fit: fill;"
            class="hero-banner-img">
        <div class="swiper quoteSwiper">
            <div class="swiper-wrapper">
                @foreach (\App\Models\Slider::where('is_active', true)->get() as $slider)
                <div class="swiper-slide">
                    <div class="quote-slide">
                        <div class="quote-icon">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <div class="quote-text">
                            <blockquote>
                                {{ $slider->quote_ar }}
                            </blockquote>
                        </div>
                        <div class="quote-decoration"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <style>
            .quoteSwiper {
                position: absolute;
                top: 73%;
                left: 75%;
                transform: translate(-50%, -50%);
                width: 100%;
                max-width: 480px;
                height: auto;
                min-height: 250px;
                padding: 0;
                border-radius: 20px;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
                z-index: 10;
                overflow: hidden;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .quote-slide {
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 35px 30px;
                text-align: center;
                direction: rtl;
                min-height: 250px;
                overflow: hidden;
            }

            .quote-slide::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
                background-size: 30px 30px;
                animation: float 20s linear infinite;
                opacity: 0.3;
            }

            @keyframes float {
                0% {
                    transform: translate(-50%, -50%) rotate(0deg);
                }

                100% {
                    transform: translate(-50%, -50%) rotate(360deg);
                }
            }

            .quote-icon {
                position: absolute;
                top: 20px;
                right: 25px;
                font-size: 2.5rem;
                color: rgba(255, 255, 255, 0.2);
                z-index: 1;
            }

            .quote-text {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 2;
            }

            .quote-text blockquote {
                font-size: 18px;
                font-weight: 500;
                line-height: 1.7;
                color: #fff;
                margin: 0;
                padding: 0;
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
                position: relative;
                font-family: 'Cairo', 'Arial', sans-serif;
                letter-spacing: 0.5px;
            }

            .quote-decoration {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 3px;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
                border-radius: 2px;
            }

            .swiper-button-prev,
            .swiper-button-next {
                color: transparent !important;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                width: 45px !important;
                height: 45px !important;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }

            .swiper-button-prev:hover,
            .swiper-button-next:hover {
                background: rgba(255, 255, 255, 0.25);
                transform: scale(1.1);
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
            }

            .swiper-button-prev i,
            .swiper-button-next i {
                color: #fff;
                font-size: 16px;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            }

            .swiper-button-prev:after,
            .swiper-button-next:after {
                display: none;
            }

            .swiper-pagination {
                bottom: 15px !important;
            }

            .swiper-pagination-bullet {
                background: rgba(255, 255, 255, 0.4) !important;
                opacity: 1 !important;
                width: 10px !important;
                height: 10px !important;
                border-radius: 50% !important;
                transition: all 0.3s ease;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .swiper-pagination-bullet-active {
                background: #fff !important;
                transform: scale(1.3);
                box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .quoteSwiper {
                    max-width: 90%;
                    min-height: 200px;
                    left: 50%;
                    top: 70%;
                }

                .quote-slide {
                    padding: 25px 20px;
                    min-height: 200px;
                }

                .quote-icon {
                    font-size: 2rem;
                    top: 15px;
                    right: 20px;
                }

                .quote-text blockquote {
                    font-size: 16px;
                    line-height: 1.6;
                }

                .swiper-button-prev,
                .swiper-button-next {
                    width: 38px !important;
                    height: 38px !important;
                }

                .swiper-button-prev i,
                .swiper-button-next i {
                    font-size: 14px;
                }
            }

            @media (max-width: 480px) {
                .quoteSwiper {
                    max-width: 95%;
                    min-height: 180px;
                    top: 68%;
                }

                .quote-slide {
                    padding: 20px 15px;
                    min-height: 180px;
                }

                .quote-text blockquote {
                    font-size: 14px;
                    line-height: 1.5;
                }

                .quote-icon {
                    font-size: 1.8rem;
                    top: 12px;
                    right: 15px;
                }

                .swiper-button-prev,
                .swiper-button-next {
                    width: 35px !important;
                    height: 35px !important;
                }

                .swiper-pagination-bullet {
                    width: 8px !important;
                    height: 8px !important;
                }
            }

            .quote-slide::after {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                animation: shimmer 3s infinite;
            }

            @keyframes shimmer {
                0% {
                    left: -100%;
                }

                100% {
                    left: 100%;
                }
            }
        </style>
    </div>
    <x-guest-header></x-guest-header>

    @auth
    @php
        $__wpUser   = auth()->user();
        $__wpIsMem  = $__wpUser->isMemberRole();
        $__wpApp    = $__wpIsMem ? $__wpUser->memberApplication : null;
        $__wpCard   = $__wpApp?->toMembershipCardPayload() ?? [];
        $__wpName   = \Illuminate\Support\Str::limit($__wpUser->name, 22, '…');
        $__wpSt     = $__wpCard['status']['label'] ?? ($__wpApp ? 'عضو' : 'مستخدم');
        $__wpStKey  = $__wpCard['status']['key']   ?? 'pending';
        $__wpExp    = !empty($__wpApp?->expiration_date)
                        ? \Carbon\Carbon::parse($__wpApp->expiration_date)->format('Y/m/d')
                        : null;
        $__wpHasCard = $__wpIsMem && $__wpUser->hasActiveMembership();

        // إحصائيات الإعلانات
        $__wpTx = \App\Models\Transaction::where('user_id', $__wpUser->id)
                    ->whereNotNull('event_id')->get();
        $__wpSubscribed = $__wpTx->whereIn('status', ['active'])->count();
        $__wpPending    = $__wpTx->whereIn('status', ['pending','waiting_for_payment','waiting_for_activation'])->count();
        $__wpExpiredTx  = $__wpTx->whereIn('status', ['expired','deactivated'])->count();
        $__wpRejected   = $__wpTx->where('status', 'rejected')->count();
        $__wpSubIds     = $__wpTx->pluck('event_id')->filter()->unique();
        $__wpAvailable  = \App\Models\Event::published()->visibleToAudience($__wpUser)
                            ->where(function ($q) {
                                $q->where('ends_at', '>=', now())
                                  ->orWhere(function ($s) {
                                      $s->whereNull('ends_at')->where('starts_at', '>=', now());
                                  });
                            })
                            ->whereNotIn('id', $__wpSubIds)->count();
        $__wpMissed     = \App\Models\Event::published()->visibleToAudience($__wpUser)
                            ->where('ends_at', '<', now())->whereNotIn('id', $__wpSubIds)->count();
    @endphp
    <div id="mob-member-card">
        <div class="mmc-top">
            <div class="mmc-avatar"><i class="fa-solid fa-circle-user"></i></div>
            <div class="mmc-info">
                <div class="mmc-name">{{ $__wpName }}</div>
                <div class="mmc-status mmc-status--{{ $__wpStKey }}">{{ $__wpSt }}</div>
                @if($__wpExp)
                <div class="mmc-exp"><i class="fa-solid fa-calendar-days" style="margin-left:4px;"></i>ينتهي: {{ $__wpExp }}</div>
                @endif
            </div>
        </div>
        <div class="mmc-btns">
            <button type="button" id="openMembershipCardHome" class="mmc-btn mmc-btn--card">
                <i class="fa-solid fa-id-card"></i> بطاقتي
            </button>
            <a href="{{ route('members.panel') }}" class="mmc-btn mmc-btn--panel">
                <i class="fa-solid fa-table-cells-large"></i> لوحة التحكم
            </a>
        </div>
    </div>

    {{-- إحصائيات الموبايل --}}
    <div id="mob-stats">
        <a href="{{ route('members.panel') }}#section-subscribed" class="mst-chip" style="--c:#16a34a;">
            <span class="mst-num">{{ $__wpSubscribed }}</span>
            <span class="mst-lbl">مشترك فيها</span>
        </a>
        <a href="{{ route('members.panel') }}#section-available" class="mst-chip" style="--c:#1a73e8;">
            <span class="mst-num">{{ $__wpAvailable }}</span>
            <span class="mst-lbl">متاحة للاشتراك</span>
        </a>
        <a href="{{ route('members.panel') }}#section-missed" class="mst-chip" style="--c:#c2410c;">
            <span class="mst-num">{{ $__wpMissed }}</span>
            <span class="mst-lbl">فاتتني</span>
        </a>
        <a href="{{ route('members.panel') }}#section-pending" class="mst-chip" style="--c:#b45309;">
            <span class="mst-num">{{ $__wpPending }}</span>
            <span class="mst-lbl">قيد الانتظار</span>
        </a>
        <a href="{{ route('members.panel') }}#section-expired" class="mst-chip" style="--c:#475569;">
            <span class="mst-num">{{ $__wpExpiredTx }}</span>
            <span class="mst-lbl">منتهية</span>
        </a>
        <a href="{{ route('members.panel') }}#section-rejected" class="mst-chip" style="--c:#b91c1c;">
            <span class="mst-num">{{ $__wpRejected }}</span>
            <span class="mst-lbl">مرفوضة</span>
        </a>
    </div>

    <style>
    @media (min-width: 769px) { #mob-member-card, #mob-stats { display: none !important; } }
    @media (max-width: 768px) {
        #mob-member-card {
            margin: 14px 12px 0;
            background: linear-gradient(135deg, #8a6520 0%, #b68a35 50%, #8a6520 100%);
            border-radius: 16px;
            padding: 16px;
            direction: rtl;
            box-shadow: 0 4px 20px rgba(182,138,53,.4);
            border: 1px solid rgba(255,255,255,.25);
            position: relative;
            overflow: hidden;
        }
        #mob-member-card::before {
            content: '';
            position: absolute;
            top: -30px; left: -30px;
            width: 120px; height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,.07);
        }
        #mob-member-card::after {
            content: '';
            position: absolute;
            bottom: -20px; right: -20px;
            width: 90px; height: 90px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
        }
        .mmc-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }
        .mmc-avatar {
            font-size: 3rem;
            color: rgba(255,255,255,.9);
            line-height: 1;
            flex-shrink: 0;
        }
        .mmc-info { flex: 1; }
        .mmc-name {
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 0 1px 3px rgba(0,0,0,.3);
        }
        .mmc-status {
            display: inline-block;
            font-size: .72rem;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 20px;
            margin-bottom: 4px;
        }
        .mmc-status--active    { background:rgba(255,255,255,.25); color:#fff; border:1px solid rgba(255,255,255,.4); }
        .mmc-status--expiring  { background:rgba(220,100,0,.35);   color:#ffe; border:1px solid rgba(255,160,0,.5); }
        .mmc-status--expired   { background:rgba(180,0,0,.35);     color:#fcc; border:1px solid rgba(220,0,0,.5); }
        .mmc-status--pending   { background:rgba(255,255,255,.15); color:#fff; border:1px solid rgba(255,255,255,.3); }
        .mmc-exp {
            font-size: .72rem;
            color: rgba(255,255,255,.8);
            margin-top: 2px;
        }
        .mmc-btns {
            display: flex;
            gap: 10px;
            position: relative;
            z-index: 1;
        }
        .mmc-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 8px;
            border-radius: 10px;
            font-size: .82rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
            transition: opacity .15s;
        }
        .mmc-btn:active { opacity: .75; }
        .mmc-btn--card  {
            background: #fff;
            color: #8a6520;
            border: none;
        }
        .mmc-btn--panel {
            background: rgba(255,255,255,.15);
            color: #fff;
            border: 1.5px solid rgba(255,255,255,.5);
        }

        /* إحصائيات */
        #mob-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin: 10px 12px 0;
            direction: rtl;
        }
        .mst-chip {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            background: #fff;
            border-radius: 12px;
            padding: 10px 6px;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
            border: 2px solid color-mix(in srgb, var(--c) 20%, transparent);
            transition: transform .12s;
        }
        .mst-chip:active { transform: scale(.96); }
        .mst-num {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--c);
            line-height: 1;
        }
        .mst-lbl {
            font-size: .62rem;
            font-weight: 600;
            color: #64748b;
            text-align: center;
            line-height: 1.2;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
        var btn = document.getElementById('openMembershipCardHome');
        if(!btn) return;
        btn.addEventListener('click', function(){
            // جرّب الزر الأصلي في الهيدر أولاً
            var orig = document.getElementById('openMembershipCard');
            if(orig) { orig.click(); return; }
            // أو افتح الـ sheet مباشرة
            var sheet = document.getElementById('membershipCardSheet');
            if(sheet) {
                sheet.removeAttribute('hidden');
                sheet.setAttribute('aria-hidden','false');
            }
        });
    });
    </script>
    @endauth

    <style>
    @media (max-width: 768px) {
        /* ── إخفاء الأخبار بعد الأول ── */
        .list-l88.list-vja .list-2nx:not(:first-child) {
            display: none !important;
        }
        /* ── تحسين كارد الخبر الأول موبايل ── */
        .list-l88.list-vja {
            display: block !important;
            margin: 0 12px !important;
        }
        .list-l88.list-vja .list-2nx:first-child {
            display: block !important;
            width: 100% !important;
            height: 220px !important;
            border-radius: 14px !important;
            overflow: hidden;
        }
        /* ── تصغير عنوان الأخبار موبايل ── */
        #latest-news h3 {
            font-size: 1.3rem !important;
        }
        #latest-news {
            margin-top: 24px !important;
            padding: 0 12px;
        }
    }
    </style>
    <a href="{{ route('magazines.feature') }}" id="reg" style="margin-left: auto;
    margin-right: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 90%;
    max-width: 1200px;
    margin-top: 20px;
    font-size: 23px;
    height: 56px;
    font-weight: bold;" class="btn-qhr btn-primary-t6n">
    <i class="fas fa-star" style="margin-left: 8px;"></i>
        {{ __('app.مميزات العضوية') }}
    </a>
    <div id="latest-news"
        style="margin-bottom: 16px !important; margin-top: 100px !important; display: flex; align-items: center; max-width: 1200px; width: 100%; margin: auto; justify-content: space-between;">
        <h3 style="text-align: center; font-size: 36px;">{{ __('app.latest_news') }}</h3>
        <div class="c-morebtn">
            <a href="{{ route("news.all-news") }}" class="main-btn" style="background-color: black;">{{
                __('app.more_news') }}</a>
        </div>
    </div>
    <div style="max-width: 1200px; margin: auto;" class="list-l88 list-vja">
        @foreach($news as $singleNews)
        <a href="{{ url('/news/show/' . $singleNews->id) }}" style="border-radius: 13px !important;" class="list-2nx">
            <span class="image-dvm">
                <img width="688" height="1024" src="{{ Storage::url($singleNews->main_image) }}"
                    alt="{{ app()->getLocale() == 'ar' ? $singleNews->title_ar : $singleNews->title_en }}">
            </span>
            <span class="list-o16 hqqhi">
                <span class="list-m72">{{ \Carbon\Carbon::parse($singleNews->created_at)->day }}</span>
                <span>{{ \Carbon\Carbon::parse($singleNews->created_at)->translatedFormat('F') }}</span>
            </span>
            <span class="list-zkk">
                <span class="title-n5f qhngb">
                    {{ app()->getLocale() == 'ar' ? $singleNews->title_ar : $singleNews->title_en }}
                </span>
                <span class="list-mzq">
                    <p>{{ \Illuminate\Support\Str::limit(app()->getLocale() == 'ar' ? $singleNews->description_ar :
                        $singleNews->description_en, 200) }}</p>
                </span>
            </span>
        </a>
        @endforeach
    </div>
    <a href="{{ route('magazines.feature') }}" id="reg" style="width: fit-content;
    position: fixed;
    z-index: 99999;
    bottom: 20px;
    right: 20px;
    font-size: 15px;
    width: 100px;
    height: 100px;
    border-radius: 50px;
    background: green;" class="btn-qhr btn-primary-t6n">
                مميزات
</br>
                العضوية
            </a>
    <section style="background: #fff; margin-top: 100px;">
        <div class="container-e3z">
            <div class="row-sy7">
                <div class="col-w5q">
                    <h1 class="font-weight-5zk" style="margin-top: 25px; color: #1e293b !important;">{{ __('app.latest_events') }}</h1>
                    <p style="color: #64748b !important;">{{ __('app.events_description') }}</p>
                </div>
                <div class="col-bpd">
                    @if ($events->isEmpty())
                        <div style="display:flex;align-items:center;justify-content:center;min-height:200px;flex-direction:column;gap:16px;color:#64748b;padding:30px 0;">
                            <i class="fa-regular fa-calendar-xmark" style="font-size:2.5rem;"></i>
                            <span style="font-size:1rem;font-weight:600;">لا تتوفر إعلانات فعّالة حالياً</span>
                            <a href="{{ route('events.all-events') }}"
                               style="display:inline-flex;align-items:center;gap:7px;background:#b68a35;color:#fff;border:1.5px solid #b68a35;border-radius:24px;padding:8px 22px;font-size:.88rem;font-weight:700;text-decoration:none;transition:background .2s;">
                                <i class="fa-solid fa-list"></i> عرض الجميع
                            </a>
                        </div>
                    @elseif ($events->count() === 1)
                    @php $event = $events->first(); @endphp
                    <a href="{{ url('/events/show/' . $event->id) }}" class="slide-content" style="text-decoration:none;display:block;">
                        <x-event-type-badge :event="$event" />
                        <img src="{{ asset('storage/' . $event->main_image) }}"
                            alt="{{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}"
                            class="slide-image">
                        <div class="slide-title">
                            {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                        </div>
                        <p style="padding-top: 20px; padding-right: 20px; margin-bottom: 15px;">{{
                            __('app.date') }} : {{
                            \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</p>
                    </a>
                    @else
                    <div class="swiper eventsSwiper">
                        <div class="swiper-wrapper">
                            @foreach ($events as $event)
                            <div class="swiper-slide">
                                <a href="{{ url('/events/show/' . $event->id) }}" class="slide-content">
                                    <x-event-type-badge :event="$event" />
                                    <img src="{{ asset('storage/' . $event->main_image) }}"
                                        alt="{{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}"
                                        class="slide-image">
                                    <div class="slide-title">
                                        {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                                    </div>
                                    <p style="padding-top: 20px; padding-right: 20px; margin-bottom: 15px;">{{
                                        __('app.date') }} : {{
                                        \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="swiper-button-prev">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    <a href="{{ route('events.all-events') }}" class="btn-dwo block-qlo"
                        style="display: block; text-align: center; margin-top: 30px;">
                        <i class="fas fa-eye"></i>
                        <span>{{ __('app.view_more') }}</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <x-events-section :services="$services" :service-events="$serviceEvents"></x-events-section>
    <x-latest-section :magazines="$magazines"></x-latest-section>
    <x-footer-section></x-footer-section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
</body>
<script>
    var quoteSwiper = new Swiper('.quoteSwiper', {
        slidesPerView: 1
        , spaceBetween: 20
        , loop: true
        , autoplay: {
            delay: 5000
            , disableOnInteraction: false
        , }
        , pagination: {
            el: '.swiper-pagination'
            , clickable: true
        , }
        , navigation: {
            nextEl: '.swiper-button-next'
            , prevEl: '.swiper-button-prev'
        , }
    , });

</script>


</html>