@props(['services'])
<div id="events-section" style="display: flex;">
    <div class="services">
        <div class="title" style="display: flex; justify-content: space-between; max-width: 1200px; width: 100%; margin: auto; ">
            <h3 style="flex: 1; font-size: 36px; color: #000;">{{ __('app.our_services') }}</h3>
            <a href="{{ route('services.all-services') }}" class="main-btn" style="margin-left: 20px; margin-top: 50px; height: min-content; background-color: black;">
                {{ __('app.more') }}
            </a>
        </div>
        <div>
            @foreach ($services as $service) {{-- تم تعديل serivce إلى service لتصحيح إملائي --}}
            <div class="service pe">
                <img class="service-img" src="{{ asset('assets/images/pe.png') }}" alt="{{ app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en }}">
                <h4 class="servicetitle">{{ app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en }}</h4>
                <p class="servicedesc">{{ app()->getLocale() == 'ar' ? $service->description_ar : $service->description_en }}</p>
                <a href="{{ route('services.show', $service) }}" class="servicelink">
                    <img src="{{ asset('assets/images/link.jpg') }}" alt="{{ __('app.service_details') }}" />
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
