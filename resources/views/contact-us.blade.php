<?php
// في ملف routes/web.php
Route::get('contact-us', function(){
    return view('contact-us');
})->name('contact-us');

Route::post('contact-us', function(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'type' => 'required|in:complaint,suggestion,other',
        'message' => 'required|string|max:1000'
    ], [
        'name.required' => 'الاسم مطلوب',
        'phone.required' => 'رقم الهاتف مطلوب',
        'email.required' => 'البريد الإلكتروني مطلوب',
        'email.email' => 'يجب أن يكون البريد الإلكتروني صالحاً',
        'type.required' => 'نوع الرسالة مطلوب',
        'message.required' => 'الرسالة مطلوبة'
    ]);

    // هنا يمكنك حفظ البيانات في قاعدة البيانات أو إرسال إيميل
    // مثال: ContactMessage::create($request->all());
    
    return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح!');
})->name('contact-us.store');
?>

{{-- في ملف resources/views/contact-us.blade.php --}}
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <link rel="icon" type="image/png" href="images/fav.png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>الأسئلة الشائعة</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <link rel="icon" href="http://127.0.0.1:8000/assets/img/Group.png" type="image/x-icon">

    <style>
        .contact-form-container {
            max-width: 800px;
            margin: 40px auto;
            margin-top: 157px;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .contact-form-title {
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Cairo';
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-col {
            flex: 1;
        }

        .btn-submit {
            background: #6e4c3e;
            color: white;
            border: none;
            font-family: 'Cairo';
            border-radius: 8px;
            padding: 12px 40px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            display: block;
            margin: 20px auto 0;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px #6e4c3e;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .alert ul {
            margin: 0;
            padding-right: 20px;
        }



        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            font-family: 'Cairo';
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .contact-form-container {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>
</head>

<body ng-app="myApp">
    <x-guest-header></x-guest-header>

    <div class="contact-form-container">
        <h2 class="contact-form-title">نموذج التواصل معنا</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('contact-us.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="name" class="form-label">الاسم *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required>
                    </div>
                </div>

                <div class="form-col">
                    <div class="form-group">
                        <label for="phone" class="form-label">رقم الهاتف *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                            required>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="email" class="form-label">البريد الإلكتروني *</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                            required>
                    </div>
                </div>

                <div class="form-col">
                    <div class="form-group">
                        <label for="type" class="form-label">نوع الرسالة *</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">اختر نوع الرسالة</option>
                            <option value="complaint" {{ old('type')=='complaint' ? 'selected' : '' }}>
                                شكوى
                            </option>
                            <option value="suggestion" {{ old('type')=='suggestion' ? 'selected' : '' }}>
                                اقتراح
                            </option>
                            <option value="other" {{ old('type')=='other' ? 'selected' : '' }}>
                                أخرى
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="message" class="form-label">الرسالة *</label>
                <textarea class="form-control" id="message" name="message" placeholder="اكتب رسالتك هنا..."
                    required>{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">
                إرسال الرسالة
            </button>
        </form>
    </div>

    <x-footer-section></x-footer-section>
</body>

</html>