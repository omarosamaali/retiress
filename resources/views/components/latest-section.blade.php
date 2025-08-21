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
                <div class="swiper eventsSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($magazines as $event)
                        <div class="swiper-slide">
                            <div class="slide-content">
                                <img src="{{ asset('storage/' . $event->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}" class="slide-image">
                                <div class="slide-title">
                                    {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                                </div>
                                <p style="padding-top: 20px; padding-right: 20px; margin-bottom: 15px;">{{ __('app.date') }} : {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</p>
                            </div>
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
                <a href="{{ route('magazines.all-magazines') }}" class="btn-dwo block-qlo" style="display: block; text-align: center;margin-top: 30px;">
                    <i class="fas fa-eye"></i>
                    <span>{{ __('app.view_more') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>
