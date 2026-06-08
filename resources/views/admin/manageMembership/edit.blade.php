@extends('layouts.admin')

@section('title', 'تعديل طلب العضوية')
@section('page-title', 'تعديل طلب العضوية')

@push('styles')
<style>
    .experience-card {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef !important;
    }

    .experience-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
        border-color: #007bff !important;
    }

    .experience-number {
        position: absolute;
        top: -10px;
        right: 20px;
        z-index: 10;
    }

    .experience-number .badge {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }

    .form-control-plaintext {
        min-height: 38px;
        display: flex;
        align-items: center;
    }

    .section-header {
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }

    .no-data-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        border: 2px dashed #dee2e6;
    }

    .total-experience-summary {
        border-left: 4px solid #007bff;
    }

    @media (max-width: 768px) {
        .experience-number {
            position: relative;
            top: 0;
            right: 0;
            text-align: center;
            margin-bottom: 15px;
        }

        .experience-card {
            padding: 20px 15px !important;
        }
    }

</style>

<style>
    .images-upload {
        height: 200px;
        width: 200px;
        border-radius: 5px;
        padding: 3px;
        border: 3px solid green;
    }

    .add-section {
        background: white;
        color: black;
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

    .about-preview {
        max-width: 200px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
    }

    .translated-name-field {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        color: black;
    }

    .translated-name-field:focus {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: white;
    }

    .btn-section {
        margin-top: 20px;
    }

    .back-btn {
        background: #6c757d;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        margin-right: 10px;
        display: inline-block;
    }

    .back-btn:hover {
        background: #545b62;
        color: white;
    }

    .update-btn {
        background: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .update-btn:hover {
        background: #218838;
    }

</style>
@endpush

@section(section: 'content')
<div class="add-section">
    <h5 class="mb-4">
        <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        تعديل عضوية: {{ $member->full_name }}
    </h5>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form method="POST" action="{{ route('admin.manageMembership.update', $member->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="full_name" class="form-label font-bold">اسم العضو</label>
                    <input readonly type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $member->full_name) }}" required>
                    @error('full_name')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label font-bold">البريد الالكتروني </label>
                    <input readonly type="text" class="form-control" id="email" name="email" value="{{ old('email', $member->email) }}" required>
                    @error('email')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>

        <div class="row">
        </div>

        <div class="row" style="margin-top: 159px;">

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label font-bold">الحالة</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="" disabled>اختر...</option>
                        <option value="0" {{ old('status', $member->status) == '0' ? 'selected' : '' }}>بانتظار الدفع</option>
                        <option value="1" {{ old('status', $member->status) == '1' ? 'selected' : '' }}>بانتظار التفعيل</option>
                        <option value="2" {{ old('status', $member->status) == '2' ? 'selected' : '' }}>بانتظار الموافقة</option>
                        <option value="3" {{ old('status', $member->status) == '3' ? 'selected' : '' }}>فعال</option>
                        <option value="4" {{ old('status', $member->status) == '4' ? 'selected' : '' }}>منتهي</option>
                    </select> @error('status')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">

                <div class="mb-3">
                    <label for="membership_number" class="form-label font-bold">رقم العضوية </label>
                    <input readonly type="text" class="form-control" id="membership_number" name="membership_number" value="{{ old('membership_number', $member->membership_number) }}" required>
                    @error('membership_number')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="expiration_date" class="form-label font-bold">تاريخ إنتهاء العضوية</label>
                    <input type="datetime-local" class="form-control" id="expiration_date" name="expiration_date" value="{{ old('expiration_date', $member->expiration_date) }}" required>
                    @error('status')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
     <div class="col-md-6">
         <div class="mb-3">
             <label for="pension" class="form-label font-bold">جهة صرف المعاش التقاعدي</label>
  <select name="pension" id="pension" class="form-control">


                                  <option value="">{{ __('app.select') }}</option>
                                  <option value="pensions_and_social" {{ $member->pension == 'pensions_and_social' ? 'selected' : '' }}>{{ __('app.pensions_and_social') }}</option>
                                  <option value="sharjah_social" {{ $member->pension == 'sharjah_social' ? 'selected' : ''  }}>{{ __('app.sharjah_social') }}</option>
                                  <option value="dubai_social" {{ $member->pension == 'dubai_social' ? 'selected' : '' }}>{{ __('app.dubai_social') }}</option>
                                  <option value="pensions__social" {{ $member->pension == 'pensions__social' ? 'selected' : '' }}>{{ __('app.pensions__social') }}</option>
                                  <option value="ministry_of_defense" {{ $member->pension == 'ministry_of_defense' ? 'selected' : '' }}>{{ __('app.ministry_of_defense') }}</option>
                                  <option value="ministry_of_interior" {{ $member->pension == 'ministry_of_interior' ? 'selected' : '' }}>{{ __('app.ministry_of_interior') }}</option>
                                  <option value="police_dubai" {{ $member->pension == 'police_dubai' ? 'selected' : '' }}>{{ __('app.police_dubai') }}</option>


  </select> @error('pension')

             <div class="text-black">{{ $message }}</div>
             @enderror
         </div>
     </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nationality" class="form-label font-bold">الجنسية</label>
                    <input readonly type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $member->nationality) }}" required>
                    @error('nationality')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label font-bold">تاريخ الميلاد </label>
                    <input readonly type="text" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $member->date_of_birth ? $member->date_of_birth->format('Y-m-d') : '') }}" required>

                    @error('date_of_birth')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="mobile_phone" class="form-label font-bold">الهاتف المحمول</label>
                    <input readonly type="text" class="form-control" id="mobile_phone" name="mobile_phone" value="{{ old('mobile_phone', $member->mobile_phone) }}" required>
                    @error('mobile_phone')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="home_phone" class="form-label font-bold">هاتف المنزل </label>
                    <input readonly type="text" class="form-control" id="home_phone" name="home_phone" value="{{ old('home_phone', $member->home_phone) }}" required>
                    @error('home_phone')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="gender" class="form-label font-bold">النوع</label>
                    @php
                        $__gVal = old('gender', $member->gender);
                        $__gIsFemale = in_array($__gVal, ['female', 'انثي', 'أنثى', 'انثى']);
                    @endphp
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="ذكر" {{ !$__gIsFemale ? 'selected' : '' }}>ذكر</option>
                        <option value="انثي" {{ $__gIsFemale ? 'selected' : '' }}>انثى</option>
                    </select>
                    @error('gender')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="emirate" class="form-label font-bold">الإمارة</label>
                    @php $__emirate = old('emirate', $member->emirate); @endphp
                    <select class="form-control" name="emirate" id="emirate" required>
                        <option value="">اختر الإمارة...</option>
                        @foreach(['أبوظبي','دبي','الشارقة','عجمان','أم القيوين','رأس الخيمة','الفجيرة'] as $__em)
                        <option value="{{ $__em }}" {{ $__emirate == $__em ? 'selected' : '' }}>{{ $__em }}</option>
                        @endforeach
                        @if($__emirate && !in_array($__emirate, ['أبوظبي','دبي','الشارقة','عجمان','أم القيوين','رأس الخيمة','الفجيرة']))
                        <option value="{{ $__emirate }}" selected>{{ $__emirate }}</option>
                        @endif
                    </select>
                    @error('emirate')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="national_id" class="form-label font-bold">رقم الهوية</label>
                    <input readonly type="text" class="form-control" id="national_id" name="national_id" value="{{ old('national_id', $member->national_id) }}" required>
                    @error('national_id')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="educational_qualification" class="form-label font-bold">المؤهل التعليمي </label>
                    <input readonly type="text" class="form-control" id="educational_qualification" name="educational_qualification" value="{{ old('educational_qualification', $member->educational_qualification) }}" required>
                    @error('educational_qualification')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

{{-- ── قسم المستندات والصور ── --}}
<div style="margin-top:24px; margin-bottom:8px;">
    <h6 class="text-primary fw-bold" style="border-bottom:2px solid #0e6939; padding-bottom:6px;">
        <i class="fas fa-images me-2"></i> المستندات والصور
        <small class="text-muted fw-normal" style="font-size:.8rem; margin-right:8px;">اترك الحقل فارغاً للإبقاء على الصورة الحالية</small>
    </h6>
</div>

@php
$__docs = [
    ['field'=>'passport_photo',                   'col'=>'passport_photo_path',                   'label'=>'صورة الجواز'],
    ['field'=>'national_id_photo',                'col'=>'national_id_photo_path',                'label'=>'صورة الهوية الوطنية'],
    ['field'=>'personal_photo',                   'col'=>'personal_photo_path',                   'label'=>'الصورة الشخصية'],
    ['field'=>'educational_qualification_photo',  'col'=>'educational_qualification_photo_path',  'label'=>'صورة المؤهل التعليمي'],
    ['field'=>'retirement_card_photo',            'col'=>'retirement_card_photo_path',            'label'=>'صورة بطاقة التقاعد'],
    ['field'=>'front_id',                         'col'=>'front_id',                              'label'=>'وجه الهوية (Front ID)'],
    ['field'=>'back_id',                          'col'=>'back_id',                               'label'=>'ظهر الهوية (Back ID)'],
];
@endphp

<div class="row g-3" style="margin-bottom:20px;">
@foreach($__docs as $__doc)
<div class="col-md-6">
    <div class="p-3 border rounded" style="background:#fafafa;">
        <label class="form-label font-bold mb-2">{{ $__doc['label'] }}</label>
        @php $__path = $member->{$__doc['col']}; @endphp
        @if($__path)
        <div class="mb-2">
            @php $__ext = strtolower(pathinfo($__path, PATHINFO_EXTENSION)); @endphp
            @if(in_array($__ext, ['jpg','jpeg','png','gif','webp']))
            <a href="{{ asset('storage/' . $__path) }}" target="_blank" title="عرض الصورة بالحجم الكامل">
                <img src="{{ asset('storage/' . $__path) }}" alt="{{ $__doc['label'] }}"
                    style="height:130px; width:auto; max-width:100%; border-radius:6px; border:2px solid #0e6939; object-fit:cover; display:block;">
            </a>
            @else
            <a href="{{ asset('storage/' . $__path) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-file-pdf me-1"></i> عرض الملف
            </a>
            @endif
            <small class="text-success d-block mt-1"><i class="fas fa-check-circle me-1"></i>صورة محفوظة — ارفع جديدة للاستبدال</small>
        </div>
        @else
        <div class="mb-2">
            <span class="text-muted small"><i class="fas fa-image me-1 text-secondary"></i>لا توجد صورة</span>
        </div>
        @endif
        <input type="file" class="form-control form-control-sm" name="{{ $__doc['field'] }}" accept="image/*,application/pdf">
        @error($__doc['field'])
        <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
@endforeach
</div>

        <div class="row">
            @if($member->po_box)
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="po_box" class="form-label font-bold">صندوق البريد</label>
                    <input readonly type="text" class="form-control" id="po_box" name="po_box" value="{{ old('po_box', $member->po_box) }}" required>
                    @error('po_box')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @endif
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="retirement_date" class="form-label font-bold">تاريخ التقاعد</label>
                    <input type="datetime-local" class="form-control" id="retirement_date" name="retirement_date" value="{{ old('retirement_date', $member->retirement_date ? $member->retirement_date->format('Y-m-d\TH:i') : '') }}" required>
                    @error('retirement_date')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="contract_type" class="form-label font-bold">نوع التقاعد</label>
                    <input readonly type="text" class="form-control" id="contract_type" name="contract_type" value="{{ old('contract_type', $member->contract_type) }}" required>
                    @error('contract_type')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            @if($member->early_reason)
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="early_reason" class="form-label font-bold">تاريخ التقاعد </label>
                    <input readonly type="text" class="form-control" id="early_reason" name="early_reason" value="{{ old('early_reason', $member->early_reason) }}" required>
                    @error('early_reason')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @endif
        </div>
        @if($member->marital_status)
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="marital_status" class="form-label font-bold">الحالة الإجتماعية</label>
                    <div name="marital status" class="form-control">
                        @if($member->marital_status == 'single')
                        <div style="display:block !important; font-size: 15px; background-color: unset;">أعزب / عزباء</div>
                        @elseif($member->marital_status == 'married')
                        <div style="display:block !important; font-size: 15px; background-color: unset;">متزوج / متزوجات</div>
                        @elseif($member->marital_status == 'divorced')
                        <div style="display:block !important; font-size: 15px; background-color: unset;">مطلق / مطلقه</div>
                        @elseif($member->marital_status == 'widowed')
                        <div style="display:block !important; font-size: 15px; background-color: unset;">أرمل / أرملة</div>
                        @elseif($member->marital_status == 'separated')
                        <div style="display:block !important; font-size: 15px; background-color: unset;">منفصل / منفصلة</div>
                        @elseif($member->marital_status == 'engaged')
                        <div style="display:block !important; font-size: 15px; background-color: unset;">مخطوب / مخطوبة</div>
                        @endif
                        <input type="text" name="marital_status" value="{{ $member->marital_status }}" id="">
                    </div>

                    @error('marital_status')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        @endif

        <div class="section">
            <div class="section-header mb-4 d-flex align-items-center justify-content-between">
                <h5 class="text-primary mb-0">
                    <i class="fas fa-briefcase me-2"></i>
                    البيانات المهنية السابقة
                </h5>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addExperienceRow('prof-exp-container', 'professional_experiences')">
                    <i class="fas fa-plus me-1"></i> إضافة خبرة
                </button>
            </div>

            <div id="prof-exp-container">
                @php $profExps = (!empty($member->professional_experiences) && is_array($member->professional_experiences)) ? $member->professional_experiences : []; @endphp
                @forelse ($profExps as $index => $experience)
                <div class="experience-card mb-3 p-3 border rounded bg-white position-relative">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted"><i class="fas fa-calendar-alt me-1"></i>السنة</label>
                            <input type="text" class="form-control form-control-sm" name="professional_experiences[{{ $index }}][year]" value="{{ $experience['year'] ?? '' }}" placeholder="مثال: 2015">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted"><i class="fas fa-user-tie me-1"></i>المسمى الوظيفي</label>
                            <input type="text" class="form-control form-control-sm" name="professional_experiences[{{ $index }}][job_title]" value="{{ $experience['job_title'] ?? '' }}" placeholder="المسمى الوظيفي">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted"><i class="fas fa-building me-1"></i>جهة العمل</label>
                            <input type="text" class="form-control form-control-sm" name="professional_experiences[{{ $index }}][employer]" value="{{ $experience['employer'] ?? '' }}" placeholder="جهة العمل">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold text-muted"><i class="fas fa-clock me-1"></i>سنوات الخبرة</label>
                            <input type="text" class="form-control form-control-sm" name="professional_experiences[{{ $index }}][years_of_experience]" value="{{ $experience['years_of_experience'] ?? '' }}" placeholder="عدد السنوات">
                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeRow(this)" title="حذف">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted small" id="prof-exp-empty">لا توجد خبرات مهنية — اضغط "إضافة خبرة" لإضافة واحدة.</p>
                @endforelse
            </div>
        </div>

        <div class="section">
            <div class="section-header mb-4 d-flex align-items-center justify-content-between" style="margin-top:15px;">
                <h5 class="text-primary mb-0">
                    <i class="fas fa-history me-2"></i>
                    الخبرات السابقة
                </h5>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addExperienceRow('prev-exp-container', 'previous_experience')">
                    <i class="fas fa-plus me-1"></i> إضافة خبرة
                </button>
            </div>

            <div id="prev-exp-container">
                @php $prevExps = (!empty($member->previous_experience) && is_array($member->previous_experience)) ? $member->previous_experience : []; @endphp
                @forelse ($prevExps as $index => $experience)
                <div class="experience-card mb-3 p-3 border rounded bg-white position-relative">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted"><i class="fas fa-calendar-alt me-1"></i>السنة</label>
                            <input type="text" class="form-control form-control-sm" name="previous_experience[{{ $index }}][year]" value="{{ $experience['year'] ?? '' }}" placeholder="مثال: 2015">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted"><i class="fas fa-user-tie me-1"></i>المسمى الوظيفي</label>
                            <input type="text" class="form-control form-control-sm" name="previous_experience[{{ $index }}][job_title]" value="{{ $experience['job_title'] ?? '' }}" placeholder="المسمى الوظيفي">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted"><i class="fas fa-building me-1"></i>جهة العمل</label>
                            <input type="text" class="form-control form-control-sm" name="previous_experience[{{ $index }}][employer]" value="{{ $experience['employer'] ?? '' }}" placeholder="جهة العمل">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold text-muted"><i class="fas fa-clock me-1"></i>سنوات الخبرة</label>
                            <input type="text" class="form-control form-control-sm" name="previous_experience[{{ $index }}][years_of_experience]" value="{{ $experience['years_of_experience'] ?? '' }}" placeholder="عدد السنوات">
                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeRow(this)" title="حذف">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted small" id="prev-exp-empty">لا توجد خبرات سابقة — اضغط "إضافة خبرة" لإضافة واحدة.</p>
                @endforelse
            </div>
        </div>

        <div class="btn-section text-center">
            <a href="{{ route('admin.member.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة للقائمة
            </a>

            <button type="submit" class="update-btn">
                <i class="fas fa-save ms-1"></i>
                حفظ التعديلات
            </button>
        </div>
    </form>
</div>
@endsection

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.innerHTML = `
    <img src="${e.target.result}" alt="معاينة الصورة" class="img-fluid rounded" style="max-height: 200px; object-fit: contain;">
    `;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.addEventListener('DOMContentLoaded', function() {

        const mainImageInput = document.getElementById('image_input');
        const mainImagePreview = document.getElementById('image_preview');
        const currentMainImagePreview = document.getElementById('current_image_preview');
        const removeMainImageCheckbox = document.getElementById('remove_image');

        const subImageInput = document.getElementById('sub_image_input');
        const subImagePreview = document.getElementById('sub_image_preview');
        const currentSubImagePreview = document.getElementById('current_sub_image_preview');
        const removeSubImageCheckbox = document.getElementById('remove_sub_image');

        if (mainImageInput) {
            mainImageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        mainImagePreview.src = e.target.result;
                        mainImagePreview.style.display = 'block';
                        if (currentMainImagePreview) {
                            currentMainImagePreview.style.display = 'none';
                        }
                        if (removeMainImageCheckbox) {
                            removeMainImageCheckbox.checked = false;
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    mainImagePreview.src = '#';
                    mainImagePreview.style.display = 'none';
                    if (currentMainImagePreview && !removeMainImageCheckbox.checked) {
                        currentMainImagePreview.style.display = 'block';
                    }
                }
            });
        }

        if (removeMainImageCheckbox) {
            removeMainImageCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    if (currentMainImagePreview) {
                        currentMainImagePreview.style.display = 'none';
                    }
                    if (mainImagePreview) {
                        mainImagePreview.src = '#';
                        mainImagePreview.style.display = 'none';
                    }
                    if (mainImageInput) {
                        mainImageInput.value = '';
                    }
                } else {
                    if (currentMainImagePreview && currentMainImagePreview.src &&
                        currentMainImagePreview.src !== window.location.href) {
                        currentMainImagePreview.style.display = 'block';
                    }
                }
            });
        }

        if (subImageInput) {
            subImageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        subImagePreview.src = e.target.result;
                        subImagePreview.style.display = 'block';
                        if (currentSubImagePreview) {
                            currentSubImagePreview.style.display = 'none';
                        }
                        if (removeSubImageCheckbox) {
                            removeSubImageCheckbox.checked = false;
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    subImagePreview.src = '#';
                    subImagePreview.style.display = 'none';
                    if (currentSubImagePreview && !removeSubImageCheckbox.checked) {
                        currentSubImagePreview.style.display = 'block';
                    }
                }
            });
        }

        if (removeSubImageCheckbox) {
            removeSubImageCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    if (currentSubImagePreview) {
                        currentSubImagePreview.style.display = 'none';
                    }
                    if (subImagePreview) {
                        subImagePreview.src = '#';
                        subImagePreview.style.display = 'none';
                    }
                    if (subImageInput) {
                        subImageInput.value = '';
                    }
                } else {
                    if (currentSubImagePreview && currentSubImagePreview.src &&
                        currentSubImagePreview.src !== window.location.href) {
                        currentSubImagePreview.style.display = 'block';
                    }
                }
            });
        }
    });

    // ── Dynamic experience rows ───────────────────────────────────
    function addExperienceRow(containerId, fieldName) {
        var container = document.getElementById(containerId);
        // remove empty-state paragraph if present
        var empty = container.querySelector('p.text-muted');
        if (empty) empty.remove();

        var index = container.querySelectorAll('.experience-card').length;
        var html =
            '<div class="experience-card mb-3 p-3 border rounded bg-white position-relative">' +
            '  <div class="row g-2 align-items-end">' +
            '    <div class="col-md-3">' +
            '      <label class="form-label small fw-bold text-muted"><i class="fas fa-calendar-alt me-1"></i>السنة</label>' +
            '      <input type="text" class="form-control form-control-sm" name="' + fieldName + '[' + index + '][year]" placeholder="مثال: 2015">' +
            '    </div>' +
            '    <div class="col-md-3">' +
            '      <label class="form-label small fw-bold text-muted"><i class="fas fa-user-tie me-1"></i>المسمى الوظيفي</label>' +
            '      <input type="text" class="form-control form-control-sm" name="' + fieldName + '[' + index + '][job_title]" placeholder="المسمى الوظيفي">' +
            '    </div>' +
            '    <div class="col-md-3">' +
            '      <label class="form-label small fw-bold text-muted"><i class="fas fa-building me-1"></i>جهة العمل</label>' +
            '      <input type="text" class="form-control form-control-sm" name="' + fieldName + '[' + index + '][employer]" placeholder="جهة العمل">' +
            '    </div>' +
            '    <div class="col-md-2">' +
            '      <label class="form-label small fw-bold text-muted"><i class="fas fa-clock me-1"></i>سنوات الخبرة</label>' +
            '      <input type="text" class="form-control form-control-sm" name="' + fieldName + '[' + index + '][years_of_experience]" placeholder="عدد السنوات">' +
            '    </div>' +
            '    <div class="col-md-1 text-center">' +
            '      <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeRow(this)" title="حذف"><i class="fas fa-trash"></i></button>' +
            '    </div>' +
            '  </div>' +
            '</div>';

        container.insertAdjacentHTML('beforeend', html);
        renumberRows(container, fieldName);
    }

    function removeRow(btn) {
        var card = btn.closest('.experience-card');
        var container = card.parentElement;
        var fieldName = container.querySelector('input') ? container.querySelector('input').name.split('[')[0] : '';
        card.remove();
        renumberRows(container, fieldName);
    }

    function renumberRows(container, fieldName) {
        container.querySelectorAll('.experience-card').forEach(function(card, i) {
            card.querySelectorAll('input').forEach(function(input) {
                input.name = input.name.replace(/\[\d+\]/, '[' + i + ']');
            });
        });
    }

</script>
