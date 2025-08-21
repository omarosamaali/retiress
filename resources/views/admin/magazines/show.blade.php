@extends('layouts.admin')

@section('title', 'تفاصيل المجلة')
@section('page-title', 'تفاصيل المجلة')

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

    .sub-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        margin: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        transition: transform 0.2s;
    }

    .sub-image:hover {
        transform: scale(1.1);
    }

    .sub-images-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
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

    /* Modal styles for image preview */
    .image-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        max-height: 80%;
        margin-top: 5%;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

</style>
@endpush

@section('content')
<div class="detail-section">
    <h5 class="mb-4">
        <i class="fas fa-book ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        تفاصيل المجلة: {{ $magazine->title_ar }}
    </h5>

    <div class="row">
        <div class="col-md-6">
            {{-- عرض اسم العضو مباشرةً --}}
            <div class="detail-item">
                <strong class="text-black">إسم العضو:</strong>
                <span>{{ $magazine->member ? $magazine->member->full_name : 'غير متوفر' }}</span>
            </div>
            <div class="detail-item">
                <strong class="text-black">عنوان المجلة (عربي):</strong>
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
                <span class="badge text-white {{ $magazine->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $magazine->status == 1 ? 'فعال' : 'غير فعال' }}
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <strong class="text-black">الصورة الرئيسية:</strong>
                @if ($magazine->main_image)
                <div>
                    <img src="{{ asset('storage/' . $magazine->main_image) }}" alt="{{ $magazine->title_ar }}" class="detail-image mt-2 main-image-preview">
                </div>
                @else
                <span>لا توجد صورة</span>
                @endif
            </div>

            <div class="detail-item">
                <strong class="text-black">الصور الفرعية:</strong>
                @if ($magazine->sub_image)
                @php
                $subImages = json_decode($magazine->sub_image, true);
                @endphp
                @if (is_array($subImages) && count($subImages) > 0)
                <div class="sub-images-container">
                    @foreach ($subImages as $subImage)
                    <img src="{{ asset('storage/' . $subImage) }}" alt="صورة فرعية" class="sub-image sub-image-preview">
                    @endforeach
                </div>
                <small class="text-muted">اضغط على الصورة للعرض بحجم أكبر</small>
                @else
                <span>لا توجد صور فرعية</span>
                @endif
                @else
                <span>لا توجد صور فرعية</span>
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
            العودة لقائمة الإنجازات
        </a>
        <a href="{{ route('admin.magazines.edit', $magazine->id) }}" class="edit-btn">
            <i class="fas fa-edit ms-1"></i>
            تعديل المجلة
        </a>
    </div>
</div>

<div id="imageModal" class="image-modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get modal elements
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        const closeBtn = document.getElementsByClassName('close')[0];

        // Add click event to all preview images
        const previewImages = document.querySelectorAll('.main-image-preview, .sub-image-preview');

        previewImages.forEach(function(img) {
            img.addEventListener('click', function() {
                modal.style.display = 'block';
                modalImg.src = this.src;
            });
        });

        // Close modal when clicking the X
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Close modal when clicking outside the image
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

</script>
@endpush
