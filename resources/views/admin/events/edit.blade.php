@extends('layouts.admin')

@section('title', 'تعديل الإعلان')
@section('page-title', 'تعديل الإعلان')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    .ql-wrapper { border-radius: 8px; overflow: hidden; border: 2px solid #dee2e6; background: #fff; }
    .ql-toolbar.ql-snow { direction: ltr; background: #f8f9fa; border: none; border-bottom: 1px solid #dee2e6; padding: 8px 10px; }
    .ql-toolbar.ql-snow .ql-picker-label, .ql-toolbar.ql-snow button { color: #212529; }
    .ql-toolbar.ql-snow .ql-stroke { stroke: #212529; }
    .ql-toolbar.ql-snow .ql-fill { fill: #212529; }
    .ql-container.ql-snow { border: none; background: #fff; }
    .ql-editor { min-height: 160px; font-family: 'Cairo', sans-serif; font-size: 1rem; direction: rtl; text-align: right; color: #212529; padding: 12px 15px; }
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

    .news-preview {
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
        <i class="fas fa-newspaper ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        تعديل الإعلان: {{ $event->title_ar }}
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

    <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title_ar" class="form-label font-bold">عنوان الإعلان (بالعربية)</label>
                    <input type="text" class="form-control" id="title_ar" name="title_ar"
                        value="{{ old('title_ar', $event->title_ar) }}" required>
                    @error('title_ar')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                @include('admin.events.partials.type-select', [
                    'selectedType' => $event->type,
                    'labelClass' => 'font-bold',
                    'errorClass' => 'text-black',
                ])
            </div>

            <div class="col-md-6">
                @include('admin.events.partials.audience-select', [
                    'selectedAudience' => $event->audience,
                    'labelClass' => 'font-bold',
                    'errorClass' => 'text-black',
                ])
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label font-bold">الحالة</label>
                    <select class="form-select" name="status" id="status" required>
                        <option value="1" {{ old('status', $event->status) == '1' ? 'selected' : '' }}>فعال
                        </option>
                        <option value="0" {{ old('status', $event->status) == '0' ? 'selected' : '' }}>غير فعال
                        </option>
                    </select>
                    @error('status')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="main_image_input" class="form-label font-bold">الصورة الرئيسية</label>
                    <input type="file" class="form-control" name="main_image" id="main_image_input" accept="image/*">
                    @error('main_image')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                    @if ($event->main_image)
                    <img id="current_main_image_preview" src="{{ $event->main_image_url }}" alt="الصورة الحالية"
                        class="news-preview mt-2 p-2 current-image-preview">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_main_image" id="remove_main_image">
                        <label class="form-check-label text-black" for="remove_main_image">
                            حذف الصورة الرئيسية الحالية
                        </label>
                    </div>
                    @endif
                    <img id="main_image_preview" src="#" alt="معاينة الصورة الجديدة" class="news-preview mt-2"
                        style="display: none;">
                </div>
            </div>

                @include('admin.events.partials.schedule-fields', ['event' => $event, 'errorClass' => 'text-black'])

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">تاريخ الإضافة</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $event->created_at ? $event->created_at->format('d/m/Y H:i') : 'غير متوفر' }}">
                    </div>
                </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="sub_image_input" class="form-label font-bold">الصورة الفرعية</label>
                    <input type="file" class="form-control" name="sub_image" id="sub_image_input" accept="image/*">
                    @error('sub_image')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                    @if ($event->sub_image)
                    <img id="current_sub_image_preview" src="{{ $event->sub_image_url }}" alt="الصورة الحالية"
                        class="news-preview mt-2 p-2 current-image-preview">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_sub_image" id="remove_sub_image">
                        <label class="form-check-label text-black" for="remove_sub_image">
                            حذف الصورة الفرعية الحالية
                        </label>
                    </div>
                    @endif
                    <img id="sub_image_preview" src="#" alt="معاينة الصورة الجديدة" class="news-preview mt-2"
                        style="display: none;">
                </div>
            </div>

            <div class="mb-3">
                <input @checked($event->price) name="is_payed" type="checkbox" id="togglePrice"
                onchange="togglePriceField()">
                <label for="togglePrice">مدفوع ؟</label>
            </div>

            <div class="col-md-6" id="priceField" style="display: none;">
                <div class="mb-3">
                    <label for="price" class="form-label">السعر</label>
                    <input type="number" class="form-control" value="{{ old('price', $event->price) }}" name="price"
                        id="price">
                    @error('price')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label font-bold">وصف الإعلان (بالعربية)</label>
                    <div class="ql-wrapper"><div id="quill_description_ar"></div></div>
                    <textarea id="description_ar" name="description_ar" style="display:none;">{{ old('description_ar', $event->description_ar) }}</textarea>
                    @error('description_ar')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="btn-section text-center">
            <a href="{{ route('admin.event.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة للقائمة
            </a>

            <button type="submit" class="update-btn">
                <i class="fas fa-save ms-1"></i>
                حفظ التعديلات
            </button>
        </div>

    </form>

    @include('admin.events.partials.subscribers-table', [
        'filterBaseUrl' => route('admin.event.edit', $event),
    ])
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#quill_description_ar', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    [{ 'color': [] }],
                    ['clean']
                ]
            }
        });
        var ta = document.getElementById('description_ar');
        quill.root.innerHTML = ta.value;
        document.querySelector('form').addEventListener('submit', function(e) {
            ta.value = quill.root.innerHTML;
            if (quill.getText().trim().length === 0) {
                e.preventDefault();
                quill.root.style.border = '2px solid red';
                quill.focus();
            } else {
                quill.root.style.border = '';
            }
        });
    });

    function togglePriceField() {
            const checkbox = document.getElementById('togglePrice');
            const priceField = document.getElementById('priceField');

            if (checkbox.checked) {
                priceField.style.display = 'block';
            } else {
                priceField.style.display = 'none';
            }
        }
        togglePriceField()

        document.addEventListener('DOMContentLoaded', function() {
            const mainImageInput = document.getElementById('main_image_input');
            const mainImagePreview = document.getElementById('main_image_preview');
            const currentMainImagePreview = document.getElementById('current_main_image_preview');
            const removeMainImageCheckbox = document.getElementById('remove_main_image');

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
                        if (currentMainImagePreview && currentMainImagePreview.src && currentMainImagePreview.src !== window.location.href) {
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
                        if (currentSubImagePreview && currentSubImagePreview.src && currentSubImagePreview.src !== window.location.href) {
                            currentSubImagePreview.style.display = 'block';
                        }
                    }
                });
            }
        });
</script>
@endpush