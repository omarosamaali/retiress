@extends('layouts.admin')

@section('title', 'إدارة المعاملات')
@section('page-title', 'إدارة المعاملات')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0"><i class="fas fa-exchange-alt ms-2"></i> المعاملات</h5>
    </div>
    <div class="card-body">

        <form method="GET" class="row g-2 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="ابحث باسم أو بريد المستخدم"
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">كل الحالات</option>
                    <option value="pending"                {{ request('status')=='pending'               ?'selected':'' }}>بانتظار الموافقة</option>
                    <option value="waiting_for_payment"   {{ request('status')=='waiting_for_payment'   ?'selected':'' }}>بانتظار الدفع</option>
                    <option value="waiting_for_activation"{{ request('status')=='waiting_for_activation'?'selected':'' }}>بانتظار التفعيل</option>
                    <option value="active"                {{ request('status')=='active'                ?'selected':'' }}>فعال</option>
                    <option value="rejected"              {{ request('status')=='rejected'              ?'selected':'' }}>مرفوض</option>
                    <option value="deactivated"           {{ request('status')=='deactivated'           ?'selected':'' }}>معطّل</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="type" class="form-select">
                    <option value="">كل الأنواع</option>
                    <option value="event"  {{ request('type')=='event'  ?'selected':'' }}>إعلان / فعالية</option>
                    <option value="service"{{ request('type')=='service'?'selected':'' }}>خدمة</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">بحث</button>
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">إعادة تعيين</a>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>المستخدم</th>
                        <th>النوع</th>
                        <th>الخدمة / الإعلان</th>
                        <th>رقم العضوية</th>
                        <th>الحالة</th>
                        <th>تاريخ الاشتراك</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $t)
                    <tr>
                        <td class="text-center">{{ $t->id }}</td>
                        <td>
                            <div>{{ $t->user->name ?? '—' }}</div>
                            <small class="text-muted">{{ $t->user->email ?? '' }}</small>
                        </td>
                        <td class="text-center">{{ $t->type_label }}</td>
                        <td>
                            @if($t->service)
                                {{ $t->service->name_ar ?? $t->service->name_en ?? '—' }}
                            @elseif($t->event)
                                {{ $t->event->title_ar ?? $t->event->title_en ?? '—' }}
                            @else
                                —
                            @endif
                        </td>
                        <td class="text-center">
                            @if($t->membership_number)
                                @php
                                    $memberApp = \App\Models\MemberApplication::where('membership_number', $t->membership_number)->first();
                                    $isValid = $memberApp && $memberApp->expiration_date && \Carbon\Carbon::parse($memberApp->expiration_date)->isFuture();
                                @endphp
                                <div style="font-weight:600;font-size:.85rem;direction:ltr;">{{ $t->membership_number }}</div>
                                @if($memberApp)
                                    @if($isValid)
                                        <span class="badge bg-success" style="font-size:.72rem;">✓ فعالة</span>
                                    @else
                                        <span class="badge bg-warning text-dark" style="font-size:.72rem;">⚠ منتهية</span>
                                    @endif
                                    <div style="font-size:.75rem;color:#6b7280;margin-top:2px;">{{ $memberApp->full_name ?? '' }}</div>
                                @else
                                    <span class="badge bg-danger" style="font-size:.72rem;">✗ غير موجود</span>
                                @endif
                            @else
                                <span class="text-muted" style="font-size:.8rem;">—</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $t->status_badge_class }}">{{ $t->status_label }}</span>
                        </td>
                        <td class="text-center">{{ $t->subscribed_at?->format('d/m/Y H:i') ?? '—' }}</td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center flex-wrap">
                                @if($t->status === 'pending')
                                <form action="{{ route('admin.transactions.approve', $t) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">موافقة</button>
                                </form>
                                <form action="{{ route('admin.transactions.reject', $t) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">رفض</button>
                                </form>
                                @endif
                                @if(in_array($t->status, ['waiting_for_payment','waiting_for_activation']))
                                <form action="{{ route('admin.transactions.confirm_payment', $t) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-info btn-sm">تأكيد الدفع</button>
                                </form>
                                <form action="{{ route('admin.transactions.reject', $t) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">رفض</button>
                                </form>
                                @endif
                                @if($t->status === 'active')
                                <form action="{{ route('admin.transactions.deactivate', $t) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-warning btn-sm">تعطيل</button>
                                </form>
                                @endif
                                @if($t->status === 'deactivated')
                                <form action="{{ route('admin.transactions.activate', $t) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">إعادة تفعيل</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">لا توجد معاملات</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
