@props(['magazines']) <style>
    @media (max-width: 500px) {
        .all-version {
            flex-direction: column;
        }

        .container-sls {
            width: 100% !important;
        }
    }

</style>

<section style="background: #704e40; margin-top: 100px;">
    <div class="container-e3z">
        <div class="row-sy7">
            <div class="col-w5q">
                <h1 class="font-weight-5zk text-jli" style="margin-top: 25px;">{{ __('app.achievements') }}</h1>
                <p class="text-jli">{{ __('app.latest_magazine_issue') }}</p>
            </div>

            <div class="col-bpd">
                @if ($magazines)
                <div class="slide-content">
                    <img src="{{ asset('storage/' . $magazines->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? $magazines->title_ar : $magazines->title_en }}" class="slide-image">
                    <div style="    background: white;
    padding: 10px 21px;

">

                        <p style="margin-bottom: 10px;">
                            {{ app()->getLocale() == 'ar' ? $magazines->title_ar : $magazines->title_en }}
                        </p>
                        <p style="color: gray; font-size: 12px; margin-bottom: 0px;">{{ __('app.date') }} : {{ \Carbon\Carbon::parse($magazines->event_date)->translatedFormat('d F Y') }}</p>
                    </div>

                </div>
                @else
                <p>لا يوجد الإنجازات لعرضها حالياً.</p>
                @endif

                <a href="{{ route('magazines.all-magazines') }}" class="btn-dwo block-qlo" style="display: block; text-align: center;margin-top: 30px;">
                    <i class="fas fa-eye"></i>
                    <span>{{ __('app.view_more') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>
@props(['magazines']) <style>
    @media (max-width: 500px) {
        .all-version {
            flex-direction: column;
        }

        .container-sls {
            width: 100% !important;
        }
    }

</style>

<a href="{{ route('contact-us') }}">
    <section style="background: rgb(182, 138, 53) !important; margin-top: 0px !important; padding: 18px 0 !important;">
        <div style="text-align: center; justify-content: center;">
            <h1 style="color: white; margin-top: 25px;">تواصل مع القيادات</h1>
            <p class="text-jli">للشكاوي والاقتراحات وتقييم الخدمات</p>
        </div>
    </section>
</a>
