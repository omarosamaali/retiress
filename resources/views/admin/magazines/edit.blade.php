@extends('layouts.admin')

@section('title', 'تعديل الإنجاز')
@section('page-title', 'تعديل الإنجاز')

@push('styles')
<style>
    .form-section {
        background: white;
        color: black;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .form-label {
        color: black;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .current-image {
        max-width: 200px;
        height: auto;
        border-radius: 8px;
        margin-top: 10px;
        border: 1px solid #ddd;
    }

    .sub-images-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .sub-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .preview-image {
        max-width: 150px;
        max-height: 150px;
        margin-top: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .btn-submit {
        background-color: #28a745;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: #218838;
    }

    .btn-back {
        background-color: #6c757d;
        color: white;
        padding: 12px 30px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        display: inline-block;
        margin-right: 10px;
        transition: background-color 0.3s;
    }

    .btn-back:hover {
        background-color: #5a6268;
        color: white;
        text-decoration: none;
    }

    .remove-image-container {
        margin-top: 10px;
    }

    .remove-checkbox {
        margin-right: 5px;
    }

    .text-danger {
        color: #dc3545 !important;
        font-size: 0.875em;
        margin-top: 5px;
    }

    .alert {
        padding: 12px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

</style>
@endpush

@section('content')
<div class="form-section">
    <h5 class="mb-4">
        <i class="fas fa-edit ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        تعديل الإنجاز: {{ $magazine->title_ar }}
    </h5>

    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.magazines.update', $magazine->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title_ar" class="form-label">عنوان الإنجاز (بالعربية)</label>
                    <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar', $magazine->title_ar) }}" required>
                    @error('title_ar')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label">حالة النشر</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="1" {{ old('status', $magazine->status) == '1' ? 'selected' : '' }}>نشط</option>
                        <option value="0" {{ old('status', $magazine->status) == '0' ? 'selected' : '' }}>غير نشط</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="main_image" class="form-label">الصورة الرئيسية</label>
                    <input type="file" class="form-control" name="main_image" id="main_image" accept="image/*">
                    @error('main_image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    @if($magazine->main_image)
                    <div class="current-image-container">
                        <p class="mb-1 mt-2"><strong>الصورة الحالية:</strong></p>
                        <img src="{{ asset('storage/' . $magazine->main_image) }}" alt="{{ $magazine->title_ar }}" class="current-image" id="current_main_image">
                        <div class="remove-image-container">
                            <input type="checkbox" class="form-check-input remove-checkbox" id="remove_main_image" name="remove_main_image" value="1">
                            <label class="form-check-label" for="remove_main_image">حذف الصورة الحالية</label>
                        </div>
                    </div>
                    @endif

                    <img id="main_image_preview" src="#" alt="معاينة الصورة" class="preview-image" style="display: none;">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="sub_images" class="form-label">الصور الفرعية</label>
                    <input type="file" class="form-control" name="sub_images[]" id="sub_images" accept="image/*" multiple>
                    @error('sub_images')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('sub_images.*')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">يمكنك اختيار أكثر من صورة (اختيار صور جديدة سيستبدل الصور الحالية)</small>

                    @if($magazine->sub_image)
                    @php
                    $subImages = json_decode($magazine->sub_image, true);
                    @endphp
                    @if(is_array($subImages) && count($subImages) > 0)
                    <div class="current-sub-images">
                        <p class="mb-1 mt-2"><strong>الصور الفرعية الحالية:</strong></p>
                        <div class="sub-images-container">
                            @foreach($subImages as $subImage)
                            <img src="{{ asset('storage/' . $subImage) }}" alt="صورة فرعية" class="sub-image">
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endif

                    <div id="sub_images_preview" class="mt-2"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="description_ar" class="form-label">وصف الإنجاز (بالعربية)</label>
                    <textarea class="form-control" id="description_ar" name="description_ar" rows="4" required>{{ old('description_ar', $magazine->description_ar) }}</textarea>
                    @error('description_ar')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('admin.magazines.index') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i>
                العودة للقائمة
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i>
                حفظ التعديلات
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // معاينة الصورة الرئيسية
        document.getElementById('main_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('main_image_preview');
            const currentImage = document.getElementById('current_main_image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if (currentImage) {
                        currentImage.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                if (currentImage) {
                    currentImage.style.display = 'block';
                }
            }
        });

        // معاينة الصور الفرعية
        document.getElementById('sub_images').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('sub_images_preview');
            previewContainer.innerHTML = '';

            if (files.length > 0) {
                const title = document.createElement('p');
                title.innerHTML = '<strong>معاينة الصور الجديدة:</strong>';
                title.className = 'mb-2 mt-2';
                previewContainer.appendChild(title);

                const imagesContainer = document.createElement('div');
                imagesContainer.className = 'sub-images-container';

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'sub-image';
                        img.alt = 'معاينة صورة فرعية';
                        imagesContainer.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                }

                previewContainer.appendChild(imagesContainer);
            }
        });

        // إخفاء الصورة الحالية عند اختيار حذفها
        const removeMainImageCheckbox = document.getElementById('remove_main_image');
        if (removeMainImageCheckbox) {
            removeMainImageCheckbox.addEventListener('change', function() {
                const currentImage = document.getElementById('current_main_image');
                if (currentImage) {
                    if (this.checked) {
                        currentImage.style.opacity = '0.3';
                    } else {
                        currentImage.style.opacity = '1';
                    }
                }
            });
        }
    });

</script>
@endsection
