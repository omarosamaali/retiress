@extends('layouts.admin')

@section('title', 'إدارة إنجازات الخبرات')
@section('page-title', 'إدارة إنجازات الخبرات')

@push('styles')
<style>
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

    .news-img {
        width: 50px;
        height: auto;
        border-radius: 5px;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    }

    .news-preview {
        width: 150px;
        max-height: 100px;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 10px;
    }

    .select2-container--default .select2-selection--single {
        height: 46px !important;
        border-radius: 10px !important;
    }

    .select2-selection__rendered {
        position: relative !important;
        top: 6px !important;
    }

    .news-preview {
        max-width: 200px;
        max-height: 200px;
        margin-top: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

</style>
@endpush

@section('content')
<div class="add-section">
    <h5 class="mb-4">
        <i class="fas fa-newspaper ms-2"></i>
        إضافة جديد
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

    <form action="{{ route('admin.magazines.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title_ar" class="form-label">عنوان الإنجاز (بالعربية)</label>
                    <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                    @error('title_ar')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="member_id" class="form-label">إسم العضو</label>
                    <select name="member_id" id="member_id" class="form-select" required>
                        <option value="">اختر العضو</option>
                        @foreach ($member_applications as $member_application)
                        <option value="{{ $member_application->id }}">{{ $member_application->full_name }}</option>
                        @endforeach
                    </select>
                    @error('member_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="main_image_input" class="form-label">الصورة الرئيسية</label>
                    <input type="file" class="form-control" name="main_image" id="main_image_input" accept="image/*">
                    @error('main_image')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                    <img id="main_image_preview" src="#" alt="معاينة الصورة" class="news-preview" style="display: {{ old('main_image') ? 'block' : 'none' }};">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="sub_images_input" class="form-label">الصور الفرعية</label>
                    <input type="file" class="form-control" name="sub_images[]" id="sub_images_input" accept="image/*" multiple>
                    @error('sub_images')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                    @error('sub_images.*')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">يمكنك اختيار أكثر من صورة</small>
                    <div id="sub_images_preview" class="mt-2"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="description_ar" class="form-label">الموضوع (بالعربية)</label>
                    <textarea class="form-control" id="description_ar" name="description_ar" rows="4" required>{{ old('description_ar') }}</textarea>
                    @error('description_ar')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <label for="status">الحالة</label>
                <select name="status" id="status" class="form-control">
                    <option value="1">نشط</option>
                    <option value="0">غير نشط</option>
                </select>
            </div>

        </div>

        <button type="submit" class="btn btn-light mt-3">
            <i class="fas fa-plus ms-1"></i>
            إضافة الإنجاز
        </button>
    </form>
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

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>تاريخ الإضافة</th>
                <th>عنوان الإنجاز (عربي)</th>
                <th>الصورة الرئيسية</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($magazines ?? [] as $item)
            @if(is_object($item))
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td>{{ $item->title_ar }}</td>
                <td>
                    @if (property_exists($item, 'main_image') && $item->main_image)
                    <img src="{{ $item->main_image_url }}" alt="{{ $item->title_ar }}" class="news-img">
                    @else
                    لا توجد صورة
                    @endif
                </td>
                <td>
                    <span class="badge {{ property_exists($item, 'status_badge_class') ? $item->status_badge_class : '' }}">
                        {{ property_exists($item, 'status_text') ? $item->status_text : '' }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.magazines.show', $item->id) }}" class="btn btn-info btn-sm" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.magazines.edit', $item->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete({{ $item->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endif
            @empty
            <tr>
                <td colspan="6" class="text-center py-4">
                    <i class="fas fa-newspaper text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-2">لا توجد الإنجازات</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@if (isset($magazines) && $magazines->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $magazines->links() }}
</div>
@endif

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من حذف هذه الإنجاز؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.getElementById('main_image_input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('main_image_preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });

    document.getElementById('sub_images_input').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('sub_images_preview');
        previewContainer.innerHTML = '';

        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'd-inline-block position-relative me-2 mb-2';
                    imgContainer.style.width = '100px';
                    imgContainer.style.height = '100px';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                    removeBtn.style.fontSize = '10px';
                    removeBtn.innerHTML = '×';
                    removeBtn.onclick = function() {
                        imgContainer.remove();
                    };

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeBtn);
                    previewContainer.appendChild(imgContainer);
                };

                reader.readAsDataURL(file);
            }
        }
    });


    $(document).ready(function() {
        $('#member_id').select2({
            placeholder: 'ابحث واختر العضو'
            , allowClear: true
            , language: {
                noResults: function() {
                    return "لا توجد نتائج";
                }
                , searching: function() {
                    return "جاري البحث...";
                }
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const mainImageInput = document.getElementById('main_image_input');
        const mainImagePreview = document.getElementById('main_image_preview');
        const subImageInput = document.getElementById('sub_image_input');
        const subImagePreviewContainer = document.getElementById('sub_image_preview_container');

        if (subImageInput) {
            subImageInput.addEventListener('change', function(event) {
                subImagePreviewContainer.innerHTML = '';
                const files = event.target.files;

                if (files.length > 0) {
                    Array.from(files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = "معاينة الصورة";
                            img.className = "news-preview me-2 mb-2";
                            img.style.maxWidth = "100px";
                            img.style.borderRadius = "8px";
                            subImagePreviewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            });
        }


        if (mainImageInput) {
            mainImageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        mainImagePreview.src = e.target.result;
                        mainImagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    mainImagePreview.src = '#';
                    mainImagePreview.style.display = 'none';
                }
            });
        }
    });

    function confirmDelete(newsId) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/magazines/${newsId}`;

        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

</script>
@endpush
