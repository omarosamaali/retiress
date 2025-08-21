@extends('layouts.admin')

@section('title', 'إدارة الخدمات')
@section('page-title', 'إدارة الخدمات')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    إضافة خدمة جديد
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
                <th>الصورة</th>
                <th>الإسم (عربي)</th>
                <th>الجمهور المستهدف</th>
                <th>هل مجاني</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services ?? [] as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td>
                    @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" style="width: 50px; height: 50px;" alt="">
                    @else
                    لا توجد صورة
                    @endif
                </td>
                <td>{{ $item->name_ar }}</td>
                <td>{{ $item->target_audience_ar }}</td>
                <td>{{ $item->is_payed ? 'مجاني' : 'مدفوع' }}</td>
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


<div class="table-responsive" style="margin-top: 50px">
    <h5 class="mb-3">المشتركين في الخدمة</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('app.date_time') }}</th>
                <th scope="col">{{ __('app.subscriber_name') }}</th>
                <th scope="col">{{ __('app.service_name') }}</th>
                <th scope="col">{{ __('app.type') }}</th>
                <th scope="col">{{ __('الايصال') }}</th>

                <th scope="col">{{ __('app.status') }}</th>
                <th scope="col">{{ __('app.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $index => $transaction)
            <tr class="table-row">
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ \Carbon\Carbon::parse($transaction->subscribed_at)->translatedFormat('d/m/Y - h:i A') }}</td>
                <td>
                    {{ $transaction->user->name }}
                </td>
                <td>
                    @switch($transaction->type)
                    @case('service')
                    @if ($transaction->service)
                    {{ $transaction->service->name_ar }}
                    @endif
                    @break
                    @case('event')
                    @if ($transaction->event)
                    {{ $transaction->event->title_ar }}
                    @endif
                    @break
                    @endswitch
                </td>
                <td>

                    @switch($transaction->type)
                    @case('service')
                    <span class="badge bg-primary">{{ __('app.service') }}</span>
                    @break
                    @case('event')
                    <span class="badge bg-info">{{ __('app.event') }}</span>
                    @break
                    @endswitch
                </td>

                <td>
                    @switch($transaction->status)
                    @case('pending')
                    <span class="badge bg-secondary">{{ __('app.pending_approval') }}</span>
                    @break
                    @case('waiting_for_payment')
                    <span class="badge bg-warning">{{ __('app.waiting_for_payment') }}</span>
                    @break
                    @case('waiting_for_activation')
                    <span class="badge bg-info">{{ __('app.waiting_for_activation') }}</span>
                    @break
                    @case('active')
                    <span class="badge bg-success">{{ __('app.active') }}</span>
                    @break
                    @case('rejected')
                    <span class="badge bg-danger">{{ __('app.rejected') }}</span>
                    @break
                    @case('expired')
                    <span class="badge bg-dark">{{ __('app.expired') }}</span>
                    @break
                    @case('deactivated')
                    <span class="badge bg-warning">{{ __('app.deactivated') }}</span>
                    @break
                    @default
                    <span class="badge bg-secondary">{{ $transaction->status }}</span>
                    @endswitch
                </td>
                <td>
                    @if($transaction->receipt_image)
                    <a href="{{ Storage::url($transaction->receipt_image) }}" target="_blank">
                        <img src="{{ Storage::url($transaction->receipt_image) }}" alt="Receipt" style="width: 50px; height: 50px; object-fit: cover;">
                    </a>
                    @else
                    {{ __('app.no_receipt_yet') }}
                    @endif
                </td>


                <td style="min-width: 200px;">
                    @if($transaction->status == 'pending')
                    <form action="{{ route('admin.transactions.approve', $transaction) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal-{{ $transaction->id }}">{{ __('app.approve') }}</button>
                    </form>
                    @elseif($transaction->status == 'waiting_for_payment')
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $transaction->id }}">{{ __('app.reject') }}</button>
                    @elseif($transaction->status == 'waiting_for_activation')
                    <form action="{{ route('admin.transactions.activate', $transaction) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">{{ __('app.activate') }}</button>
                    </form>
                    @elseif($transaction->status == 'active')
                    <form action="{{ route('admin.transactions.deactivate', $transaction) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">{{ __('app.deactivate') }}</button>
                    </form>
                    @elseif($transaction->status == 'deactivated')
                    <form action="{{ route('admin.transactions.activate', $transaction) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('هل أنت متأكد من إعادة تفعيل هذه المعاملة؟')">
                            {{ __('app.activate') }}
                        </button>
                    </form>

                    @elseif($transaction->status == 'rejected')
                    <button type="button" class="btn btn-dark btn-sm" disabled>{{ __('app.rejected') }}</button>
                    @elseif($transaction->status == 'expired')
                    <button type="button" class="btn btn-dark btn-sm" disabled>{{ __('app.expired') }}</button>
                    @endif
                </td>

                <script>
                    function activeAgain(transactionId) {
                        if (confirm('هل أنت متأكد من إعادة تفعيل هذه المعاملة؟')) {
                            document.getElementById('activateForm-' + transactionId).submit();
                        }
                    }

                </script>


            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">{{ __('app.no_transactions') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $transactions->links() }}
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
