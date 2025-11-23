@extends('layouts.admin') {{-- تأكد من اسم الـ layout الخاص بك --}}

@section('title', 'إدارة طلبات العضوية')
@section('page-title', 'إدارة طلبات العضوية')

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
        <h6 class="m-0 font-weight-bold text-dark">كل الطلبات</h6>
    </div>
    <div class="card-body">
        <div class="add-section mb-4">
            <form method="GET" action="{{ route('admin.manageMembership.index') }}" class="row g-3 align-items-end">
                <!-- حقل البحث -->
                <div class="col-md-4">
                    <label for="search" class="form-label">البحث بالاسم أو رقم الهاتف</label>
                    <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="ابحث هنا...">
                </div>

                <!-- حقل الفرز -->
                <div class="col-md-3">
                    <label for="sort_by" class="form-label">فرز حسب</label>
                    <select name="sort_by" id="sort_by" class="form-select">
                        <option value="">اختر...</option>
                        <option value="date" {{ request('sort_by') == 'date' ? 'selected' : '' }}>تاريخ الطلب</option>
                        <option value="emirate" {{ request('sort_by') == 'emirate' ? 'selected' : '' }}>الإمارة</option>
                        <option value="gender" {{ request('sort_by') == 'gender' ? 'selected' : '' }}>الجنس</option>
                        <option value="nationality" {{ request('sort_by') == 'nationality' ? 'selected' : '' }}>الجنسية</option>
                    </select>
                </div>

                <!-- اتجاه الفرز -->
                <div class="col-md-3">
                    <label for="sort_direction" class="form-label">اتجاه الفرز</label>
                    <select name="sort_direction" id="sort_direction" class="form-select">
                        <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>تنازلي</option>
                        <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>تصاعدي</option>
                    </select>
                </div>

                <!-- زر الإرسال -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-light w-100">تطبيق</button>
                </div>
            </form>
        </div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>تاريخ الطلب</th>
                <th>الاسم</th>
                <th>الجنسية</th>
                <th>الإمارة</th>
                <th>رقم الهاتف</th>
                <th>الجنس</th>
                <th>الصورة الرئيسية</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @if ($membership->isNotEmpty())
            @foreach ($membership as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ optional($member->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                <td>{{ $member->full_name ?? 'لا يوجد اسم' }}</td>
                <td>{{ $member->nationality ?? 'لا توجد جنسية' }}</td>
                <td>{{ $member->emirate ?? 'لا توجد إمارة' }}</td>
                <td>{{ $member->mobile_phone ?? 'غير محدد' }}</td>
                <td>{{ $member->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                <td>
                    @if ($member->personal_photo_path)
                    <img style="height: 50px;" src="{{ asset('storage/' . $member->personal_photo_path) }}" alt="{{ $member->full_name }}" class="about-img">
                    @else
                    <img src="/assets/images/default_user.jpg" alt="{{ $member->full_name }}" class="about-img">
                    @endif
                </td>
                <td>
                    <span style="color: white; border-radius: 5px; padding: 0px 3px; {{ $member->status == '0' ? 'background: red' : ($member->status == '1' ? 'background: purple' : ($member->status == '2' ? 'background: blue' : ($member->status == '3' ? 'background: green' : 'background: orange'))) }}">
                        @switch($member->status)
                        @case('0') بإنتظار الدفع @break
                        @case('1') بإنتظار التفعيل @break
                        @case('2') بإنتظار الموافقة @break
                        @case('3') فعال @break
                        @case('4') منتهي @break
                        @default حالة غير معروفة @endswitch
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        {{-- <a href="{{ route('admin.manageMembership.show', $member->id) }}" class="btn btn-info btn-sm" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a> --}}
                        <a href="{{ route('admin.manageMembership.edit', $member->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
<button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDeleteModal('manageMembership', {{ $member->id }})">
    <i class="fas fa-trash"></i>
</button> </div>

                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="10" class="text-center py-4">
                    <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-2">لا يوجد أعضاء بعد. يرجى <a href="{{ route('admin.member.create') }}">الإضافة الآن</a></p>
                </td>
            </tr>
            @endif
        </tbody>
    </table>

    <!-- إضافة التصفح (Pagination) -->
    <div class="d-flex justify-content-center">
        {{ $membership->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    {{-- {{ $membership->links() }} --}}
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

// **هنا التعديل: استخدم المسار الصحيح للحذف**
deleteForm.action = `{{ url('admin/manageMembership') }}/${id}`;

// يمكنك استخدام هذه الطريقة أيضًا:
// deleteForm.action = `/admin/${type}/${id}`;
// ولكن الطريقة الأولى أفضل لأنها تستخدم وظائف Laravel المساعدة

deleteModalBody.textContent = 'هل أنت متأكد من حذف هذا العضو؟';

const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
deleteModal.show();
}

</script>
@endpush
