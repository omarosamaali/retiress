@extends('layouts.admin')

@section('title', 'تعديل قسم العضوية')
@section('page-title', 'تعديل قسم العضوية')

@push('styles')
<style>
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

    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }

</style>
@endpush

@section('content')
<div class="add-section">
    <h5 class="mb-4">
        <i class="fas fa-edit ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        تعديل قسم العضوية
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

    <form action="{{ route('admin.membership.update', $membership) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="section" class="form-label font-bold">نوع القسم</label>
                    <select class="form-select" name="section" id="section" required>
                        <option value="" disabled>اختر نوع القسم</option>
                        <option value="membership_description" {{ old('section', $membership->section) == 'membership_description' ? 'selected' : '' }}>أنواع العضوية</option>
                        <option value="privileges" {{ old('section', $membership->section) == 'privileges' ? 'selected' : '' }}>شروط العضوية</option>
                        <option value="target_audience" {{ old('section', $membership->section) == 'target_audience' ? 'selected' : '' }}>امتيازات العضوية</option>
                        <option value="required_documents" {{ old('section', $membership->section) == 'required_documents' ? 'selected' : '' }}>خدمات الجمعية</option>
                        <option value="subscription_months" {{ old('section', $membership->section) == 'subscription_months' ? 'selected' : '' }}>امتيازات السفر والسياحة</option>
                        <option value="value" {{ old('section', $membership->section) == 'value' ? 'selected' : '' }}>تسهيلات الكليات والجامعات</option>
                        <option value="discount" {{ old('section', $membership->section) == 'discount' ? 'selected' : '' }}>خصومات استهلاكية</option>
                        <option value="docs" {{ old('section', $membership->section) == 'docs' ? 'selected' : '' }}>الوثائق المطلوبة</option>
                    </select>
                    @error('section')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title_ar" class="form-label font-bold">العنوان (بالعربية)</label>
                    <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar', $membership->title_ar) }}" required>
                    @error('title_ar')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="description_ar" class="form-label font-bold">الوصف (بالعربية)</label>
                    <textarea class="form-control" id="description_ar" name="description_ar" rows="4" required>{{ old('description_ar', $membership->description_ar) }}</textarea>
                    @error('description_ar')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="btn-section text-center">
            <a href="{{ route('admin.membership.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة للقائمة
            </a>
            <button type="submit" class="update-btn">
                <i class="fas fa-save ms-1"></i>
                تحديث القسم
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'هل أنت متأكد؟'
                , text: 'سيتم تحديث بيانات القسم.'
                , icon: 'question'
                , showCancelButton: true
                , confirmButtonText: 'تحديث'
                , cancelButtonText: 'إلغاء'
                , confirmButtonColor: '#28a745'
                , cancelButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

</script>
@endpush
