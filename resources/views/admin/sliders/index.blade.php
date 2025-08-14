@extends('layouts.admin')

@section('title', 'إدارة السلايدر')
@section('page-title', 'إدارة السلايدر')

@push('styles')
<style>
    /* Reuse the same styles from إدارة التواصل */
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

    .form-container {
        padding: 30px;
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

</style>
@endpush

@section('content')
<div class="container">
    <div class="header">
        <h1><i class="fas fa-sliders-h"></i> إدارة السلايدر</h1>
        <p>تحكم في محتوى السلايدر على الصفحة الرئيسية</p>
    </div>

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

    <div class="add-section">
        <a href="{{ route('sliders.create') }}" class="btn"><i class="fas fa-plus"></i> إضافة شريحة جديدة</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>النص (عربي)</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sliders as $slider)
                <tr>
                    <td>{{ Str::limit($slider->quote_ar, 50) }}</td>
                    <td>{{ $slider->is_active ? 'نشط' : 'غير نشط' }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> تعديل</a>
                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')"><i class="fas fa-trash"></i> حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
