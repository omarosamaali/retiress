@extends('layouts.admin')

@section('title', 'تفاصيل الخدمه')
@section('page-title', 'تفاصيل الخدمه')

@push('styles')
<style>
    .detail-section {
        background: white;
        color: black;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .detail-item {
        margin-bottom: 15px;
    }

    .detail-item strong {
        display: inline-block;
        width: 250px;
        color: black;
    }

    .detail-item span {
        color: black;
    }

    .detail-image {
        max-width: 200px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
    }

    .btn-section {
        margin-top: 20px;
        text-align: center;
    }

    .back-btn,
    .edit-btn {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        margin-left: 10px;
    }

    .back-btn {
        background-color: #6c757d;
    }

    .edit-btn {
        background-color: #28a745;
    }

    .back-btn:hover,
    .edit-btn:hover {
        opacity: 0.9;
    }

</style>
@endpush

@section('content')
<div class="detail-section">
    <h5 class="mb-4">
        <i class="fas fa-newspaper ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        تفاصيل الخدمه: {{ $service->name_ar }}
    </h5>
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <strong class="text-black">الإسم (عربي):</strong>
                <span>{{ $service->name_ar }}</span>
            </div>
            {{-- أضف هذا الجزء لعرض حالة العضوية --}}
            <div class="detail-item">
                <strong class="text-black">هل العضوية مطلوبة؟:</strong>
                <span>{{ $service->membership_required ? 'نعم' : 'لا' }}</span>
            </div>
            {{-- نهاية الجزء المضاف --}}
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="main_image_input" class="form-label font-bold">الصورة الرئيسية</label>
                @error('image')
                <div class="text-black">{{ $message }}</div>
                @enderror
                <img style="width: 200px;" id="image" src="{{ asset('storage/' . $service->image) }}" alt="معاينة الصورة الجديدة" class="about-preview mt-2">
            </div>
        </div>

        <div class="detail-item">
            <strong class="text-black">الجمهور المستهدف (عربي):</strong>
            <span>{{ $service->target_audience_ar }}</span>
        </div>
        <div class="detail-item">
            <strong class="text-black">الوصف (عربي):</strong>
            <span>{{ $service->description_ar }}</span>
        </div>
        <div class="detail-item">
            <strong class="text-black">الوثائق المطلوبه (عربي):</strong>
            <span>{{ $service->required_documents_ar }}</span>
        </div>
        <div class="detail-item">
            <strong class="text-black">ميثاق الخدمات (عربي):</strong>
            <span>{{ $service->service_charter_ar }}</span>
        </div>
        <div class="detail-item">
            <strong class="text-black">إخلاء المسؤولية (عربي):</strong>
            <span>{{ $service->disclaimer_ar }}</span>
        </div>
        <div class="detail-item">
            <strong class="text-black">قناة تقديم الخدمه (عربي):</strong>
            <span>{{ $service->chanel }}</span>
        </div>
        <div class="detail-item">
            <strong class="text-black">تاريخ الإضافة:</strong>
            <span>{{ $service->created_at ? $service->created_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
        </div>
        <div class="detail-item">
            <strong class="text-black">تاريخ آخر تحديث:</strong>
            <span>{{ $service->updated_at ? $service->updated_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
        </div>
        <div class="detail-item">
            <strong class="text-black">الحالة:</strong>
            <span class="badge text-white {{ $service->status_badge_class ?? ($service->status == 1 ? 'bg-success' : 'bg-danger') }}">
                {{ $service->status_text ?? ($service->status == 1 ? 'فعال' : 'غير فعال') }}
            </span>
        </div>
    </div>

    <div class="btn-section">
        <a href="{{ route('admin.services.index') }}" class="back-btn">
            <i class="fas fa-arrow-right ms-1"></i>
            العودة لقائمة الأخبار
        </a>
        <a href="{{ route('admin.services.edit', $service->id) }}" class="edit-btn">
            <i class="fas fa-edit ms-1"></i>
            تعديل الخدمه
        </a>
    </div>
</div>
@endsection
