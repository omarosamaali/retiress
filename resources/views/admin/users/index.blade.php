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
        margin-bottom: 8px;
        min-width: 120px;
    }

    .membership-filter-buttons .btn {
        min-width: 110px;
        font-size: 0.85rem;
    }

    .chef-fields {
        display: none;
    }

    .official-image-preview {
        max-width: 200px;
        border-radius: 8px;
        margin-top: 10px;
    }

    #search2 {
        display: block;
        width: 100%;
        padding: 17px;
        padding-inline-start: 2.5rem;
        padding-right: 47px !important;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: #111827;
        background-color: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
    }

    #search2:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
    }

    .submit-button:hover {
        background-color: #1e40af;
    }

    .submit-button:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.5);
    }

    .search-input {
        display: block;
        width: 100%;
        padding: 17px;
        padding-inline-start: 2.5rem;
        padding-right: 47px !important;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: #111827;
        background-color: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
    }

    .search-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
    }

    .search-button {
        position: absolute;
        inset-inline-end: 0.625rem;
        bottom: 0.625rem;
        color: white;
        background-color: #1d4ed8;
        font-weight: 500;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border: none;
        cursor: pointer;
    }

    .search-button:hover {
        background-color: #1e40af;
    }

    .search-button:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.5);
    }
</style>
@endpush

@section('content')
<div class="add-user-section mb-3">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
        <h5 class="mb-0">
            <i class="fas fa-users ms-2"></i>
            إدارة المستخدمين والأعضاء
        </h5>
        <div class="d-flex flex-wrap gap-2">
            {{-- زر إصلاح طارئ: يحول أدوار العملاء الخاطئة من مدير لعضو --}}
            @php
                $wrongRoleCount = \App\Models\User::where('role','مدير')->whereHas('memberApplication')->count();
            @endphp
            @if($wrongRoleCount > 0)
            <form action="{{ route('admin.users.fix-customer-roles') }}" method="POST"
                  onsubmit="return confirm('سيتم تحويل {{ $wrongRoleCount }} حساب من دور مدير إلى عضو. متأكد؟')">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-exclamation-triangle ms-1"></i>
                    إصلاح {{ $wrongRoleCount }} حساب (أدوار خاطئة)
                </button>
            </form>
            @endif
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                <i class="fas fa-id-card ms-1"></i>
                تسجيل عضو جديد
            </a>
        </div>
    </div>
</div>

<div class="add-user-section">
    <h5 class="mb-4">
        <i class="fas fa-user-plus ms-2"></i>
        إضافة موظف / مستخدم نظام
    </h5>

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="mb-3">
                    <label class="form-label">كلمة السر</label>
                    <input type="password" class="form-control" name="password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="mb-3">
                    <label class="form-label">الصلاحية</label>
                    <select class="form-select" name="role" id="role">
                        <option value="">اختر الصلاحية</option>
                        <option value="مدير" {{ old('role')=='مدير' ? 'selected' : '' }}>مدير</option>
                        <option value="موظف استقبال" {{ old('role')=='موظف استقبال' ? 'selected' : '' }}>موظف استقبال
                        </option>
                        <option value="أمين الصندوق" {{ old('role')=='أمين الصندوق' ? 'selected' : '' }}>أمين الصندوق
                        </option>
                        <option value="عضو" {{ old('role')=='عضو' ? 'selected' : '' }}>عضو</option>
                        <option value="مدخل بيانات" {{ old('role')=='مدخل بيانات' ? 'selected' : '' }}>مدخل بيانات
                        </option>
                    </select>
                    @error('role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="mb-3">
                    <label for="status" class="form-label">حالة الحساب</label>
                    <select class="form-select" name="status" id="status">
                        <option value="فعال" {{ old('status')=='فعال' ? 'selected' : '' }}>فعال</option>
                        <option value="غير فعال" {{ old('status')=='غير فعال' ? 'selected' : '' }}>غير فعال</option>
                        <option value="بانتظار التفعيل" {{ old('status')=='بانتظار التفعيل' ? 'selected' : '' }}>
                            بانتظار التفعيل</option>
                        <option value="بإنتظار إستكمال البيانات" {{ old('status')=='بإنتظار إستكمال البيانات'
                            ? 'selected' : '' }}>
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
            إضافة موظف
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

<div class="mb-3 filter-buttons d-flex flex-wrap justify-content-center">
    <a href="{{ route('admin.users.index', request()->only('search', 'membership_status')) }}"
        class="btn {{ request()->get('role') == '' ? 'btn-primary' : 'btn-outline-primary' }}">
        عرض الجميع
    </a>
    <a href="{{ route('admin.users.index', array_merge(request()->only('search', 'membership_status'), ['role' => 'مدير'])) }}"
        class="btn {{ request()->get('role') == 'مدير' ? 'btn-primary' : 'btn-outline-primary' }}">
        المدراء
    </a>
    <a href="{{ route('admin.users.index', array_merge(request()->only('search', 'membership_status'), ['role' => 'موظف استقبال'])) }}"
        class="btn {{ request()->get('role') == 'موظف استقبال' ? 'btn-primary' : 'btn-outline-primary' }}">
        موظف الإستقبال
    </a>
    <a href="{{ route('admin.users.index', array_merge(request()->only('search', 'membership_status'), ['role' => 'مدخل بيانات'])) }}"
        class="btn {{ request()->get('role') == 'مدخل بيانات' ? 'btn-primary' : 'btn-outline-primary' }}">
        مدخل البيانات
    </a>
    <a href="{{ route('admin.users.index', array_merge(request()->only('search', 'membership_status'), ['role' => 'عضو'])) }}"
        class="btn {{ request()->get('role') == 'عضو' ? 'btn-primary' : 'btn-outline-primary' }}">
        عضو
    </a>
    <a href="{{ route('admin.users.index', array_merge(request()->only('search', 'membership_status'), ['role' => 'أمين الصندوق'])) }}"
        class="btn {{ request()->get('role') == 'أمين الصندوق' ? 'btn-primary' : 'btn-outline-primary' }}">
        أمين الصندوق
    </a>
</div>

<div class="mb-4 membership-filter-buttons d-flex flex-wrap justify-content-center">
    <span class="align-self-center ms-2 me-2 text-muted small">حالة العضوية:</span>
    <a href="{{ route('admin.users.index', request()->only(['role', 'search'])) }}"
        class="btn {{ ! request()->filled('membership_status') ? 'btn-success' : 'btn-outline-success' }}">
        الكل
    </a>
    @foreach ($membershipStatusFilters ?? [] as $filterKey => $filterLabel)
        <a href="{{ route('admin.users.index', array_merge(request()->only(['role', 'search']), ['membership_status' => $filterKey])) }}"
            class="btn {{ request()->get('membership_status') === $filterKey ? 'btn-success' : 'btn-outline-success' }}">
            {{ $filterLabel }}
        </a>
    @endforeach
</div>

<div style="margin-bottom: 15px;">
    <form action="{{ route('admin.users.index') }}" method="GET">
        @if (request()->filled('role'))
            <input type="hidden" name="role" value="{{ request('role') }}">
        @endif
        @if (request()->filled('membership_status'))
            <input type="hidden" name="membership_status" value="{{ request('membership_status') }}">
        @endif
        <div style="position:relative;">
            <input type="search" id="search" name="search" class="search-input" placeholder="إبحث بإسم العضو..."
                value="{{ request('search') }}" />
            @if(request()->filled('search'))
            <a href="{{ route('admin.users.index', request()->only(['role', 'membership_status'])) }}" class="search-button">إعادة تعيين</a>
            @else
            <button type="submit" class="search-button">بحث</button>
            @endif
        </div>
    </form>
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
                <th>تاريخ الانتهاء</th>
                <th>نوع العضوية</th>
                <th>حالة العضوية</th>
                <th>حالة الحساب</th>
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
                    @if ($user->memberApplication?->expiration_date)
                        {{ \Carbon\Carbon::parse($user->memberApplication->expiration_date)->format('d/m/Y') }}
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>
                    @if ($user->memberApplication)
                        <span class="badge bg-dark">{{ $user->membership_type_text }}</span>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>
                    <span class="badge {{ $user->membership_status_badge_class }}">
                        {{ $user->membership_status_text }}
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
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm"
                            title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete({{ $user->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center py-4">
                    <i class="fas fa-users text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-2">لا توجد بيانات مستخدمين</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if (isset($users) && $users->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $users->links() }}
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
                    <button type="submit" class="submit-button btn btn-danger">حذف</button>
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