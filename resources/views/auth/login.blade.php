<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');

</style>

<img src="{{ asset('assets/img/uaered-pg.png') }}" alt="" class="" style="position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    z-index: -1;
    height: 100%;
">
<img src="{{ asset('assets/img/Group.png') }}" alt="" style="    width: 134px;
    z-index: 9999999999999;
    margin: auto;
    display: flex
;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    position: absolute;
    top: 117px;
    ">
<div class="login-container">
    <h2 class="login-title">تسجيل الدخول</h2>

    <!-- Session Status -->
    @if (session('status'))
    <div class="status-message">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">
            <!-- Password -->
            <div style="width: 50%;" class="form-group">
                <label for="password" class="form-label">{{ __('كلمة المرور') }}</label>
                <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="أدخل كلمة المرور" />
                @error('password')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div style="width: 50%;" class="form-group">
                <label for="email" class="form-label">{{ __('البريد الإلكتروني') }}</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="أدخل بريدك الإلكتروني" />
                @error('email')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-footer">
            <button type="submit" class="login-button">
                {{ __('تسجيل الدخول') }}
            </button>
        </div>
        <span class="developed">
            تم التطوير بواسطة شركة إيفورك
        </span>
    </form>
    <img class="footer-logo" src="{{ asset('assets/img/footer-logo.webp') }}" alt="">
</div>

<style>
    .footer-logo {
        align-items: center;
        display: flex;
        justify-content: center;
        margin: auto;
        margin-top: 14px;
        width: 70px;
    }

    .developed {
        display: block;
        text-align: center;
        font-size: 18px;
        top: 15px;
        position: relative;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-container {
        /* background: rgba(255, 255, 255, 0.95); */
        padding: 50px 40px;
        width: 100%;
        max-width: 551px;
        top: 45px !important;
        position: relative;
        overflow: hidden;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .login-title {
        text-align: center;
        margin-bottom: 35px;
        color: #2c3e50;
        font-size: 26px;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        color: #34495e;
        font-weight: 600;
        text-align: center;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-input {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e8ecf4;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: center;
        background: linear-gradient(145deg, #f8f9fa, #ffffff);
        color: #2c3e50;
        font-weight: 500;
        font-family: 'cairo' !important;
    }

    .form-input:focus {
        outline: none;
        border-color: #4facfe;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
        transform: translateY(-2px);
    }

    .form-input:hover {
        border-color: #bdc3c7;
        transform: translateY(-1px);
    }

    .form-input::placeholder {
        color: #95a5a6;
        font-weight: 400;
    }

    .error-message {
        color: #e74c3c;
        font-size: 13px;
        margin-top: 8px;
        display: block;
        font-weight: 500;
        padding-left: 5px;
    }

    .status-message {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px solid #c3e6cb;
        font-weight: 500;
        text-align: center;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        margin: 25px 0 30px 0;
        padding: 15px;
        border-radius: 10px;
    }

    .checkbox {
        margin-right: 12px;
        width: 20px;
        height: 20px;
        accent-color: #4facfe;
        cursor: pointer;
    }

    .checkbox-label {
        color: #34495e;
        font-size: 15px;
        font-family: 'cairo' !important;
        cursor: pointer;
        font-weight: 500;
        user-select: none;
    }

    .form-footer {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
        flex-wrap: wrap;
        font-family: 'cairo' !important;
        gap: 20px;
    }

    .forgot-password {
        color: #4facfe;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .forgot-password:hover {
        color: #00f2fe;
        transform: translateY(-1px);
    }

    .forgot-password::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #4facfe, #00f2fe);
        transition: width 0.3s ease;
    }

    .forgot-password:hover::after {
        width: 100%;
    }

    .login-button {
        background: #000000;
        color: white;
        padding: 15px 35px;
        border: none;
        border-radius: 12px;
        font-family: 'cairo' !important;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 140px;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
    }

    .login-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .login-button:hover::before {
        left: 100%;
    }

    .login-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(79, 172, 254, 0.4);
    }

    .login-button:active {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
    }

    @media (max-width: 480px) {
        .login-container {
            padding: 40px 30px;
            margin: 10px;
        }

        .login-title {
            font-size: 28px;
        }

        .form-footer {
            flex-direction: column;
            text-align: center;
        }

        .login-button {
            width: 100%;
            margin-top: 10px;
        }
    }

    /* تأثير إضافي للحركة */
    .form-group {
        animation: slideUp 0.6s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    .form-group:nth-child(1) {
        animation-delay: 0.1s;
    }

    .form-group:nth-child(2) {
        animation-delay: 0.2s;
    }

    .form-group:nth-child(3) {
        animation-delay: 0.3s;
    }

    .checkbox-container {
        animation-delay: 0.4s;
    }

    .form-footer {
        animation-delay: 0.5s;
    }

    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-title {
        animation: fadeInDown 0.8s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

</style>
