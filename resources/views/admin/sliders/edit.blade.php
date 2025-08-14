@extends('layouts.admin')

@section('title', 'تعديل الشريحة')
@section('page-title', 'تعديل الشريحة')

@push('styles')
<style>
    /* Same styles as create.blade.php */
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
        <h1><i class="fas fa-edit"></i> تعديل الشريحة</h1>
        <p>قم بتحديث النص الخاص بالشريحة</p>
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

    <div class="form-container">
        <form method="POST" action="{{ route('sliders.update', $slider->id) }}">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i>
                    بيانات الشريحة
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-quote-right"></i> النص (عربي)</label>
                    <textarea class="form-input form-textarea" name="quote_ar" required>{{ $slider->quote_ar }}</textarea>
                    @error('quote_ar')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-toggle-on"></i> الحالة</label>
                    <select class="form-input" name="is_active">
                        <option value="1" {{ $slider->is_active ? 'selected' : '' }}>نشط</option>
                        <option value="0" {{ !$slider->is_active ? 'selected' : '' }}>غير نشط</option>
                    </select>
                    @error('is_active')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn"><i class="fas fa-save"></i> تحديث</button>
                <a href="{{ route('sliders.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-right"></i> رجوع</a>
            </div>
        </form>
    </div>
</div>
@endsection
