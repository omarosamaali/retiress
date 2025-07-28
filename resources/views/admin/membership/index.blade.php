@extends('layouts.admin')

@section('title', 'إدارة بيانات العضوية')
@section('page-title', 'إدارة بيانات العضوية')

@push('styles')
<style>
    .add-section {
        background: linear-gradient(135deg, #0e6939 0%, #0e6939 100%);
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
        margin-bottom: 30px;
    }

    .action-buttons .btn {
        padding: 5px 10px;
        font-size: 12px;
        margin: 0 2px;
    }

</style>
@endpush

@section('content')
{{-- رسائل Success/Error --}}
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

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-dark">إدارة بيانات العضوية</h6>
        <a href="{{ route('admin.membership.create') }}" class="btn btn-success btn-sm">إضافة قسم جديد</a>
    </div>
    <div class="card-body">
        @if ($sections->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>القسم</th>
                        <th>تاريخ الإضافة</th>
                        <th>العنوان (عربي)</th>
                        <th>الوصف (عربي)</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->id }}</td>
                        <td>
                            @php
                            $sectionTypes = [
                            'membership_description' => 'وصف العضوية',
                            'privileges' => 'امتيازات العضوية',
                            'target_audience' => 'الجمهور المستهدف',
                            'required_documents' => 'الوثائق المطلوبة',
                            'subscription_months' => 'عدد أشهر الاشتراك',
                            'value' => 'القيمة',

                            ];
                            @endphp
                            {{ $sectionTypes[$section->section] ?? $section->section }}
                        </td>

                        <td>{{ optional($section->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                        <td>{{ $section->title_ar ?? 'لا يوجد عنوان' }}</td>
                        <td>{{ Str::limit($section->description_ar, 50) }}</td>

                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.membership.show', $section) }}" class="btn btn-info btn-sm" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.membership.edit', $section) }}" class="btn btn-warning btn-sm" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete('memberships', {{ $section->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2">لا توجد بيانات للأقسام. يرجى <a href="{{ route('admin.membership.create') }}">إضافة الآن</a></p>
        </div>
        @endif
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
