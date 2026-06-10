@props(['services', 'serviceEvents' => collect()])

@php
    $items = $serviceEvents->isNotEmpty() ? $serviceEvents : $services;
    $count = $items->count();
@endphp

<section style="background: #704e40; margin-top: 0;">
    <div class="container-e3z">
        <div class="row-sy7">
            <div class="col-w5q">
                <h1 class="font-weight-5zk text-jli" style="margin-top: 25px;">{{ __('app.our_services') }}</h1>
                <p class="text-jli">{{ __('app.events_description') }}</p>
            </div>
            <div class="col-bpd">
                @if ($count === 0)
                    <div style="display:flex;align-items:center;justify-content:center;min-height:200px;flex-direction:column;gap:16px;color:rgba(255,255,255,.8);padding:30px 0;">
                        <i class="fa-regular fa-briefcase" style="font-size:2.5rem;"></i>
                        <span style="font-size:1rem;font-weight:600;">لا تتوفر خدمات حالياً</span>
                    </div>

                @elseif ($count === 1)
                    @php $item = $items->first(); @endphp
                    <a href="{{ $serviceEvents->isNotEmpty() ? url('/events/show/'.$item->id) : route('services.show', $item) }}"
                       class="slide-content" style="text-decoration:none;display:block;">
                        <img src="{{ asset('storage/' . ($serviceEvents->isNotEmpty() ? $item->main_image : $item->image)) }}"
                             alt="{{ app()->getLocale() == 'ar' ? ($item->title_ar ?? $item->name_ar) : ($item->title_en ?? $item->name_en) }}"
                             class="slide-image">
                        <div class="slide-title">
                            {{ app()->getLocale() == 'ar' ? ($item->title_ar ?? $item->name_ar) : ($item->title_en ?? $item->name_en) }}
                        </div>
                    </a>

                @else
                    <div class="swiper servicesSwiper">
                        <div class="swiper-wrapper">
                            @foreach ($items as $item)
                            <div class="swiper-slide">
                                <a href="{{ $serviceEvents->isNotEmpty() ? url('/events/show/'.$item->id) : route('services.show', $item) }}"
                                   class="slide-content">
                                    <img src="{{ asset('storage/' . ($serviceEvents->isNotEmpty() ? $item->main_image : $item->image)) }}"
                                         alt="{{ app()->getLocale() == 'ar' ? ($item->title_ar ?? $item->name_ar) : ($item->title_en ?? $item->name_en) }}"
                                         class="slide-image">
                                    <div class="slide-title">
                                        {{ app()->getLocale() == 'ar' ? ($item->title_ar ?? $item->name_ar) : ($item->title_en ?? $item->name_en) }}
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"><i class="fas fa-chevron-left"></i></div>
                        <div class="swiper-button-prev"><i class="fas fa-chevron-right"></i></div>
                    </div>
                @endif

                <a href="{{ route('services.all-services') }}" class="btn-dwo block-qlo"
                   style="display: block; text-align: center; margin-top: 30px;">
                    <i class="fas fa-eye"></i>
                    <span>{{ __('app.view_more') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>
