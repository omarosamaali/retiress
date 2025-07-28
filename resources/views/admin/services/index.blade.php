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
    </style>
@endpush

@section('content')
    <a href="{{ route('admin.services.create') }}" class="btn btn-success my-3">
        <i class="fas fa-newspaper ms-2"></i>
        إضافة فعاليه جديد
    </a>

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
                    <th>الإسم (عربي)</th>
                    <th>مدفوع</th>
                    <th>السعر</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services ?? [] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>{{ $item->name_ar }}</td>
                        @if ($item->price)
                            <td class="text-success">مدفوع</td>
                            <td class="text-success">{{ $item->price }}</td>
                        @else
                            <td class="text-primary">مجاني</td>
                            <td class="text-primary">0</td>
                        @endif
                        <td>
                            <span class="badge {{ $item->status_badge_class }}">
                                {{ $item->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.services.show', $item->id) }}" class="btn btn-info btn-sm" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.services.edit', $item->id) }}" class="btn btn-warning btn-sm" title="تعديل">
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
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-newspaper text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا توجد فعاليات</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (isset($services) && $services->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $services->links() }}
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

        function confirmDelete(servicesId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/services/${servicesId}`;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush
