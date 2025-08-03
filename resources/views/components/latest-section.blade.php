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
<div class="container-9l2 container-s5k vc_-9ok" id="latest-section">
    <div class="row-gtg">
        <div class="container-i1t">
            <div class="row-1yt">
                <div class="container-sls col-rrx">
                    <div class="column-wcn"> @if ($magazines) <div class="row-gtg vc_-ppz">
                            <div class="container-sls col-zbp 1" style="        width: 30%;">
                                <div class="column-wcn">
                                    <div>
                                        <div class="image-ksy content-zgb vc_-lpq">
                                            <figure class="vc_-ao4">
                                                <div class="wrapper-j81"> {{-- استخدام عنوان المجلة بناءً على اللغة الحالية --}} <img style="width: 230px; height: 300px;" src="{{ asset('storage/' . $magazines->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? ($magazines->title_ar ?? __('app.latest_magazine_issue')) : ($magazines->title_en ?? __('app.latest_magazine_issue')) }}"> </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-sls col-zbp 2" style="        width:70%; ">
                                <div class="column-wcn">
                                    <div>
                                        <div class="column-dx4 content-zgb header-f37">
                                            <div class="all-version" style="display: flex; align-items: center; justify-content: space-between;">
                                                <h1 id="style-Ksnz9" class="style-Ksnz9"> {{ __('app.latest_magazine_issue') }} </h1> <a href="{{ route('magazines.all-magazines') }}">{{ __('app.all_issues') }}</a>
                                            </div>
                                        </div>
                                        <div class="column-dx4 content-zgb">
                                            <div>
                                                <p dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" id="style-DRlzk" class="style-DRlzk"> {{-- استخدام وصف المجلة بناءً على اللغة الحالية --}} {{ app()->getLocale() == 'ar' ? ($magazines->description_ar ?? __('app.no_description_available')) : ($magazines->description_en ?? __('app.no_description_available')) }} </p>
                                            </div>
                                        </div>
                                        <div class="column-dx4 content-zgb"> {{-- ترجمة "تاريخ الإصدار" واستخدام translatedFormat للوقت --}}
                                            <p dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">{{ __('app.issue_date') }}: {{ \Carbon\Carbon::parse($magazines->created_at)->translatedFormat('d F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> @else {{-- ترجمة نص "لا توجد مجلات متاحة حالياً." --}}
                        <p>{{ __('app.no_magazines_available') }}</p> @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
