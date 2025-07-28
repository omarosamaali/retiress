@props(['magazines'])

<style>
    @media (max-width: 500px) {
        .all-version {
            flex-direction: column;
        }
    }

</style>
<div class="container-9l2 container-s5k vc_-9ok" id="latest-section">
    <div class="row-gtg">
        <div class="container-i1t">
            <div class="row-1yt">
                <div class="container-sls col-rrx">
                    <div class="column-wcn">
                        @if ($magazines)
                        <div class="row-gtg vc_-ppz">
                            <div class="container-sls col-zbp">
                                <div class="column-wcn">
                                    <div>
                                        <div class="image-ksy content-zgb vc_-lpq">
                                            <figure class="vc_-ao4">
                                                <div class="wrapper-j81">
                                                    <img width="1275" height="743" src="{{ asset('storage/' . $magazines->main_image) }}" alt="{{ $magazines->title_ar ?? 'أحدث إصدار' }}">
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-sls col-zbp">
                                <div class="column-wcn">
                                    <div>
                                        <div class="column-dx4 content-zgb header-f37">
                                            <div class="all-version" style="display: flex; align-items: center; justify-content: space-between;">
                                                <h1 id="style-Ksnz9" class="style-Ksnz9">
                                                    أخر إصدار مجلة نبض المتقاعد
                                                </h1>
                                                <a href="{{ route('magazines.all-magazines') }}">جميع الإصدارات</a>
                                            </div>
                                        </div>
                                        <div class="column-dx4 content-zgb">
                                            <div>
                                                <p dir="rtl" id="style-DRlzk" class="style-DRlzk">
                                                    {{ $magazines->description_ar ?? 'لا يوجد وصف متاح.' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="column-dx4 content-zgb">
                                            <p dir="rtl">تاريخ الإصدار: {{ \Carbon\Carbon::parse($magazines->created_at)->translatedFormat('d F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <p>لا توجد مجلات متاحة حالياً.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
