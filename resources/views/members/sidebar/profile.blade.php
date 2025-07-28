<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>الملف الشخصي</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/other-devices.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styleU.css') }}" />
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/amazingcarousel.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-1.css') }}">
    <script src="{{ asset('assets/js/initcarousel-1.js') }}"></script>
    <script src="{{ asset('assets/js/amazingslider.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-2.css') }}">
    <script src="{{ asset('assets/js/initslider-2.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset(path: 'assets/css/custom.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: white;
            min-height: 100vh;
        }

        .profile-container {
            max-width: 700px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-title {
            color: #333;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .profile-image-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .image-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #0e6939;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .profile-image:hover {
            transform: scale(1.05);
        }

        .default-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: lightgray;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            font-weight: bold;
            border: 1px solid gray;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .delete-btn {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4757;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(255, 71, 87, 0.3);
            transition: all 0.3s ease;
        }

        .delete-btn:hover {
            background: #ff3838;
            transform: scale(1.1);
        }

        .upload-btn {
            background: #002e84;
            color: white;
            border: none;
            padding: 12px 24px;
            font-family: 'cairo';
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
        }

        .upload-btn:hover {
            background: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(102, 126, 234, 0.4);
        }

        .file-input {
            display: none;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 16px;
        }

        .form-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e8f0;
            border-radius: 12px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: #0e6939;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .menutitle p {
            color: white;
            padding-top: 20px;
        }

        .save-btn {
            width: 100%;
            background: #b68a35 !important;
            color: white;
            border: none;
            padding: 15px;
            font-family: "cairo";
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-container {
            animation: fadeIn 0.6s ease;
        }

        .btns div {
            font-size: 16px;
        }

    </style>

</head>

<body>
    <x-auth-header></x-auth-header>
    <div id="in-cont">
        <div class="inn-title" style="padding-top: 150px">
            <h2><span><a href="{{ url('/') }}">الرئيسية</a> &raquo;</span>
                الملف الشخصي </h2>
        </div>
        <div class="profile-container">
            <div class="profile-header">
                <h1 class="profile-title">الملف الشخصي</h1>
            </div>
            @if(session('status'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">نجاح</span> {{ session('status') }}
            </div>
            @endif
            <form class="profile-form" method="post" action="{{ route('members.profile.update') }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label" for="name">الاسم</label>
                    <input type="text" class="form-input" id="name" name="name" value="{{ old('name', $user->name) }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">البريد الإلكتروني</label>
                    <input type="text" class="form-input" id="email" name="email" value="{{ old('name', $user->email) }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label class="form-label" for="password">كلمة المرور</label>
                    <input type="password" class="form-input" id="password" name="password" placeholder="••••••••" value="{{ old('password' ) }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="save-btn">💾 حفظ التغييرات</button>
            </form>
        </div>

    </div>

    </div>
    <x-footer-section></x-footer-section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    </div>
</body>

</html>
