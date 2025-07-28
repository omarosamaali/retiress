@extends('layouts.admin')

@section('title', 'عرض تفاصيل قسم العضوية')
@section('page-title', 'عرض تفاصيل قسم العضوية')

@push('styles')
<style>
    .show-section {
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

    .edit-btn {
        background: #ffc107;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        margin-right: 10px;
        display: inline-block;
    }

    .edit-btn:hover {
        background: #e0a800;
        color: white;
    }

    .delete-btn {
        background: #dc3545;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .delete-btn:hover {
        background: #c82333;
    }

    .detail-label {
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .detail-value {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        word-break: break-word;
    }

</style>
@endpush

@section('content')
<div class="show-section">
    <h5 class="mb-4">
        <i class="fas fa-eye ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        تفاصيل قسم العضوية
    </h5>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <div class="detail-label">نوع القسم</div>
                <div class="detail-value">
                    @php
                    $sectionTypes = [
                    'membership_description' => 'وصف العضوية',
                    'privileges' => 'امتيازات العضوية',
                    'target_audience' => 'الجمهور المستهدف',
                    'required_documents' => 'الوثائق المطلوبة',
                    'subscription_months' => 'عدد أشهر الاشتراك',
                    'value' => 'القيمة',
                    'saudi_arabia' => 'المملكة العربية السعودية',
                    'egypt' => 'مصر',
                    'united_arab_emirates' => 'الإمارات العربية المتحدة',
                    'kuwait' => 'الكويت',
                    'qatar' => 'قطر',
                    'jordan' => 'الأردن',
                    ];
                    @endphp
                    {{ $sectionTypes[$membership->section] ?? $membership->section }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <div class="detail-label">العنوان (بالعربية)</div>
                <div class="detail-value">{{ $membership->title_ar ?? 'لا يوجد عنوان' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <div class="detail-label">الوصف (بالعربية)</div>
                <div class="detail-value">{{ $membership->description_ar ?? 'لا يوجد وصف' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <div class="detail-label">العنوان (بالإنجليزية)</div>
                <div class="detail-value">{{ $membership->title_en ?? 'لا يوجد عنوان' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <div class="detail-label">الوصف (بالإنجليزية)</div>
                <div class="detail-value">{{ $membership->description_en ?? 'لا يوجد وصف' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <div class="detail-label">تاريخ الإضافة</div>
                <div class="detail-value">{{ optional($membership->created_at)->format('d/m/Y') ?? 'غير متوفر' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <div class="detail-label">تاريخ التحديث</div>
                <div class="detail-value">{{ optional($membership->updated_at)->format('d/m/Y') ?? 'غير متوفر' }}</div>
            </div>
        </div>
    </div>

    <div class="btn-section text-center">
        <a href="{{ route('admin.membership.index') }}" class="back-btn">
            <i class="fas fa-arrow-right ms-1"></i>
            العودة للقائمة
        </a>
        <a href="{{ route('admin.membership.edit', $membership) }}" class="edit-btn">
            <i class="fas fa-edit ms-1"></i>
            تعديل القسم
        </a>
        <button class="delete-btn" onclick="confirmDelete('memberships', {{ $membership->id }})">
            <i class="fas fa-trash ms-1"></i>
            حذف القسم
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(type, id) {
        Swal.fire({
            title: 'تأكيد الحذف'
            , text: 'هل أنت متأكد من حذف هذا القسم؟'
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonText: 'حذف'
            , cancelButtonText: 'إلغاء'
            , confirmButtonColor: '#dc3545'
            , cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/${type}/${id}`;
                form.style.display = 'none';

                const methodInput = document.createElement('input');
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                const csrfInput = document.createElement('input');
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

</script>
@endpush
