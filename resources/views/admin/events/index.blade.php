@extends('layouts.admin')

@section('title', 'إدارة الفعاليات')
@section('page-title', 'إدارة الفعاليات')

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
            border-color: #667eea;
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
    </style>
@endpush

@section('content')
    <div class="add-section">
        <h5 class="mb-4">
            <i class="fas fa-newspaper ms-2"></i>
            إضافة فعاليه جديد
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

        <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title_ar" class="form-label">عنوان الفعاليه (بالعربية)</label>
                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                        @error('title_ar')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>غير فعال</option>
                        </select>
                        @error('status')
                            <div class="text-white">{{ $message }}</div>
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
                        <label for="sub_image_input" class="form-label">الصورة الفرعية</label>
                        <input type="file" class="form-control" name="sub_image" id="sub_image_input" accept="image/*">
                        @error('sub_image')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                        <img id="sub_image_preview" src="#" alt="معاينة الصورة" class="news-preview" style="display: {{ old('sub_image') ? 'block' : 'none' }};">
                    </div>
                </div>

                <div class="mb-3">
                    <input type="checkbox" id="togglePrice" name="is_payed" onchange="togglePriceField()">
                    <label for="togglePrice">مدفوع ؟</label>
                </div>

                <div class="col-md-6" id="priceField" style="display: none;">
                    <div class="mb-3">
                        <label for="price" class="form-label">السعر</label>
                        <input type="number" class="form-control" value="{{ old('price') }}" name="price" id="price">
                        @error('price')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">وصف الفعاليه (بالعربية)</label>
                        <textarea class="form-control" id="description_ar" name="description_ar" rows="4" required>{{ old('description_ar') }}</textarea>
                        @error('description_ar')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-light mt-3">
                <i class="fas fa-plus ms-1"></i>
                إضافة الفعاليه
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
                    <th>العنوان (عربي)</th>
                    <th>مدفوع</th>
                    <th>السعر</th>
                    <th>الصورة الرئيسية</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events ?? [] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>{{ $item->title_ar }}</td>
                        @if ($item->price)
                            <td class="text-success">مدفوع</td>
                            <td class="text-success">{{ $item->price }}</td>
                        @else
                            <td class="text-primary">مجاني</td>
                            <td class="text-primary">0</td>
                        @endif
                        <td>
                            @if ($item->main_image)
                                <img src="{{ $item->main_image_url }}" alt="{{ $item->title_ar }}" class="news-img">
                            @else
                                لا توجد صورة
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $item->status_badge_class }}">
                                {{ $item->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.event.show', $item->id) }}" class="btn btn-info btn-sm" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.event.edit', $item->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete({{ $item->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-newspaper text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا توجد فعاليات</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (isset($events) && $events->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $events->links() }}
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
                    هل أنت متأكد من حذف هذه الفعاليه؟
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
    <script>
        function togglePriceField() {
            const checkbox = document.getElementById('togglePrice');
            const priceField = document.getElementById('priceField');

            if (checkbox.checked) {
                priceField.style.display = 'block';
            } else {
                priceField.style.display = 'none';
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            const mainImageInput = document.getElementById('main_image_input');
            const mainImagePreview = document.getElementById('main_image_preview');
            const subImageInput = document.getElementById('sub_image_input');
            const subImagePreview = document.getElementById('sub_image_preview');

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

            if (subImageInput) {
                subImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            subImagePreview.src = e.target.result;
                            subImagePreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        subImagePreview.src = '#';
                        subImagePreview.style.display = 'none';
                    }
                });
            }
        });

        function confirmDelete(eventId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/event/${eventId}`;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush
