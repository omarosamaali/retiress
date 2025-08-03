@extends('layouts.admin')

@section('title', 'تفاصيل الخبر')
@section('page-title', 'تفاصيل الخبر')

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
            width: 150px;
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
            تفاصيل الخبر: {{ $magazine->title_ar }}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">العنوان (عربي):</strong>
                    <span>{{ $magazine->title_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الوصف (عربي):</strong>
                    <span>{{ $magazine->description_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong>
                    <span>{{ $magazine->created_at ? $magazine->created_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong>
                    <span>{{ $magazine->updated_at ? $magazine->updated_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong>
                    <span class="badge text-white {{ $magazine->status_badge_class ?? ($magazine->status == 1 ? 'bg-success' : 'bg-danger') }}">
                        {{ $magazine->status_text ?? ($magazine->status == 1 ? 'فعال' : 'غير فعال') }}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">الصورة الرئيسية:</strong>
                    @if ($magazine->main_image)
                        <img src="{{ $magazine->main_image_url }}" alt="{{ $magazine->title_ar }}" class="p-3 detail-image mt-2">
                    @else
                        <span>لا توجد صورة</span>
                    @endif
                </div>

                </div>
                <div>
                    @if ($magazine->pdf)
                        <a href="{{ $magazine->pdf_url }}" class="btn btn-success mt-2" download>تحميل ال pdf</a>
                    @else
                        <span>لا يوجد ملف PDF</span>
                    @endif
                </div>
            </div>
        </div>

        <h6 class="mt-4 mb-3">الأسماء والأوصاف المترجمة:</h6>
        <div class="row">
            @foreach ($targetLanguages as $code => $name)
                @php
                    $titleColumn = 'title_' . $code;
                    $descColumn = 'description_' . $code;
                    $translatedTitle = $magazine->$titleColumn;
                    $translatedDesc = $magazine->$descColumn;
                @endphp
                @if ($translatedTitle || $translatedDesc)
                    <div class="col-md-12 mb-3">
                        <div class="detail-item border rounded-lg p-2">
                            <strong class="text-black">{{ $name }} (العنوان):</strong>
                            <span>{{ $translatedTitle ?? 'غير متوفر' }}</span>
                            <br>
                            <strong class="text-black">{{ $name }} (الوصف):</strong>
                            <span>{{ $translatedDesc ?? 'غير متوفر' }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="btn-section">
            <a href="{{ route('admin.magazines.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة الأخبار
            </a>
            <a href="{{ route('admin.magazines.edit', $magazine->id) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل الخبر
            </a>
        </div>
    </div>
@endsection
