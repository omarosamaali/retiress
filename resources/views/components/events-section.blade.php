@props(['services', 'serviceEvents' => collect()])
<div id="events-section" style="display: flex;">
    <div class="services">
        <div class="title" style="display: flex; justify-content: space-between; max-width: 1200px; width: 100%; margin: auto; ">
            <h3 style="flex: 1; font-size: 36px; color: #000;">{{ __('app.our_services') }}</h3>
            <a href="{{ route('events.all-events') }}" class="main-btn" style="margin-left: 20px; margin-top: 50px; height: min-content; background-color: black;">
                {{ __('app.more') }}
            </a>
        </div>
        <div>
            @forelse ($serviceEvents as $event)
            <div class="service pe">
                <img class="service-img" src="{{ asset('storage/' . $event->main_image) }}"
                 alt="{{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}"
                 style="width:90px;height:90px;object-fit:cover;border-radius:8px;">
                <h4 class="servicetitle">{{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}</h4>
                <p class="servicedesc">{{ \Illuminate\Support\Str::limit(app()->getLocale() == 'ar' ? $event->description_ar : $event->description_en, 100) }}</p>
                <a href="{{ url('/events/show/' . $event->id) }}" class="servicelink">
                    <img src="{{ asset('assets/images/link.jpg') }}" alt="{{ __('app.service_details') }}" />
                </a>
            </div>
            @empty
            @foreach ($services as $service)
            <div class="service pe">
                <img class="service-img" src="{{ asset('storage/' . $service->image) }}"
                 alt="{{ app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en }}"
                 style="width:90px;height:90px;object-fit:cover;border-radius:8px;">
                <h4 class="servicetitle">{{ app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en }}</h4>
                <p class="servicedesc">{{ app()->getLocale() == 'ar' ? $service->description_ar : $service->description_en }}</p>
                <a href="{{ route('services.show', $service) }}" class="servicelink">
                    <img src="{{ asset('assets/images/link.jpg') }}" alt="{{ __('app.service_details') }}" />
                </a>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</div>
