@extends('layouts.admin')

@section('title', 'إضافة مجلس')
@section('page-title', 'إضافة مجلس')

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

    .about-preview {
        max-width: 200px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
    }

    .translated-name-field {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        color: black;
    }

    .translated-name-field:focus {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: white;
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

</style>
@endpush

@section('content')
<div class="add-section">
    <h5 class="mb-4">
        <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        إضافة مجلس
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

    <form action="{{ route('admin.council.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name_ar" class="form-label font-bold">العنوان (بالعربية)</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ old('name_ar') }}" required>
                    @error('name_ar')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="description_ar" class="form-label font-bold">الوصف (بالعربية)</label>
                    <textarea class="form-control" id="description_ar" name="description_ar" rows="4" required>{{ old('description_ar') }}</textarea>
                    @error('description_ar')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="image" class="form-label font-bold">الصورة</label>
                    <input type="file" class="form-control" id="image_input" name="image" value="{{ old('image') }}">
                    <img id="image_preview" src="#" alt="معاينة الصورة الجديدة" class="about-preview mt-2" style="display: none;"> @error('image')

                    <div class="text-black">{{ $message }}</div>
                    @enderror
                    <img id="image_preview" src="#" alt="معاينة الصورة الجديدة" class="about-preview mt-2" style="display: none;">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label font-bold">الحالة</label>
                    <select class="form-select" name="status" id="status" required>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>غير فعال</option>
                    </select>
                    @error('status')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="btn-section text-center">
            <a href="{{ route('admin.council.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة للقائمة
            </a>

            <button type="submit" class="update-btn">
                <i class="fas fa-save ms-1"></i>
                حفظ التعديلات
            </button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImageInput = document.getElementById('image_input');
        const mainImagePreview = document.getElementById('image_preview');
        const currentMainImagePreview = document.getElementById('current_image_preview');
        const removeMainImageCheckbox = document.getElementById('remove_image');

        const subImageInput = document.getElementById('sub_image_input');
        const subImagePreview = document.getElementById('sub_image_preview');
        const currentSubImagePreview = document.getElementById('current_sub_image_preview');
        const removeSubImageCheckbox = document.getElementById('remove_sub_image');

        if (mainImageInput) {
            mainImageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        mainImagePreview.src = e.target.result;
                        mainImagePreview.style.display = 'block';
                        if (currentMainImagePreview) {
                            currentMainImagePreview.style.display = 'none';
                        }
                        if (removeMainImageCheckbox) {
                            removeMainImageCheckbox.checked = false;
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    mainImagePreview.src = '#';
                    mainImagePreview.style.display = 'none';
                    if (currentMainImagePreview && !removeMainImageCheckbox.checked) {
                        currentMainImagePreview.style.display = 'block';
                    }
                }
            });
        }

        if (removeMainImageCheckbox) {
            removeMainImageCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    if (currentMainImagePreview) {
                        currentMainImagePreview.style.display = 'none';
                    }
                    if (mainImagePreview) {
                        mainImagePreview.src = '#';
                        mainImagePreview.style.display = 'none';
                    }
                    if (mainImageInput) {
                        mainImageInput.value = '';
                    }
                } else {
                    if (currentMainImagePreview && currentMainImagePreview.src &&
                        currentMainImagePreview.src !== window.location.href) {
                        currentMainImagePreview.style.display = 'block';
                    }
                }
            });
        }

        if (subImageInput) {
            subImageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        subImagePreview.src = e.target.result;
                        subImagePreview.style.display = 'block';
                        if (currentSubImagePreview) {
                            currentSubImagePreview.style.display = 'none';
                        }
                        if (removeSubImageCheckbox) {
                            removeSubImageCheckbox.checked = false;
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    subImagePreview.src = '#';
                    subImagePreview.style.display = 'none';
                    if (currentSubImagePreview && !removeSubImageCheckbox.checked) {
                        currentSubImagePreview.style.display = 'block';
                    }
                }
            });
        }

        if (removeSubImageCheckbox) {
            removeSubImageCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    if (currentSubImagePreview) {
                        currentSubImagePreview.style.display = 'none';
                    }
                    if (subImagePreview) {
                        subImagePreview.src = '#';
                        subImagePreview.style.display = 'none';
                    }
                    if (subImageInput) {
                        subImageInput.value = '';
                    }
                } else {
                    if (currentSubImagePreview && currentSubImagePreview.src &&
                        currentSubImagePreview.src !== window.location.href) {
                        currentSubImagePreview.style.display = 'block';
                    }
                }
            });
        }
    });

</script>
@endpush

