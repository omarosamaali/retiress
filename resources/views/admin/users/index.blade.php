@extends('layouts.admin')

@section('title', 'إدارة المستخدمين')
@section('page-title', 'إدارة المستخدمين')

@push('styles')
    <style>
        .add-user-section {
            background: #fafafa;
            color: rgb(0, 0, 0);
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

        .filter-buttons .btn {
            margin-right: 10px;
            min-width: 120px;
        }

        .chef-fields {
            display: none;
        }

        .official-image-preview {
            max-width: 200px;
            border-radius: 8px;
            margin-top: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="add-user-section">
        <h5 class="mb-4">
            <i class="fas fa-user-plus ms-2"></i>
            إضافة مستخدم جديد
        </h5>

        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">الاسم</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" >
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" >
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">كلمة السر</label>
                        <input type="password" class="form-control" name="password" >
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">الصلاحية</label>
                        <select class="form-select" name="role" id="role" >
                            <option value="">اختر الصلاحية</option>
                            <option value="مدير" {{ old('role') == 'مدير' ? 'selected' : '' }}>مدير</option>
                            <option value="موظف استقبال" {{ old('role') == 'موظف استقبال' ? 'selected' : '' }}>موظف استقبال</option>
                            <option value="أمين الصندوق" {{ old('role') == 'أمين الصندوق' ? 'selected' : '' }}>أمين الصندوق</option>
                            <option value="عضو" {{ old('role') == 'عضو' ? 'selected' : '' }}>عضو</option>
                            <option value="مدخل بيانات" {{ old('role') == 'مدخل بيانات' ? 'selected' : '' }}>مدخل بيانات</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة</label>
                        <select class="form-select" name="status" id="status" >
                            <option value="فعال" {{ old('status') == 'فعال' ? 'selected' : '' }}>فعال</option>
                            <option value="غير فعال" {{ old('status') == 'غير فعال' ? 'selected' : '' }}>غير فعال</option>
                            <option value="بانتظار التفعيل" {{ old('status') == 'بانتظار التفعيل' ? 'selected' : '' }}>
                                بانتظار التفعيل</option>
                            <option value="بإنتظار إستكمال البيانات"
                                {{ old('status') == 'بإنتظار إستكمال البيانات' ? 'selected' : '' }}>
                                بانتظار التفعيل</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-light">
                <i class="fas fa-plus ms-1"></i>
                إضافة المستخدم
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

    <div class="mb-4 filter-buttons d-flex justify-content-center">
        <a href="{{ route('admin.users.index') }}"
            class="btn {{ request()->get('role') == '' ? 'btn-primary' : 'btn-outline-primary' }}">
            عرض الجميع
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'مدير']) }}"
            class="btn {{ request()->get('role') == 'مدير' ? 'btn-primary' : 'btn-outline-primary' }}">
            المدراء
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'موظف استقبال']) }}"
            class="btn {{ request()->get('role') == 'موظف استقبال' ? 'btn-primary' : 'btn-outline-primary' }}">
            موظف الإستقبال
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'مدخل بيانات']) }}"
            class="btn {{ request()->get('role') == 'مدخل بيانات' ? 'btn-primary' : 'btn-outline-primary' }}">
            مدخل البيانات
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'عضو']) }}"
            class="btn {{ request()->get('role') == 'عضو' ? 'btn-primary' : 'btn-outline-primary' }}">
            عضو
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'أمين الصندوق']) }}"
            class="btn {{ request()->get('role') == 'أمين الصندوق' ? 'btn-primary' : 'btn-outline-primary' }}">
            أمين الصندوق
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>تاريخ الإضافة</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الصلاحية</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users ?? [] as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>{{ $user->name }}</td>
                        <td style="direction: ltr; text-align: right;">{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->getRoleBadgeClass() }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>
                            @php
                                $statusDisplay = '';
                                $badgeClass = '';

                                // المنطق الجديد: ابدأ بالحالة المخزنة في جدول المستخدم
                                // ثم قم بتعديلها للطهاة بناءً على اكتمال البيانات

                                // الحالة الافتراضية بناءً على $user->status
                                switch ($user->status) {
                                    case 'فعال':
                                        $statusDisplay = 'فعال';
                                        $badgeClass = 'success';
                                        break;
                                    case 'غير فعال':
                                        $statusDisplay = 'غير فعال';
                                        $badgeClass = 'secondary'; // أو danger حسب رغبتك
                                        break;
                                    case 'بانتظار التفعيل':
                                        $statusDisplay = 'بانتظار التفعيل';
                                        $badgeClass = 'warning';
                                        break;
                                    default:
                                        $statusDisplay = $user->status; // أي حالة أخرى
                                        $badgeClass = 'secondary';
                                        break;
                                }

                            @endphp

                            <span class="badge bg-{{ $badgeClass }}">
                                {{ $statusDisplay }}
                            </span>



                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm"
                                    title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                    title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف"
                                    onclick="confirmDelete({{ $user->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-users text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا توجد بيانات مستخدمين</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (isset($users) && $users->hasPages())
        <div class="flex justify-center mt-4">
            {{ $users->links('vendor.pagination.tailwind') }}
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
                    هل أنت متأكد من حذف هذا المستخدم؟
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
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const chefFields = document.getElementById('chef-fields');
            const contractTypeSelect = document.getElementById('contract_type');
            const subscriptionFields = document.getElementById('subscription-fields');

            // دالة لإظهار/إخفاء حقول الطاه وحقول الاشتراك
            function toggleFields() {
                const isChef = roleSelect.value === 'طاه';
                chefFields.style.display = isChef ? 'block' : 'none';
                subscriptionFields.style.display = isChef && contractTypeSelect.value === 'annual_subscription' ?
                    'block' : 'none';
            }

            // دالة لتأكيد الحذف باستخدام Bootstrap Modal
            window.confirmDelete = function(userId) {
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = `/admin/users/${userId}`;
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            };

            // إعداد الحالة الأولية عند تحميل الصفحة
            toggleFields();

            // مستمع لتغيير الدور
            roleSelect.addEventListener('change', toggleFields);

            // مستمع لتغيير نوع التعاقد
            contractTypeSelect.addEventListener('change', toggleFields);
        });
    </script>
@endpush
