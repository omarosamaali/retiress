<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تعديل طلب العضوية</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styleU.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <style>
        .edit-page { max-width: 800px; margin: 110px auto 40px; padding: 0 16px; }
        .edit-card { background: #fff; border-radius: 14px; box-shadow: 0 4px 20px rgba(0,0,0,.08); padding: 28px 30px; margin-bottom: 20px; }
        .edit-card__title { font-size: 1rem; font-weight: 700; color: #016330; border-bottom: 2px solid #e8f3ed; padding-bottom: 10px; margin-bottom: 20px; }
        .form-label { font-weight: 600; font-size: .88rem; color: #374151; margin-bottom: 4px; }
        .form-control { border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 9px 12px; font-size: .9rem; font-family: inherit; width: 100%; box-sizing: border-box; }
        .form-control:focus { border-color: #016330; outline: none; box-shadow: 0 0 0 3px rgba(1,99,48,.1); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
        @media(max-width:600px) { .form-row { grid-template-columns: 1fr; } }
        .doc-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        @media(max-width:600px) { .doc-grid { grid-template-columns: 1fr; } }
        .doc-item { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa; }
        .doc-item__label { font-size: .85rem; font-weight: 700; color: #374151; margin-bottom: 10px; display: block; }
        .doc-preview { display: block; margin-bottom: 8px; }
        .doc-preview img { height: 100px; width: auto; max-width: 100%; border-radius: 6px; border: 2px solid #016330; object-fit: cover; }
        .doc-exists { font-size: .78rem; color: #016330; margin-bottom: 6px; }
        .doc-missing { font-size: .78rem; color: #94a3b8; margin-bottom: 6px; }
        .readonly-field { background: #f8fafc; color: #64748b; cursor: not-allowed; }
        .submit-btn { background: #016330; color: #fff; border: none; border-radius: 10px; padding: 12px 30px; font-size: .95rem; font-family: inherit; font-weight: 600; cursor: pointer; transition: background .18s; }
        .submit-btn:hover { background: #014d25; }
        .back-link { display: inline-flex; align-items: center; gap: 6px; color: #016330; text-decoration: none; font-size: .88rem; margin-bottom: 16px; }
        .back-link:hover { text-decoration: underline; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: 8px; padding: 12px 16px; margin-bottom: 16px; font-size: .9rem; }
        .alert-danger { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; border-radius: 8px; padding: 12px 16px; margin-bottom: 16px; font-size: .9rem; }
        .error-text { color: #dc2626; font-size: .78rem; margin-top: 3px; }
    </style>
</head>
<body class="mp-body">
    <x-guest-header></x-guest-header>

    <div class="edit-page">

        <a href="{{ route('members.panel') }}" class="back-link">
            <i class="fa-solid fa-arrow-right"></i> العودة للوحة التحكم
        </a>

        <h2 style="font-size:1.2rem; font-weight:700; color:#1e293b; margin-bottom:20px;">
            <i class="fa-solid fa-id-card text-success me-2" style="color:#016330; margin-left:6px;"></i>
            تعديل طلب العضوية
        </h2>

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-check-circle me-1"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert-danger">
            <ul style="margin:0; padding-right:18px;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('members.application.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- بيانات ثابتة (للعرض فقط) --}}
            <div class="edit-card">
                <div class="edit-card__title"><i class="fa-solid fa-user me-2"></i> البيانات الأساسية</div>
                <div class="form-row">
                    <div>
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" class="form-control readonly-field" value="{{ $application->full_name }}" readonly>
                    </div>
                    <div>
                        <label class="form-label">رقم العضوية</label>
                        <input type="text" class="form-control readonly-field" value="{{ $application->membership_number }}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div>
                        <label class="form-label">رقم الهوية الوطنية</label>
                        <input type="text" class="form-control readonly-field" value="{{ $application->national_id }}" readonly>
                    </div>
                    <div>
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="text" class="form-control readonly-field" value="{{ $application->email }}" readonly>
                    </div>
                </div>
                <p style="font-size:.78rem; color:#94a3b8; margin:0;">* هذه البيانات لا يمكن تعديلها. تواصل مع الإدارة إذا كانت هناك حاجة لتغييرها.</p>
            </div>

            {{-- بيانات قابلة للتعديل --}}
            <div class="edit-card">
                <div class="edit-card__title"><i class="fa-solid fa-phone me-2"></i> بيانات التواصل</div>
                <div class="form-row">
                    <div>
                        <label class="form-label">الهاتف المحمول <span style="color:#dc2626">*</span></label>
                        <input type="tel" name="mobile_phone" class="form-control" value="{{ old('mobile_phone', $application->mobile_phone) }}" required>
                        @error('mobile_phone')<div class="error-text">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="form-label">هاتف المنزل</label>
                        <input type="tel" name="home_phone" class="form-control" value="{{ old('home_phone', $application->home_phone) }}">
                        @error('home_phone')<div class="error-text">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div style="max-width:50%;">
                    <label class="form-label">صندوق البريد</label>
                    <input type="text" name="po_box" class="form-control" value="{{ old('po_box', $application->po_box) }}">
                    @error('po_box')<div class="error-text">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- المستندات --}}
            <div class="edit-card">
                <div class="edit-card__title"><i class="fa-solid fa-images me-2"></i> المستندات والصور</div>
                <p style="font-size:.8rem; color:#64748b; margin-bottom:16px;">اترك الحقل فارغاً للإبقاء على الصورة الحالية.</p>
                <div class="doc-grid">
                    @php
                    $docs = [
                        ['field'=>'passport_photo',                  'col'=>'passport_photo_path',                  'label'=>'صورة الجواز'],
                        ['field'=>'national_id_photo',               'col'=>'national_id_photo_path',               'label'=>'صورة الهوية الوطنية'],
                        ['field'=>'personal_photo',                  'col'=>'personal_photo_path',                  'label'=>'الصورة الشخصية'],
                        ['field'=>'educational_qualification_photo', 'col'=>'educational_qualification_photo_path', 'label'=>'صورة المؤهل التعليمي'],
                        ['field'=>'retirement_card_photo',           'col'=>'retirement_card_photo_path',           'label'=>'صورة بطاقة التقاعد'],
                        ['field'=>'front_id',                        'col'=>'front_id',                             'label'=>'وجه الهوية'],
                        ['field'=>'back_id',                         'col'=>'back_id',                              'label'=>'ظهر الهوية'],
                    ];
                    @endphp
                    @foreach($docs as $doc)
                    <div class="doc-item">
                        <span class="doc-item__label">{{ $doc['label'] }}</span>
                        @php $path = $application->{$doc['col']}; $ext = $path ? strtolower(pathinfo($path, PATHINFO_EXTENSION)) : ''; @endphp
                        @if($path)
                            @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                            <a href="{{ asset('storage/'.$path) }}" target="_blank" class="doc-preview">
                                <img src="{{ asset('storage/'.$path) }}" alt="{{ $doc['label'] }}">
                            </a>
                            @else
                            <a href="{{ asset('storage/'.$path) }}" target="_blank" style="font-size:.8rem; color:#016330; display:block; margin-bottom:8px;">
                                <i class="fa-solid fa-file me-1"></i> عرض الملف الحالي
                            </a>
                            @endif
                            <div class="doc-exists"><i class="fa-solid fa-check-circle me-1"></i>محفوظة</div>
                        @else
                            <div class="doc-missing"><i class="fa-solid fa-image me-1"></i>لا توجد صورة</div>
                        @endif
                        <input type="file" name="{{ $doc['field'] }}" class="form-control" accept="image/*,application/pdf" style="font-size:.82rem;">
                        @error($doc['field'])<div class="error-text">{{ $message }}</div>@enderror
                    </div>
                    @endforeach
                </div>
            </div>

            <div style="text-align:left;">
                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-floppy-disk me-2"></i> حفظ التعديلات
                </button>
            </div>

        </form>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
</body>
</html>
