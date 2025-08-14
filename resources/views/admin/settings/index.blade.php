@extends('layouts.admin')

@section('title', 'إدارة التواصل')
@section('page-title', 'إدارة التواصل')

@push('styles')
<style>
    .alert {
        background-color: #e3f2fd;
        border: 1px solid #90caf9;
        border-radius: 8px;
        padding: 16px 20px;
        margin: 20px 0;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        direction: rtl;
    }

    .alert-icon {
        background-color: #2196f3;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        flex-shrink: 0;
    }

    .alert-content {
        color: #1565c0;
        font-size: 14px;
        line-height: 1.5;
    }

    .alert-content strong {
        color: #0d47a1;
    }

    .add-section {
        background: #212529;
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 15px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0e6939;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
    }

    .action-buttons .btn {
        padding: 5px 10px;
        font-size: 12px;
        margin: 0 2px;
    }

    .news-img {
        width: 50px;
        height: auto;
        border-radius: 5px;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    }

    .news-preview {
        width: 150px;
        max-height: 100px;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 10px;
    }

    .form-container {
        /* padding: 30px; */
    }

    .form-section {
        margin-bottom: 30px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 20px;
        background: #fafafa;
    }

    .section-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #2196f3;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
        font-size: 14px;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        direction: rtl;
        transition: border-color 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #2196f3;
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }

    .form-textarea {
        min-height: 80px;
        resize: vertical;
    }

    .social-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .social-item {
        background: white;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }

    .social-label {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }

    .btn {
        background: linear-gradient(135deg, #2196f3, #1976d2);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 10px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
    }

    .btn-secondary {
        background: #6c757d;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }

    .form-actions {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .preview-section {
        margin-top: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }

    .preview-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .preview-content {
        background: white;
        padding: 20px;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    @media (max-width: 768px) {
        .social-section {
            grid-template-columns: 1fr;
        }

        .container {
            margin: 10px;
        }
    }

</style>
@endpush

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="container">
    <div class="header">
        <h1><i class="fas fa-cogs"></i> إدارة بيانات التواصل</h1>
        <p>تحكم في جميع معلومات التواصل الخاصة بموقعك</p>
    </div>

    <div class="alert">
        <div class="alert-icon">ℹ</div>
        <div class="alert-content">
            <strong>ملحوظة:</strong> من هنا يمكنك إدارة جميع بيانات التواصل الخاصة بالموقع مثل أرقام الهاتف ولينكات السوشيال ميديا
        </div>
    </div>

    <div class="form-container">
        <form id="contactForm" method="post" action="{{ route('settings.store') }}">
            @csrf
            <!-- معلومات الاتصال الأساسية -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i>
                    معلومات الاتصال الأساسية
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-home"></i> العنوان
                    </label>
                    <input value="{{ $settings?->address }}" type="text" class="form-input" name="address" id="address" placeholder="أدخل العنوان">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar"></i> رقم المكتب
                    </label>
                    <input value="{{ $settings?->office_number }}" type="text" class="form-input" id="officeNumber" name="office_number" placeholder="أدخل رقم المكتب">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-phone-volume"></i> رقم الواتس
                    </label>
                    <input value="{{ $settings?->whatsapp }}" type="text" class="form-input" id="whatsapp" name="whatsapp" placeholder="أدخل رقم الواتس آب">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i> البريد الإلكتروني
                    </label>
                    <input value="{{ $settings?->email }}" type="email" class="form-input" id="email" name="email" placeholder="أدخل البريد الإلكتروني">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-clock"></i> أيام العمل
                    </label>
                    <textarea class="form-input form-textarea" id="workDays" name="work_days" placeholder="مثال: من الأحد إلى الخميس من الساعة 8 إلى 3 ظهراً">{{ $settings?->work_days }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar-times"></i> أيام العطل الرسمية
                    </label>
                    <textarea class="form-input form-textarea" id="holidays" name="holidays" placeholder="مثال: الجمعة والسبت والأحد">{{ $settings?->holidays }}</textarea>
                </div>
            </div>

            <!-- روابط وسائل التواصل الاجتماعي -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-share-alt"></i>
                    روابط وسائل التواصل الاجتماعي
                </div>

                <div class="social-section">
                    <div class="social-item">
                        <label class="social-label">
                            <i class="fab fa-facebook" style="color: #1877f2;"></i>
                            فيسبوك
                        </label>
                        <input value="{{ $settings?->facebook_url }}" name="facebook_url" type="url" class="form-input" id="facebook" placeholder="https://www.facebook.com/...">
                    </div>

                    <div class="social-item">
                        <label class="social-label">
                            <i class="fab fa-instagram" style="color: #e4405f;"></i>
                            إنستجرام
                        </label>
                        <input value="{{ $settings?->instagram_url }}" type="url" name="instagram_url" class="form-input" id="instagram" placeholder="https://www.instagram.com/...">
                    </div>

                    <div class="social-item">
                        <label class="social-label">
                            <i class="fab fa-twitter" style="color: #1da1f2;"></i>
                            تويتر
                        </label>
                        <input value="{{ $settings?->tiktok_url }}" type="url" name="tiktok_url" class="form-input" id="twitter" placeholder="https://twitter.com/...">
                    </div>

                    <div class="social-item">
                        <label class="social-label">
                            <i class="fab fa-youtube" style="color: #ff0000;"></i>
                            يوتيوب
                        </label>
                        <input value="{{ $settings?->youtube_url }}" type="url" name="youtube_url" class="form-input" id="youtube" placeholder="https://www.youtube.com/...">
                    </div>

                    <div class="social-item">
                        <label class="social-label">
                            <i class="fab fa-apple" style="color: #1877f2;"></i>
                            IOS
                        </label>
                        <input value="{{ $settings?->ios_url }}" name="ios_url" type="url" class="form-input" id="ios_url" placeholder="https://www.ios.com/...">
                    </div>

                    <div class="social-item">
                        <label class="social-label">
                            <i class="fab fa-android" style="color: #e4405f;"></i>
                            Android
                        </label>
                        <input value="{{ $settings?->android_url }}" type="url" name="android_url" class="form-input" id="instagram" placeholder="https://www.android.com/...">
                    </div>

                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> حفظ البيانات
                </button>
                {{-- <button type="button" class="btn btn-secondary" onclick="generatePreview()">
                        <i class="fas fa-eye"></i> معاينة النتيجة
                    </button> --}}
                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                    <i class="fas fa-undo"></i> إعادة تعيين
                </button>
            </div>
        </form>

        <div class="preview-section" id="previewSection" style="display: none;">
            <div class="preview-title">
                <i class="fas fa-eye"></i> معاينة النتيجة
            </div>
            <div class="preview-content" id="previewContent">
                <!-- سيتم عرض النتيجة هنا -->
            </div>
        </div>
    </div>
</div>



@endsection
