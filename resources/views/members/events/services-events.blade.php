<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="images/fav.png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>خدماتنا</title>
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
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            margin-top: 8px;
        }

        .service-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,.08);
            transition: transform .2s, box-shadow .2s;
            position: relative;
            display: flex;
            flex-direction: column;
            direction: rtl;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(0,0,0,.13);
        }

        .service-card__img-wrap {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .service-card__img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .3s;
        }

        .service-card:hover .service-card__img-wrap img {
            transform: scale(1.04);
        }

        .service-card__badge-expired {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #64748b;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .service-card__body {
            padding: 18px 18px 14px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .service-card__title {
            font-size: 1rem;
            font-weight: 800;
            color: #1e293b;
            line-height: 1.5;
            margin: 0;
        }

        .service-card__title a {
            color: inherit;
            text-decoration: none;
        }

        .service-card__title a:hover {
            color: #b68a35;
        }

        .service-card__desc {
            font-size: .85rem;
            color: #475569;
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .service-card__footer {
            padding: 12px 18px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #f1f5f9;
            flex-wrap: wrap;
            gap: 8px;
        }

        .service-card__read-more {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #b68a35;
            color: #fff;
            border-radius: 8px;
            padding: 7px 16px;
            font-size: .82rem;
            font-weight: 700;
            text-decoration: none;
            transition: background .18s;
        }

        .service-card__read-more:hover {
            background: #8a6e2a;
            color: #fff;
            text-decoration: none;
        }

        .service-card__read-more--expired {
            background: #64748b;
        }

        .service-card__read-more--expired:hover {
            background: #475569;
        }

        .service-card--expired {
            opacity: .78;
        }

        .service-card--expired .service-card__img-wrap img {
            filter: grayscale(50%);
        }

        .section-divider {
            margin-top: 48px;
            border-top: 2px dashed #e2e8f0;
            padding-top: 28px;
        }

        .section-label {
            font-size: 1rem;
            font-weight: 700;
            color: #94a3b8;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            direction: rtl;
        }
    </style>
</head>

<body>
    <x-guest-header></x-guest-header>
    <div id="in-cont">
        <div class="inn-title" style="padding-top: 150px">
            <h2>
                <span><a href="{{ url('/') }}">الرئيسية</a> &raquo;</span>
                خدماتنا
            </h2>
        </div>

        <section class="py-hp3">
            <div class="container-rni">

                {{-- ── خدمات فعّالة ── --}}
                @if($activeServices->isNotEmpty())
                <div class="services-grid">
                    @foreach($activeServices as $event)
                    <div class="service-card">
                        <div class="service-card__img-wrap">
                            <a href="{{ route('events.show', $event) }}">
                                <img src="{{ asset('storage/' . $event->main_image) }}"
                                     alt="{{ app()->getLocale() == 'ar' ? ($event->title_ar ?? 'خدمة') : ($event->title_en ?? 'Service') }}">
                            </a>
                        </div>
                        <div class="service-card__body">
                            <h3 class="service-card__title">
                                <a href="{{ route('events.show', $event) }}">
                                    {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                                </a>
                            </h3>
                            @if($event->isForMembersOnly())
                                <span class="badge bg-info" style="align-self:flex-start;">{{ $event->audience_label }}</span>
                            @endif
                            <p class="service-card__desc">
                                {{ app()->getLocale() == 'ar' ? $event->description_ar : $event->description_en }}
                            </p>
                        </div>
                        <div class="service-card__footer">
                            @if($event->display_starts_at)
                            <span style="font-size:.78rem;color:#94a3b8;display:flex;align-items:center;gap:4px;">
                                <i class="fa-regular fa-calendar" style="color:#b68a35;"></i>
                                {{ $event->display_starts_at->translatedFormat('d F Y') }}
                            </span>
                            @endif
                            <a href="{{ route('events.show', $event) }}" class="service-card__read-more">
                                <i class="fa-solid fa-arrow-left"></i> اقرأ المزيد
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center w-100" style="padding:40px 0;">
                    <p style="color:#64748b;">لا توجد خدمات متاحة حالياً.</p>
                </div>
                @endif

                {{-- ── خدمات منتهية ── --}}
                @if($expiredServices->isNotEmpty())
                <div class="section-divider">
                    <p class="section-label">
                        <i class="fa-regular fa-calendar-xmark"></i> خدمات سابقة
                    </p>
                    <div class="services-grid">
                        @foreach($expiredServices as $event)
                        <div class="service-card service-card--expired">
                            <div class="service-card__img-wrap">
                                <a href="{{ route('events.show', $event) }}">
                                    <img src="{{ asset('storage/' . $event->main_image) }}"
                                         alt="{{ app()->getLocale() == 'ar' ? ($event->title_ar ?? '') : ($event->title_en ?? '') }}">
                                </a>
                                <span class="service-card__badge-expired">
                                    <i class="fa-solid fa-calendar-xmark"></i> منتهي
                                </span>
                            </div>
                            <div class="service-card__body">
                                <h3 class="service-card__title">
                                    <a href="{{ route('events.show', $event) }}" style="color:#64748b;">
                                        {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                                    </a>
                                </h3>
                                @if($event->display_ends_at)
                                <span style="font-size:.78rem;color:#94a3b8;display:inline-flex;align-items:center;gap:4px;">
                                    <i class="fa-regular fa-calendar-xmark"></i>
                                    انتهى {{ $event->display_ends_at->translatedFormat('d F Y') }}
                                </span>
                                @endif
                                <p class="service-card__desc" style="color:#94a3b8;">
                                    {{ app()->getLocale() == 'ar' ? $event->description_ar : $event->description_en }}
                                </p>
                            </div>
                            <div class="service-card__footer">
                                <a href="{{ route('events.show', $event) }}" class="service-card__read-more service-card__read-more--expired">
                                    <i class="fa-solid fa-arrow-left"></i> اقرأ المزيد
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
        </section>

        <x-footer-section></x-footer-section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
        <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    </div>

</body>

</html>
