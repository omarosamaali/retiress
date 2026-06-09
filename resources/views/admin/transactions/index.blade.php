@extends('layouts.admin')

@section('title', 'الطلبات')
@section('page-title', 'الطلبات')

@push('styles')
<style>
.badge-pending          { background:#6b7280; color:#fff; }
.badge-waiting_for_payment    { background:#d97706; color:#fff; }
.badge-waiting_for_activation { background:#0284c7; color:#fff; }
.badge-active           { background:#16a34a; color:#fff; }
.badge-rejected         { background:#dc2626; color:#fff; }
.badge-expired          { background:#374151; color:#fff; }
.badge-deactivated      { background:#ca8a04; color:#fff; }
.tx-badge { display:inline-block; padding:3px 10px; border-radius:20px; font-size:.78rem; font-weight:600; }
.filter-bar { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px; align-items:center; }
.filter-bar select, .filter-bar input { border-radius:8px; border:1px solid #d1d5db; padding:7px 12px; font-size:.9rem; }
.filter-bar button { border-radius:8px; padding:7px 18px; font-size:.9rem; }
.stat-chip { display:inline-flex; align-items:center; gap:6px; background:#f1f5f9; border-radius:20px; padding:4px 14px; font-size:.82rem; font-weight:600; color:#334155; }
.stat-chips { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:18px; }
</style>
@endpush

@section('content')
<div class="container-fluid">

    {{-- إحصائيات سريعة --}}
    <div class="stat-chips">
        @php
        $labels = [
            'pending'               => ['بانتظار الموافقة','#6b7280'],
            'waiting_for_payment'   => ['بانتظار الدفع','#d97706'],
            'waiting_for_activation'=> ['بانتظار التفعيل','#0284c7'],
            'active'                => ['فعال','#16a34a'],
            'rejected'              => ['مرفوض','#dc2626'],
            'expired'               => ['منتهي','#374151'],
            'deactivated'           => ['معطّل','#ca8a04'],
        ];
        @endphp
        @foreach($labels as $key => [$label, $color])
        <span class="stat-chip" style="border:2px solid {{ $color }}20;">
            <span style="width:8px;height:8px;border-radius:50%;background:{{ $color }};display:inline-block;"></span>
            {{ $label }}: <strong>{{ $statusCounts[$key] ?? 0 }}</strong>
        </span>
        @endforeach
    </div>

    {{-- فلاتر --}}
    <form method="GET" action="{{ route('admin.transactions.index') }}" class="filter-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث بالاسم أو الإيميل..." style="min-width:200px;">

        <select name="status">
            <option value="">كل الحالات</option>
            @foreach($labels as $key => [$label, $color])
            <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
            @endforeach
        </select>

        <select name="type">
            <option value="">كل الأنواع</option>
            <option value="event" @selected(request('type') === 'event')>إعلان / فعالية</option>
            <option value="service" @selected(request('type') === 'service')>خدمة</option>
        </select>

        <button type="submit" class="btn btn-primary btn-sm">بحث</button>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-secondary btn-sm">إعادة تعيين</a>
    </form>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 text-center align-middle" style="direction:rtl;">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>العضو</th>
                        <th>النوع</th>
                        <th>الإعلان / الخدمة</th>
                        <th>الحالة</th>
                        <th>تاريخ الطلب</th>
                        <th>تغيير الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
                    <tr>
                        <td class="text-muted" style="font-size:.8rem;">{{ $tx->id }}</td>
                        <td>
                            <div style="font-weight:600;">{{ $tx->user?->name ?? '—' }}</div>
                            <div style="font-size:.78rem;color:#64748b;">{{ $tx->user?->email }}</div>
                        </td>
                        <td>
                            <span class="tx-badge" style="background:#e0f2fe;color:#0369a1;">{{ $tx->type_label }}</span>
                        </td>
                        <td style="max-width:200px;">
                            @if($tx->event)
                                <span title="{{ $tx->event->title_ar }}">{{ Str::limit($tx->event->title_ar, 40) }}</span>
                            @elseif($tx->service)
                                <span title="{{ $tx->service->name_ar ?? $tx->service->name }}">{{ Str::limit($tx->service->name_ar ?? $tx->service->name, 40) }}</span>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <span class="tx-badge badge-{{ $tx->status }}">{{ $tx->status_label }}</span>
                        </td>
                        <td style="font-size:.82rem;white-space:nowrap;">
                            {{ $tx->subscribed_at?->format('Y/m/d H:i') ?? '—' }}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.transactions.update-status', $tx) }}" style="display:flex;gap:6px;justify-content:center;align-items:center;">
                                @csrf @method('PATCH')
                                <select name="status" class="form-select form-select-sm" style="max-width:160px;">
                                    @foreach($labels as $key => [$label, $color])
                                    <option value="{{ $key }}" @selected($tx->status === $key)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">حفظ</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">لا توجد طلبات.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $transactions->links() }}
    </div>

</div>
@endsection
