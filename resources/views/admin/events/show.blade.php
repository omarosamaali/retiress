@extends('layouts.admin')

@section('title', 'تفاصيل الإعلان')
@section('page-title', 'تفاصيل الإعلان')

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
            تفاصيل الإعلان: {{ $event->title_ar }}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">العنوان (عربي):</strong>
                    <span>{{ $event->title_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">النوع:</strong>
                    <span class="badge bg-secondary">{{ $event->type_label }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الفئة المستهدفة:</strong>
                    <span class="badge {{ $event->isForMembersOnly() ? 'bg-info' : 'bg-dark' }}">{{ $event->audience_label }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الوصف (عربي):</strong>
                    <div style="line-height:1.8; padding:8px 0;">{!! $event->description_ar !!}</div>
                </div>
                <div class="detail-item">
                    <strong class="text-black">{{ __('app.event_starts_at') }}:</strong>
                    <span>{{ $event->display_starts_at ? $event->display_starts_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">{{ __('app.event_ends_at') }}:</strong>
                    <span>{{ $event->display_ends_at ? $event->display_ends_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">السعر:</strong>
                    <span>{{ $event->isFree() ? __('app.free_event') : number_format((float) $event->price, 2) . ' ' . __('app.aed') }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong>
                    <span>{{ $event->created_at ? $event->created_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong>
                    <span>{{ $event->updated_at ? $event->updated_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong>
                    <span
                        class="badge text-white {{ $event->status_badge_class ?? ($event->status == 1 ? 'bg-success' : 'bg-danger') }}">
                        {{ $event->status_text ?? ($event->status == 1 ? 'فعال' : 'غير فعال') }}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">الصورة الرئيسية:</strong>
                    @if ($event->main_image)
                        <img src="{{ $event->main_image_url }}" alt="{{ $event->title_ar }}"
                            class="p-3 detail-image mt-2">
                    @else
                        <span>لا توجد صورة</span>
                    @endif
                </div>
                <div class="detail-item">
                    <strong class="text-black">الصورة الفرعية:</strong>
                    @if ($event->sub_image)
                        <img src="{{ $event->sub_image_url }}" alt="{{ $event->title_ar }}"
                            class="p-3 detail-image mt-2">
                    @else
                        <span>لا توجد صورة</span>
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
                    $translatedTitle = $event->$titleColumn;
                    $translatedDesc = $event->$descColumn;
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
        @include('admin.events.partials.subscribers-table', [
            'filterBaseUrl' => route('admin.event.show', $event),
        ])

        <div class="btn-section">
            <a href="{{ route('admin.event.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة الأخبار
            </a>
            <a href="{{ route('admin.event.edit', $event->id) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل الإعلان
            </a>
        </div>
    </div>
@endsection