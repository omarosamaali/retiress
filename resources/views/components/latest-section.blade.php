@props(['magazines']) <style>
    @media (max-width: 500px) {
        .all-version { flex-direction: column; }
        .container-sls { width: 100% !important; }
    }
    @media (max-width: 768px) {
        .latest-section-wrap {
            margin-top: 28px !important;
            padding: 20px 12px !important;
        }
        .latest-section-wrap .row-sy7 {
            flex-direction: column !important;
        }
        .latest-section-wrap .col-w5q,
        .latest-section-wrap .col-bpd {
            max-width: 100% !important;
            flex: 0 0 100% !important;
            padding: 0 !important;
        }
        .latest-section-wrap .col-w5q h1 {
            font-size: 1.3rem !important;
            margin-top: 0 !important;
            margin-bottom: 4px !important;
        }
        .latest-section-wrap .col-w5q p {
            font-size: .85rem !important;
            margin-bottom: 14px !important;
        }
        /* ── كارد المنبر موبايل ── */
        .latest-section-wrap .slide-content {
            border-radius: 14px !important;
            overflow: hidden;
        }
        .latest-section-wrap .slide-image {
            height: 180px !important;
            width: 100% !important;
            object-fit: cover !important;
        }
    }
</style>

<section style="background: #704e40; margin-top: 100px;">
    <div class="container-e3z latest-section-wrap" style="padding: 20px 15px;">
        <div class="row-sy7">
            <div class="col-w5q">
                <a href="{{ route('magazines.all-magazines') }}" style="text-decoration:none;">
                    <h1 class="font-weight-5zk text-jli" style="margin-top: 25px;">{{ __('app.achievements') }}</h1>
                    <p class="text-jli">{{ __('app.latest_magazine_issue') }}</p>
                </a>
            </div>

            <div class="col-bpd">
                @if ($magazines)
                <a href="{{ route('magazines.show', $magazines->id) }}" style="text-decoration:none;display:block;">
                <div class="slide-content">
                    <img src="{{ asset('storage/' . $magazines->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? $magazines->title_ar : $magazines->title_en }}" class="slide-image">
                    <div style="background:white;padding:12px 18px;">
                        <p style="margin-bottom:8px;font-weight:700;font-size:.92rem;color:#1e293b;">
                            {{ app()->getLocale() == 'ar' ? $magazines->title_ar : $magazines->title_en }}
                        </p>
                        @if($magazines->name)
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                            @if($magazines->image)
                            <img src="{{ asset('storage/' . $magazines->image) }}"
                                 style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid #b68a35;"
                                 alt="{{ $magazines->name }}">
                            @endif
                            <span style="font-size:.82rem;color:#5a4a00;font-weight:600;">بقلم: {{ $magazines->name }}</span>
                        </div>
                        @endif
                        <p style="color:gray;font-size:12px;margin-bottom:0;">{{ __('app.date') }} : {{ \Carbon\Carbon::parse($magazines->event_date ?? $magazines->created_at)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
                </a>
                @else
                <p style="color:#fff;">لا يوجد منبر لعرضه حالياً.</p>
                @endif

                <a href="{{ route('magazines.all-magazines') }}" class="btn-dwo block-qlo" style="display: block; text-align: center; margin-top: 20px;">
                    <i class="fas fa-eye"></i>
                    <span>{{ __('app.view_more') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>
@auth
<a href="{{ route('contact-us') }}">
    <section style="background: rgb(182, 138, 53) !important; margin-top: 0px !important; padding: 18px 0 !important;">
        <div style="text-align: center; justify-content: center;">
            <h1 style="color: white; margin-top: 25px;">تواصل مع الإدارة</h1>
            <p class="text-jli">للشكاوي والاقتراحات وتقييم الخدمات</p>
        </div>
    </section>
</a>
@endauth
