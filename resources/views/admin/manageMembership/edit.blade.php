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
            <div class="col-md-6">
                <div class="mb-3">

                    <label for="front_id" class="form-label font-bold">صورة البطاقة من الأمام</label>
                    <input type="file" class="form-control" id="front_id" name="front_id" value="{{ old('front_id', $member->front_id) }}" accept="image/*" onchange="previewImage(this, 'front_preview')">
                    @error('front_id')
                    <div class="text-black">{{ $message }}</div>
                    @enderror

                    <!-- مربع معاينة الصورة الأمامية -->
                    <div class="mt-3">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-3 text-center" style="min-height: 200px; background-color: #f9f9f9;">
                            @if(isset($member->front_id) && $member->front_id)
                            <img id="front_preview" src="{{ asset('storage/' . $member->front_id) }}" alt="صورة البطاقة من الأمام" class="img-fluid rounded" style="max-height: 200px; object-fit: contain;">
                            @else
                            <div id="front_preview" class="d-flex align-items-center justify-content-center h-100">
                                <div class="text-muted">
                                    <i class="fas fa-image fa-3x mb-2 d-block"></i>
                                    <span>معاينة صورة البطاقة من الأمام</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="back_id" class="form-label font-bold">صورة البطاقة من الخلف</label>
                    <input type="file" class="form-control" id="back_id" name="back_id" value="{{ old('back_id', $member->back_id) }}" accept="image/*" onchange="previewImage(this, 'back_preview')">
                    @error('back_id')
                    <div class="text-black">{{ $message }}</div>
                    @enderror

                    <!-- مربع معاينة الصورة الخلفية -->
                    <div class="mt-3">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-3 text-center" style="min-height: 200px; background-color: #f9f9f9;">
                            @if(isset($member->back_id) && $member->back_id)
                            <img id="back_preview" src="{{ asset('storage/' . $member->back_id) }}" alt="صورة البطاقة من الخلف" class="img-fluid rounded" style="max-height: 200px; object-fit: contain;">
                            @else
                            <div id="back_preview" class="d-flex align-items-center justify-content-center h-100">
                                <div class="text-muted">
                                    <i class="fas fa-image fa-3x mb-2 d-block"></i>
                                    <span>معاينة صورة البطاقة من الخلف</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 159px;">

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label font-bold">الحالة</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" disabled selected>اختر...</option>
                        <option value="0" {{ $member->status == 0 ? 'selected' : '' }}>بانتظار الدفع</option>
                        <option value="1" {{ $member->status == 1 ? 'selected' : '' }}>بانتظار التفعيل</option>
                        <option value="2" {{ $member->status == 2 ? 'selected' : '' }}>بانتظار الموافقة</option>
                        <option value="3" {{ $member->status == 3 ? 'selected' : '' }}>فعال</option>
                        <option value="3" {{ $member->status == 4 ? 'selected' : '' }}>منتهي</option>
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
                    <input readonly type="text" class="form-control" id="gender_display" value="{{ old('gender', $member->gender == 'female' ? 'انثي' : 'ذكر') }}" required>

                    <input type="hidden" name="gender" value="{{ $member->gender }}">


                    @error('gender')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="emirate" class="form-label font-bold">الاماره </label>
                    <input readonly type="text" class="form-control" id="emirate" name="emirate" value="{{ old('emirate', $member->emirate) }}" required>
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

{{-- 💡 ملاحظة: يجب أن تتحقق من كل مسار باستخدام @if قبل عرض الـ div بالكامل --}}

<div class="row">
    {{-- عرض صورة الجواز --}}
    @if ($member->passport_photo_path)
    <div class="col-md-6">
        <div class="mb-3">
            <label for="passport_photo_path" class="form-label font-bold">صورة الجواز</label>
            {{-- تحقق إضافي لتجنب أخطاء asset() إذا كان المسار فارغاً --}}
            <img class="images-upload" src="{{ asset('storage/' . $member->passport_photo_path) }}"
                alt="Passport Photo" />
            @error('passport_photo_path')
            <div class="text-black">{{ $message }}</div>
            @enderror
        </div>
    </div>
    @endif

    {{-- عرض صورة الهوية --}}
    @if ($member->national_id_photo_path)
    <div class="col-md-6">
        <div class="mb-3">
            <label for="national_id_photo_path" class="form-label font-bold">صورة الهوية</label>
            <img class="images-upload" src="{{ asset('storage/' . $member->national_id_photo_path) }}"
                alt="National ID Photo" />
            @error('national_id_photo_path')
            <div class="text-black">{{ $message }}</div>
            @enderror
        </div>
    </div>
    @endif
</div>

<div class="row">
    {{-- عرض صورة المؤهل --}}
    @if ($member->educational_qualification_photo_path)
    <div class="col-md-6">
        <div class="mb-3">
            <label for="educational_qualification_photo_path" class="form-label font-bold">صورة المؤهل</label>
            <img class="images-upload" src="{{ asset('storage/' . $member->educational_qualification_photo_path) }}"
                alt="Educational Qualification Photo" />
            @error('educational_qualification_photo_path')
            <div class="text-black">{{ $message }}</div>
            @enderror
        </div>
    </div>
    @endif

    {{-- عرض الصورة الشخصية --}}
    @if ($member->personal_photo_path)
    <div class="col-md-6">
        <div class="mb-3">
            <label for="personal_photo_path" class="form-label font-bold">الصورة الشخصية</label>
            <img class="images-upload" src="{{ asset('storage/' . $member->personal_photo_path) }}"
                alt="Personal Photo" />
            @error('personal_photo_path')
            <div class="text-black">{{ $message }}</div>
            @enderror
        </div>
    </div>
    @endif
</div>

<div class="row">
    {{-- عرض صورة بطاقة التقاعد --}}
    @if ($member->retirement_card_photo_path)
    <div class="col-md-6">
        <div class="mb-3">
            <label for="retirement_card_photo_path" class="form-label font-bold">صورة بطاقة التقاعد</label>
            <img class="images-upload" src="{{ asset('storage/' . $member->retirement_card_photo_path) }}"
                alt="Retirement Card Photo" />
            @error('retirement_card_photo_path')
            <div class="text-black">{{ $message }}</div>
            @enderror
        </div>
    </div>
    @endif
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
                        <input type="text" hidden name="marital_status" value="{{ $member->marital_status }}" id="">
                    </div>

                    @error('marital_status')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        @endif

        <div class="section">
            <div class="section-header mb-4">
                <h5 class="text-primary mb-0">
                    <i class="fas fa-briefcase me-2"></i>
                    البيانات المهنية السابقة </h5>

            </div>

            @if ($member && !empty($member->professional_experiences) && is_array($member->professional_experiences))
            <div class="experiences-container">
                @foreach ($member->professional_experiences as $index => $experience)
                <div class="experience-card mb-4 p-4 border rounded-lg shadow-sm bg-white position-relative">
                    <div class="experience-number">
                        {{-- <span class="badge bg-primary rounded-circle p-2">{{ $index + 1 }}</span> --}}
                        <span class="badge bg-primary rounded-circle p-2">{{ (int)$index + 1 }}</span>
                    </div>
                    <div class="experience-content">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-muted small fw-bold">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        السنة
                                    </label>
                                    <div class="form-control-plaintext bg-light rounded p-2 border">
                                        <strong class="text-dark">{{ $experience['year'] ?? 'غير محدد' }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-muted small fw-bold">
                                        <i class="fas fa-user-tie me-1"></i>
                                        المسمى الوظيفي
                                    </label>
                                    <div class="form-control-plaintext bg-light rounded p-2 border">
                                        <strong class="text-dark">{{ $experience['job_title'] ?? 'غير محدد' }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-muted small fw-bold">
                                        <i class="fas fa-building me-1"></i>
                                        جهة العمل
                                    </label>
                                    <div class="form-control-plaintext bg-light rounded p-2 border">
                                        <strong class="text-dark">{{ $experience['employer'] ?? 'غير محدد' }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-muted small fw-bold">
                                        <i class="fas fa-clock me-1"></i>
                                        سنوات الخبرة
                                    </label>
                                    <div class="form-control-plaintext bg-light rounded p-2 border">
                                        <strong class="text-primary">{{ $experience['years_of_experience'] ?? 'غير محدد' }} سنة</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!$loop->last)
                    <div class="experience-separator mt-3">
                        <hr class="border-primary opacity-25">
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="total-experience-summary mt-4 p-3 bg-primary bg-opacity-10 rounded-lg border border-primary border-opacity-25">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="text-primary mb-1">
                            <i class="fas fa-chart-line me-2"></i>
                            إجمالي الخبرات المهنية
                        </h6>
                        <small class="text-muted">عدد الخبرات المسجلة</small>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge bg-primary fs-6 p-2">
                            {{ count($member->professional_experiences) }} خبرة
                        </span>
                    </div>
                </div>
            </div>
            @else
            <div class="no-data-container text-center py-5">
                <div class="no-data-icon mb-3">
                    <i class="fas fa-briefcase text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h6 class="text-muted mb-2">لا توجد خبرات مهنية</h6>
                <p class="text-muted small mb-0">لم يتم إضافة أي خبرات مهنية بعد</p>
            </div>
            @endif
        </div>

        <div class="section">
            <div class="section-header mb-4">
                <h5 class="text-primary mb-0" style="margin-top: 15px;">
                    <i class="fas fa-history me-2"></i>
                    الخبرات السابقة
                </h5>
            </div>

            @if ($member && !empty($member->previous_experience))
            <div class="experiences-container">
                @foreach ($member->previous_experience as $index => $experience)
                <div class="experience-card mb-4 p-4 border rounded-lg shadow-sm bg-white position-relative">
                    <div class="experience-number">
                        {{-- <span class="badge bg-primary rounded-circle p-2">{{ $index + 1 }}</span> --}}
                        <span class="badge bg-primary rounded-circle p-2">{{ (int)$index + 1 }}</span>
                    </div>
                    <div class="experience-content">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-muted small fw-bold">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        السنة
                                    </label>
                                    <div class="form-control-plaintext bg-light rounded p-2 border">
                                        <strong class="text-dark">{{ $experience['year'] ?? 'غير محدد' }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-muted small fw-bold">
                                        <i class="fas fa-user-tie me-1"></i>
                                        المسمى الوظيفي
                                    </label>
                                    <div class="form-control-plaintext bg-light rounded p-2 border">
                                        <strong class="text-dark">{{ $experience['job_title'] ?? 'غير محدد' }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-muted small fw-bold">
                                        <i class="fas fa-building me-1"></i>
                                        جهة العمل
                                    </label>
                                    <div class="form-control-plaintext bg-light rounded p-2 border">
                                        <strong class="text-dark">{{ $experience['employer'] ?? 'غير محدد' }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-muted small fw-bold">
                                        <i class="fas fa-clock me-1"></i>
                                        سنوات الخبرة
                                    </label>
                                    <div class="form-control-plaintext bg-light rounded p-2 border">
                                        <strong class="text-primary">{{ $experience['years_of_experience'] ?? 'غير محدد' }} سنة</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!$loop->last)
                    <div class="experience-separator mt-3">
                        <hr class="border-primary opacity-25">
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- إجمالي سنوات الخبرة -->
            <div class="total-experience-summary mt-4 p-3 bg-primary bg-opacity-10 rounded-lg border border-primary border-opacity-25">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="text-primary mb-1">
                            <i class="fas fa-chart-line me-2"></i>
                            إجمالي الخبرات السابقة
                        </h6>
                        <small class="text-muted">عدد الخبرات المسجلة سابقاً</small>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge bg-primary fs-6 p-2">
                            {{ count($member->previous_experience) }} خبرة
                        </span>
                    </div>
                </div>
            </div>

            @else
            <!-- حالة عدم وجود بيانات -->
            <div class="no-data-container text-center py-5">
                <div class="no-data-icon mb-3">
                    <i class="fas fa-history text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h6 class="text-muted mb-2">لا توجد خبرات سابقة</h6>
                <p class="text-muted small mb-0">لم يتم إضافة أي خبرات سابقة بعد</p>
            </div>
            @endif
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

</script>
