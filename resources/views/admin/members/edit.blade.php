@extends('layouts.admin')

@section('title', 'تعديل صفحة معلومات عنا')
@section('page-title', 'تعديل صفحة معلومات عنا')

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
            border-color: #667eea;
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
            تعديل صفحة معلومات العضو: {{ $member->name_ar }}
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
        <form action="{{ route('admin.member.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name_ar" class="form-label font-bold">العنوان (بالعربية)</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar"
                            value="{{ old('name_ar', $member->name_ar) }}" required>
                        @error('name_ar')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="position_ar" class="form-label font-bold">الوصف (بالعربية)</label>
                        <textarea class="form-control" id="position_ar" name="position_ar" rows="4" required>{{ old('position_ar', $member->position_ar) }}</textarea>
                        @error('position_ar')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="councils" class="form-label font-bold">المجالس</label>
                        <select class="form-select" name="council_id" id="councils">
                            @foreach ($councils as $councils)
                                <option @selected($councils->id == old('council_id', $member->council_id)) value="{{ $councils->id }}">{{ $councils->name_ar }}</option>
                            @endforeach
                        </select>
                        @error('councils')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="committees" class="form-label font-bold">اللجان</label>
                        <select class="form-select" name="committee_id" id="committees">
                            @foreach ($committees as $committees)
                                <option @selected($committees->id == old('committee_id', $member->committee_id)) value="{{ $committees->id }}">{{ $committees->name_ar }}</option>
                            @endforeach
                        </select>
                        @error('committees')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image_input" class="form-label font-bold">الصورة الرئيسية</label>
                        <input type="file" class="form-control" name="image" id="image_input" accept="image/*">
                        @error('image')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                        @if ($member->image)
                            <img id="current_image_preview" src="{{ $member->image_url }}" alt="الصورة الحالية"
                                class="about-preview mt-2 p-2 current-image-preview">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_image"
                                    id="remove_image">
                                <label class="form-check-label text-black" for="remove_image">
                                    حذف الصورة الرئيسية الحالية
                                </label>
                            </div>
                        @endif
                        <img id="image_preview" src="#" alt="معاينة الصورة الجديدة" class="about-preview mt-2"
                            style="display: none;">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label font-bold">الحالة</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="1" {{ old('status', $member->status) == '1' ? 'selected' : '' }}>فعال
                            </option>
                            <option value="0" {{ old('status', $member->status) == '0' ? 'selected' : '' }}>غير
                                فعال</option>
                        </select>
                        @error('status')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <h6 class="mt-4 mb-3 text-black">الأسماء والأوصاف المترجمة (للقراءة فقط - تتحدث تلقائياً):</h6>
            <div class="row">
                @foreach ($targetLanguages as $code => $name)
                    <div class="col-md-12 mb-3 border rounded-lg p-2">
                        <label for="name_{{ $code }}" class="form-label font-bold">{{ $name }}
                            (العنوان)
                            :</label>
                        <span class="text-right">
                            {{ old('name_' . $code, $member->{'name_' . $code}) }}
                        </span>
                        <br>
                        <label for="position_{{ $code }}" class="form-label font-bold">{{ $name }}
                            (الوصف):</label>
                        <span class="text-right">
                            {{ old('position_' . $code, $member->{'position_' . $code}) }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="btn-section text-center">
                <a href="{{ route('admin.member.index') }}" class="back-btn">
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
