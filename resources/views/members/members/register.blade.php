<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>من نحن</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/other-devices.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styleU.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/registerstyle.css') }}">
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/amazingcarousel.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-1.css') }}">
    <script src="{{ asset('assets/js/initcarousel-1.js') }}"></script>
    <script src="{{ asset('assets/js/amazingslider.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-2.css') }}">
    <script src="{{ asset('assets/js/initslider-2.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset(path: 'assets/css/custom.css') }}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
    <x-guest-header></x-guest-header>
    <div id="in-cont">

        <section class="py-rzt" style="padding-top: 150px;">
            <div class="container-w8y">
                <div class="row-x6c">
                    <div class="col-83z offset-md-f6v">
                        <form class="col-k19 sho-ph8" id="registerForm">
                            @csrf
                            <h1 class="text-o8q xygoj mb-pfh font-weight-dom">{{ __('app.new_account') }}</h1>
                            <p class="b-r8w">{{ __('app.register_new_account') }}</p>
                            <div class="p-72h rou-kih shadow-eoy">
                                <div class="label-dav mb-os5">
                                    <input type="hidden" name="role" value="مستخدم">

                                    <input placeholder="{{ __('app.name_placeholder') }}" id="name" name="name"
                                        type="text" class="form-control-k7o fsbsy" required>
                                    <div class="error-message" id="name-error"></div>
                                </div>
                                <div class="label-dav mb-os5">
                                    <input placeholder="{{ __('app.email_placeholder') }}" id="email" name="email"
                                        type="email" class="form-control-k7o fsbsy" required>
                                    <div class="error-message" id="email-error"></div>
                                </div>
                                <div class="input-3ob">
                                    <div class="label-dav input-fja">
                                        <div class="input-f96">
                                            <span class="input-fo3"><i class="fa-evk fa-pp5"></i></span>
                                        </div>
                                        <input value="123456789" placeholder="{{ __('app.password_placeholder') }}"
                                            id="password" name="password" type="password" class="form-control-k7o fsbsy"
                                            required>
                                        <div class="error-message" id="password-error"></div>
                                    </div>
                                </div>
                                <div class="text-a3b mb-os5">
                                    <a href="{{ route('members.forgetpassword') }}" class="fs--n1f">{{
                                        __('app.forgetpassword') }}</a>
                                </div>

                                <!-- reCAPTCHA -->
                                <div class="mb-os5" style="margin-bottom: 15px;">
                                    <div class="g-recaptcha" data-sitekey="6Le8MSgsAAAAACpmYLs_Rzga_iIewZ-qCDPAN0MD">
                                    </div>
                                    <div class="error-message" id="recaptcha-error"
                                        style="display: none; color: #dc3545; font-size: 0.875rem; margin-top: 5px;">
                                    </div>
                                </div>

                                <button type="submit" class="btn-qhr btn-primary-t6n btn-8b1 block-426">{{
                                    __('app.register_account') }}</button>
                                <div class="text-oy9 mt--m56 text-a3b font-weight-dom">
                                    <a href="{{ route('members.login') }}"
                                        class="block-kof success-xd5 text-a3b text-kkc">{{
                                        __('app.login_existing_account') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <x-footer-section></x-footer-section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/amazingcarousel.js') }}"></script>
    <script src="{{ asset('assets/js/initcarousel-1.js') }}"></script>
    <script src="{{ asset('assets/js/amazingslider.js') }}"></script>
    <script src="{{ asset('assets/js/initslider-2.js') }}"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registerForm');
        const errorMessages = {
            name: document.getElementById('name-error'),
            email: document.getElementById('email-error'),
            password: document.getElementById('password-error'),
            recaptcha: document.getElementById('recaptcha-error')
        };

        // إعادة ضبط رسائل الخطأ
        function resetErrors() {
            Object.values(errorMessages).forEach(error => {
                if (error) {
                    error.style.display = 'none';
                    error.textContent = '';
                }
            });
        }

        // عرض رسائل الخطأ
        function displayErrors(errors) {
            resetErrors();
            Object.keys(errors).forEach(key => {
                if (errorMessages[key]) {
                    errorMessages[key].textContent = errors[key][0];
                    errorMessages[key].style.display = 'block';
                } else if (key === 'g-recaptcha-response' && errorMessages.recaptcha) {
                    errorMessages.recaptcha.textContent = errors[key][0];
                    errorMessages.recaptcha.style.display = 'block';
                }
            });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            resetErrors();
            
            // التحقق من reCAPTCHA
            const recaptchaResponse = grecaptcha.getResponse();
            if (!recaptchaResponse) {
                errorMessages.recaptcha.textContent = 'يرجى التحقق من أنك لست روبوت';
                errorMessages.recaptcha.style.display = 'block';
                return;
            }
            
            const formData = new FormData(this);
            formData.append('g-recaptcha-response', recaptchaResponse);
            
            fetch("{{ route('members.register.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    return response.json().then(data => {
                        if (!response.ok) {
                            throw data;
                        }
                        return data;
                    });
                } else {
                    return response.text().then(html => {
                        console.error('Server returned HTML instead of JSON:', html);
                        throw new Error('خطأ في الاتصال بالخادم. يرجى التحقق من سجلات الأخطاء.');
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    form.reset();
                    grecaptcha.reset(); // إعادة تعيين reCAPTCHA
                    window.location.href = data.redirect || "{{ route('members.login') }}";
                }
            })
            .catch(error => {
                console.error('Full Error:', error);
                if (error.errors) {
                    displayErrors(error.errors);
                } else {
                    alert(error.message || 'حدث خطأ أثناء تسجيل الحساب');
                }
                // إعادة تعيين reCAPTCHA عند الخطأ
                grecaptcha.reset();
            });
        });

        // تحقق من الإدخالات في الوقت الفعلي
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.style.borderColor = this.value.trim() ? '#28a745' : '#dde4ea';
                if (errorMessages[this.name]) {
                    errorMessages[this.name].style.display = 'none';
                    errorMessages[this.name].textContent = '';
                }
            });
        });
    });
    </script>
    </div>
</body>

</html>