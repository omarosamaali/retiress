<style>
    @media (max-width: 768px) {
        .footer-35d .footer-9z1 aside.wid-6bk {
            width: 100%;
        }
    }

    .footer-9z1 #men-54n li a,
    .footer-9z1 #men-er1 li a,
    .footer-35d a,
    .footer-35d .icon-fn7:hover,
    .footer-35d .footer-9z1 aside.wid-6bk .title-opx h4,
    .footer-35d {
        font-size: 16px !important;
    }

    .wid-6bk.footer-8vj ul li {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 2px;
        color: #000000 !important;
    }

    .address span {
        display: block;
        min-width: 100px;
        color: #000000;
    }

    .address .fa {
        color: black !important;
    }

    .footer-icon {
        left: 3px;
        top: -1px;

        position: relative;
        font-size: 26px;
    }

</style>
<div class="footer-35d" id="footer-section">
    <div class="container-he4">
        <div class="footer-9z1">
            <aside class="wid-6bk footer-8vj">
                <div class="title-opx">
                    <h4>{{ __('app.quick_links') }}</h4>
                </div>
                <div>
                    <ul id="men-er1">
                        <li><a href="{{ route('magazines.all-magazines') }}"> {{-- Assuming this links to all magazines --}}
                                {{ __('app.magazine_pulse') }}</a></li>
                        <li><a href="{{ route('members.about') }}"> {{-- Assuming this links to 'about us' --}}
                                {{ __('app.who_we_are') }}</a></li>
                        <li><a href="{{ route('members.members-list') }}"> {{-- Assuming this links to board members --}}
                                {{ __('app.board_members_footer') }}</a></li>
                        <li><a href="{{ route('services.all-services') }}"> {{-- Assuming this links to all services --}}
                                {{ __('app.services_footer') }}
                            </a></li>
                        <li><a href="{{ route('members.committees') }}"> {{-- Assuming this links to committees --}}
                                {{ __('app.committees_and_councils') }}</a></li>
                    </ul>
                </div>
            </aside>
            <aside class="wid-6bk footer-8vj">
                <div class="title-opx">
                    <h4>{{ __('app.read_more') }}</h4>
                </div>
                <div>
                    <ul id="men-54n">
                        <li><a href="{{ route('services.show', ['id'=>1]) }}"> {{-- Assuming this links to Es'ad card service --}}
                                {{ __('app.esaad_card_footer') }}</a></li>
                        <li><a href="{{ route('services.show', ['id'=>2]) }}"> {{-- Assuming this links to Zakat Fund service --}}
                                {{ __('app.zakat_fund_footer') }}
                            </a></li>
                        <li><a href="{{ route('services.show', ['id'=>3]) }}"> {{-- Assuming this links to Volunteering service --}}
                                {{ __('app.volunteering_footer') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            <aside class="wid-6bk footer-8vj wid-jyj">
                <div class="title-opx">
                    <h4>{{ __('app.contact_us_footer') }}</h4>
                </div>
                <div>
                    <div class="text-apb">
                        <i class="fa-solid fa-house icon-custom"></i> <span class="text-o77"> العنوان : {{ $settings?->address }} </span>

                    </div>
                    <div class="text-apb">
                        <i class="fa-solid fa-calendar icon-custom"></i> <span class="text-o77"> رقم المكتب : {{ $settings?->office_number }}


                        </span>
                    </div>
                    <div class="text-apb">
                        <i class="fa-solid fa-phone-volume icon-custom"></i> <span class="text-o77"> رقم الواتس : {{ $settings?->whatsapp }}</span>


                    </div>
                    <div class="text-apb">
                        <i class="fa-solid fa-blender-phone icon-custom"></i> <span class="text-o77">
                            <a class="stm-qoa" href="mailto:info@uaeca.ae"> البريد الإلكترني : {{ $settings?->email }}</a>
                        </span>
                    </div>
                    <div class="text-apb">
                        <i class="fa-solid fa-envelope icon-custom"></i> <span class="text-o77"> 
                        {{ $settings?->work_days }}
                        </span>
                    </div>
                    <div class="text-apb">
                        <i class="fa-solid fa-envelope icon-custom"></i> <span class="text-o77">
                        {{ $settings?->holidays }}
                        </span>
                    </div>
                </div>
            </aside>
            <aside class="wid-6bk footer-8vj">
                <div class="title-opx">
                    <h4>{{ __('app.subscribe_newsletter') }}</h4>
                </div>
                <div class="overlay-7bx"></div>
                <div id="mai-fcd" class="form-wtb">
                    <form class="form-wtb">
                        <input type="hidden" name="data[form_id]" value="1" id="dat-apq">
                        <input type="hidden" name="token" value="a60da90ff4" id="tok-r9y">
                        <input type="hidden" name="api_version" value="v1" id="api-ccf">
                        <input type="hidden" name="endpoint" value="subscribers" id="end-g8r">
                        <input type="hidden" name="mailpoet_method" value="subscribe" id="mai-goe">
                        <p class="form-e4y style-h3SVz" id="style-h3SVz">
                            {{ __('app.newsletter_desc') }}
                        </p>
                        <div class="mai-b3r">
                            <label for="form_email_1" class="text-j65">{{ __('app.email') }}
                                <span>*</span></label>
                            <input type="email" class="text-xoe style-KBklM" id="dat-3xg" name="data[form_field_MGU0MzkwOGUyZGZlX2VtYWls]" value="" placeholder="{{ __('app.email_placeholder') }}">
                        </div>
                        <div class="mai-b3r las-b87">
                            <input type="submit" class="mai-7wi style-LFBwk" value="{{ __('app.subscribe_button') }}" id="style-LFBwk">
                            <span class="loading-t8z"><span class="mai-kfs"></span><span class="mai-wtd"></span><span></span></span>
                        </div>
                    </form>


                    <ul class="social-set" style="margin-top: 10px;">
                        <li>
                            <a class="sociali" href="{{ $settings?->twitter }}" target="_blank" aria-label="Twitter">
                                <i class="footer-icon fa fa-twitter fa-fw custom-icon" title="Twitter"></i></a></li>
                        <li><a class="sociali" href="{{ $settings?->instagram }}" target="_blank" aria-label="Instagram">
                                <i class="footer-icon fa fa-instagram fa-fw custom-icon" title="Instagram"></i></a></li>
                        <li><a class="sociali" href="{{ $settings?->facebook }}" target="_blank" aria-label="Facebook">
                                <i style="    left: 0px;
    top: 1px;" class="footer-icon fa fa-facebook-square fa-fw custom-face" title="Facebook"></i></a></li>

                        <li><a style="
    top: -5px;
    position: relative;

" class="sociali" href="{{ $settings?->youtube }}" target="_blank" aria-label="Facebook">
                                <i style="    left: 0px;
    top: 1px;" class="footer-icon fa fa-youtube custom-face"></i>

                            </a></li>

                    </ul>

                </div>
            </aside>
        </div>
    </div>
</div>

<div class="bg_-3kn text-7nf py-sp2 cle-6ew">
    <div class="container-9zp cle-6ew font-weight-3ik">
        <div class="fs--hoe py-ac9 float-8xn">
            {{ __('app.all_rights_reserved') }} &copy; {{ date('Y') }} {{-- تم تغيير 2025 إلى دالة date('Y') لجعله ديناميكيًا --}}
        </div>
        <div class="fs--hoe py-ac9 float-prj" style="text-transform: uppercase">
            <a href="https://evorq.com/" target="_blank" class="text-7nf" id="kodoLink">
                {{ __('app.developed_by') }}
            </a>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <div class="decorative-elements">
            <div class="floating-icon">💻</div>
            <div class="floating-icon">🚀</div>
            <div class="floating-icon">⭐</div>
        </div>

        <button class="close-btn" id="closeBtn">&times;</button>

        <div class="modal-content">
            <div class="kodo-logo">
                <img style="width: 82px;" src="https://evorq.com/storage/footer-logo-1-1.png" alt="Evorq Logo">
            </div>
            <h2>{{ __('app.implemented_by_evorq') }}</h2>

            <div class="contact-info">
                <div class="phone">{{ __('app.tareq_mohamed_bn_kalban') }}</div>
                <div class="phone">📞 0501774477</div>
                <div class="website">🌐 <a href="https://evorq.com/" target="_blank">https://evorq.com</a></div>
            </div>

            <div class="modal-info">
                {{ __('app.evorq_company_slogan') }}<br>
                {{ __('app.evorq_description') }}
            </div>
        </div>
    </div>
</div>
