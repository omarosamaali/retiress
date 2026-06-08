@extends('layouts.admin')

@section('title', 'نشاطات العضو - ' . ($application->full_name ?? ''))
@section('page-title', 'نشاطات العضو')

@push('styles')
<style>
    .activity-header {
        background: #fff;
        border-radius: 12px;
        padding: 20px 24px;
        box-shadow: 0 2px 10px rgba(0,0,0,.06);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .activity-header .avatar {
        width: 56px; height: 56px;
        border-radius: 50%;
        background: #e0f2fe;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; color: #0284c7; flex-shrink: 0;
    }
    .activity-header .info h5 { margin: 0 0 4px; font-weight: 700; font-size: 1rem; }
    .activity-header .info small { color: #6b7280; font-size: .82rem; }

    .stat-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 5px 14px; border-radius: 20px;
        font-size: .8rem; font-weight: 700;
    }
    .stat-badge.blue   { background:#dbeafe; color:#1d4ed8; }
    .stat-badge.green  { background:#dcfce7; color:#15803d; }
    .stat-badge.orange { background:#ffedd5; color:#c2410c; }
    .stat-badge.red    { background:#fee2e2; color:#dc2626; }
    .stat-badge.gray   { background:#f3f4f6; color:#374151; }

    .activity-table { width:100%; border-collapse:collapse; }
    .activity-table th {
        background: #f8fafc; padding: 10px 14px;
        font-size: .8rem; font-weight: 700; color: #64748b;
        text-align: right; border-bottom: 2px solid #e2e8f0;
    }
    .activity-table td {
        padding: 11px 14px; font-size: .85rem; color: #374151;
        border-bottom: 1px solid #f1f5f9; vertical-align: middle;
    }
    .activity-table tr:last-child td { border-bottom: none; }
    .activity-table tr:hover td { background: #f8fafc; }

    .type-pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 3px 10px; border-radius: 20px; font-size: .75rem; font-weight: 700;
    }
    .type-pill.event   { background:#ede9fe; color:#6d28d9; }
    .type-pill.service { background:#fef9c3; color:#92400e; }

    .empty-state { text-align:center; padding: 60px 20px; color: #9ca3af; }
    .empty-state i { font-size: 3rem; margin-bottom: 12px; display:block; }
</style>
@endpush

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="activity-header">
        <div class="avatar"><i class="fas fa-user"></i></div>
        <div class="info">
            <h5>{{ $application->full_name ?? 'غير محدد' }}</h5>
            <small>
                <i class="fas fa-id-card me-1"></i>{{ $application->national_id ?? '—' }}
                &nbsp;|&nbsp;
                <i class="fas fa-phone me-1"></i>{{ $application->mobile_phone ?? '—' }}
                &nbsp;|&nbsp;
                <i class="fas fa-envelope me-1"></i>{{ $application->email ?? $user?->email ?? '—' }}
            </small>
        </div>
        <div class="ms-auto d-flex gap-2 flex-wrap">
            <span class="stat-badge blue"><i class="fas fa-list"></i> {{ $transactions->total() }} نشاط</span>
            <span class="stat-badge green"><i class="fas fa-check-circle"></i> {{ $transactions->where('status','active')->count() }} فعال</span>
            <span class="stat-badge orange"><i class="fas fa-hourglass-half"></i> {{ $transactions->whereIn('status',['pending','waiting_for_payment','waiting_for_activation'])->count() }} قيد الانتظار</span>
            <span class="stat-badge red"><i class="fas fa-times-circle"></i> {{ $transactions->where('status','rejected')->count() }} مرفوض</span>
        </div>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            @if($transactions->count())
            <div class="table-responsive">
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>النوع</th>
                            <th>الاسم</th>
                            <th>الحالة</th>
                            <th>تاريخ الاشتراك</th>
                            <th>إيصال</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $i => $tr)
                        <tr>
                            <td class="text-muted">{{ $transactions->firstItem() + $i }}</td>
                            <td>
                                @if($tr->type === 'event')
                                    <span class="type-pill event"><i class="fas fa-calendar-check"></i> إعلان / فعالية</span>
                                @elseif($tr->type === 'service')
                                    <span class="type-pill service"><i class="fas fa-concierge-bell"></i> خدمة</span>
                                @else
                                    <span class="type-pill gray">{{ $tr->type ?? '—' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($tr->event)
                                    <span class="fw-600">{{ $tr->event->title_ar ?? $tr->event->title_en ?? '—' }}</span>
                                    @if($tr->event->type)
                                        <br><small class="text-muted">{{ $tr->event->type }}</small>
                                    @endif
                                @elseif($tr->service)
                                    <span class="fw-600">{{ $tr->service->name_ar ?? $tr->service->name_en ?? '—' }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $sc = match($tr->status) {
                                        'active'                => 'green',
                                        'pending'               => 'gray',
                                        'waiting_for_payment'   => 'orange',
                                        'waiting_for_activation'=> 'blue',
                                        'rejected','deactivated','expired' => 'red',
                                        default => 'gray',
                                    };
                                @endphp
                                <span class="stat-badge {{ $sc }}">{{ $tr->status_label }}</span>
                            </td>
                            <td>{{ $tr->subscribed_at?->format('Y/m/d H:i') ?? '—' }}</td>
                            <td>
                                @if($tr->receipt_image)
                                    <a href="{{ Storage::url($tr->receipt_image) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="عرض الإيصال">
                                        <i class="fas fa-file-image"></i>
                                    </a>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($transactions->hasPages())
            <div class="p-3 border-top">
                {{ $transactions->links() }}
            </div>
            @endif

            @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p class="fw-bold mb-1">لا توجد نشاطات مسجّلة</p>
                <small>لم يشترك هذا العضو في أي إعلان أو خدمة حتى الآن.</small>
            </div>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.manageMembership.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-right me-1"></i> العودة للقائمة
        </a>
        <a href="{{ route('admin.manageMembership.edit', $application->id) }}" class="btn btn-warning btn-sm ms-2">
            <i class="fas fa-edit me-1"></i> تعديل بيانات العضو
        </a>
    </div>

</div>
@endsection
