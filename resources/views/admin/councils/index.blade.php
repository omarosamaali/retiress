@extends('layouts.admin') {{-- تأكد من اسم الـ layout الخاص بك --}}

@section('title', 'إدارة صفحة المجالس')
@section('page-title', 'إدارة صفحة المجالس')

@push('styles')
    <style>
        .add-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            margin-bottom: 30px;
            /* إضافة مسافة بين الجداول */
        }

        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 12px;
            margin: 0 2px;
        }

        .about-img {
            width: 50px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush

@section('content')

    {{-- رسائل Success/Error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">كل الأعضاء</h6>
            <a href="{{ route('admin.council.create') }}" class="btn btn-success btn-sm">إضافة مجالس</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تاريخ الإضافة</th>
                            <th>العنوان (عربي)</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>

                    @if ($councils)
                        @foreach ($councils as $council)
                            <tbody>
                                <tr>
                                    <td>{{ $council->id }}</td>
                                    <td>{{ optional($council->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                                    <td>{{ $council->name_ar ?? 'لا يوجد عنوان' }}</td>
                                    <td>
                                        <span class="badge {{ $council->status_badge_class }}">
                                            {{ $council->status_text }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.council.show', $council->id) }}" class="btn btn-info btn-sm" title="عرض">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.council.edit', $council->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDeleteModal('councils', {{ $council->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا يوجد مجالس بعد. يرجى <a href="{{ route('admin.council.create') }}">الإضافة الآن</a></p>
                        </div>
                    @endif
                </table>
            </div>
        </div>
    </div>



    {{-- Modal for Delete Confirmation --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="deleteModalBody">
                    هل أنت متأكد من حذف هذا العنصر؟
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
        // الدوال الخاصة بمعاينة الصور (إذا كنت تستخدم هذا الـ view للإضافة/التعديل، ولكن غالباً هذا الـ view للعرض فقط)
        // تم حذف هذا الجزء من السكربت لتجنب الازدواجية حيث أن هذا الـ view هو لعرض البيانات فقط.
        // إذا كنت تحتاج هذه الوظائف، يجب أن تكون في view الإضافة/التعديل.

        function confirmDeleteModal(type, id) {
            const deleteForm = document.getElementById('deleteForm');
            const deleteModalBody = document.getElementById('deleteModalBody');

            deleteForm.action = `/admin/council/${id}`;
            deleteModalBody.textContent = 'هل أنت متأكد من حذف محتوى صفحة "معلومات المجلس ؟';

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush
