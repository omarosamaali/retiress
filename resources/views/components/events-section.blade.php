@props(['services'])
<div id="events-section" style="display: flex;">
    <div class="services">
        <div class="title" style="display: flex; justify-content: space-between; max-width: 1200px; width: 100%; margin: auto; ">
            <h3 style="flex: 1; font-size: 36px; color: #000;">خدماتنا</h3>
            <a href="{{ route('services.all-services') }}" class="main-btn" style="margin-left: 20px; margin-top: 50px; height: min-content; background-color: black;">المزيد
            </a>
        </div>
        <div>
            @foreach ($services as $serivce)
            <div class="service pe">
                <img class="service-img" src="{{ asset('assets/images/pe.png') }}" alt="">
                <h4 class="servicetitle">{{ $serivce->name_ar }}</h4>
                <p class="servicedesc">{{ $serivce->description_ar }}</p>
                <a href="{{ route('services.show', $serivce) }}" class="servicelink"><img src="{{ asset('assets/images/link.jpg') }}" /></a>
            </div>
            @endforeach
        </div>
    </div>
</div>
