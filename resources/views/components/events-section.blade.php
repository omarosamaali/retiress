@props(['services', 'serviceEvents' => collect()])

@php
    $items = $serviceEvents->isNotEmpty() ? $serviceEvents : $services;
    $isEvents = $serviceEvents->isNotEmpty();
    $shown = $items->take(3);
@endphp

<section style="background:#704e40;margin-top:0;padding:40px 0;">
    <div class="container-e3z">

        {{-- عنوان القسم --}}
        <div style="text-align:center;margin-bottom:28px;">
            <h1 class="font-weight-5zk" style="color:#fff;margin:0 0 8px;">{{ __('app.our_services') }}</h1>
            <p style="color:rgba(255,255,255,.75);margin:0;font-size:.9rem;">{{ __('app.events_description') }}</p>
        </div>

        @if ($items->isEmpty())
            <div style="display:flex;align-items:center;justify-content:center;min-height:160px;flex-direction:column;gap:12px;color:rgba(255,255,255,.7);">
                <i class="fa-regular fa-briefcase" style="font-size:2.5rem;"></i>
                <span style="font-size:1rem;font-weight:600;">لا تتوفر خدمات حالياً</span>
            </div>
        @else

        {{-- 3 كاردز --}}
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px;direction:rtl;">
            @foreach($shown as $item)
            @php
                $img   = $isEvents ? $item->main_image : $item->image;
                $title = app()->getLocale() == 'ar'
                    ? ($item->title_ar ?? $item->name_ar ?? '')
                    : ($item->title_en ?? $item->name_en ?? '');
                $link  = $isEvents ? url('/events/show/'.$item->id) : route('services.show', $item);
            @endphp
            <a href="{{ $link }}"
               style="text-decoration:none;border-radius:14px;overflow:hidden;background:rgba(255,255,255,.12);backdrop-filter:blur(4px);display:flex;flex-direction:column;transition:transform .2s,background .2s;"
               onmouseover="this.style.transform='translateY(-4px)';this.style.background='rgba(255,255,255,.2)'"
               onmouseout="this.style.transform='';this.style.background='rgba(255,255,255,.12)'">
                <div style="overflow:hidden;height:150px;">
                    <img src="{{ asset('storage/' . $img) }}"
                         alt="{{ $title }}"
                         style="width:100%;height:100%;object-fit:fill;display:block;transition:transform .3s;"
                         onmouseover="this.style.transform='scale(1.05)'"
                         onmouseout="this.style.transform=''">
                </div>
                <div style="padding:12px 14px;">
                    <p style="margin:0;color:#fff;font-size:.82rem;font-weight:700;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                        {{ $title }}
                    </p>
                    @if($isEvents && !empty($item->event_date))
                    <p style="margin:6px 0 0;color:rgba(255,255,255,.6);font-size:.7rem;">
                        <i class="fa-regular fa-calendar" style="margin-left:4px;"></i>
                        {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d M Y') }}
                    </p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        @endif

        <a href="{{ route('services.all-services') }}" class="btn-dwo block-qlo"
           style="display:block;text-align:center;margin-top:24px;">
            <i class="fas fa-eye"></i>
            <span>{{ __('app.view_more') }}</span>
        </a>
    </div>
</section>
