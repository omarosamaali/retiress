@extends('layouts.admin')

@section('title', 'تفاصيل الإشعار')
@section('page-title', 'تفاصيل الإشعار')

@push('styles')
<style>
    .notif-detail-card {
        background:#fff;
        border-radius:12px;
        box-shadow:0 2px 12px rgba(0,0,0,.07);
        padding:24px 28px;
        margin-bottom:24px;
    }
    .notif-title { font-size:1.15rem; font-weight:700; color:#1e293b; margin-bottom:8px; }
    .notif-body  { font-size:.92rem; color:#374151; line-height:1.7; white-space:pre-wrap; }
    .notif-meta  { display:flex; flex-wrap:wrap; gap:18px; margin-top:16px; padding-top:14px; border-top:1px solid #f1f5f9; }
    .notif-meta span { font-size:.82rem; color:#64748b; display:flex; align-items:center; gap:5px; }
    .notif-meta strong { color:#1e293b; }

    .stat-row { display:flex; gap:16px; margin-bottom:24px; flex-wrap:wrap; }
    .stat-box {
        flex:1; min-width:140px;
        border-radius:12px; padding:18px 20px;
        display:flex; align-items:center; gap:12px;
    }
    .stat-box.green  { background:#dcfce7; }
    .stat-box.yellow { background:#fef9c3; }
    .stat-box__icon { font-size:1.6rem; }
    .stat-box.green  .stat-box__icon { color:#16a34a; }
    .stat-box.yellow .stat-box__icon { color:#ca8a04; }
    .stat-box__num  { font-size:1.6rem; font-weight:800; line-height:1; }
    .stat-box.green  .stat-box__num { color:#15803d; }
    .stat-box.yellow .stat-box__num { color:#92400e; }
    .stat-box__lbl  { font-size:.8rem; color:#64748b; margin-top:2px; }

    .members-table { width:100%; border-collapse:collapse; font-size:.85rem; }
    .members-table th {
        background:#f8fafc; padding:9px 14px;
        text-align:right; font-size:.78rem; font-weight:700;
        color:#64748b; border-bottom:2px solid #e2e8f0;
    }
    .members-table td {
        padding:9px 14px; border-bottom:1px solid #f1f5f9;
        vertical-align:middle; color:#374151;
    }
    .members-table tr:last-child td { border-bottom:none; }
    .members-table tr:hover td { background:#f8fafc; }

    .tab-btns { display:flex; gap:8px; margin-bottom:14px; }
    .tab-btn {
        padding:6px 18px; border-radius:8px; border:1.5px solid #e2e8f0;
        background:#fff; font-size:.83rem; font-weight:700; cursor:pointer;
        color:#64748b; transition:all .15s;
    }
    .tab-btn.active { border-color:#016330; background:#f0fdf4; color:#016330; }
    .tab-pane { display:none; }
    .tab-pane.active { display:block; }
</style>
@endpush

@section('content')
<div class="container-fluid">

    {{-- بيانات الإشعار --}}
    <div class="notif-detail-card">
        <div class="notif-title">{{ $notification->title }}</div>
        <div class="notif-body">{{ $notification->body }}</div>
        <div class="notif-meta">
            <span><i class="fas fa-user-edit"></i> أرسله: <strong>{{ $notification->creator?->name ?? 'غير محدد' }}</strong></span>
            <span><i class="fas fa-clock"></i> وقت الإرسال: <strong>{{ $notification->sent_at?->format('d/m/Y H:i') ?? '—' }}</strong></span>
            <span><i class="fas fa-users"></i> إجمالي المستلمين: <strong>{{ $readRecords->count() + $unreadRecords->count() }}</strong></span>
        </div>
    </div>

    {{-- إحصائيات --}}
    <div class="stat-row">
        <div class="stat-box green">
            <div class="stat-box__icon"><i class="fas fa-check-double"></i></div>
            <div>
                <div class="stat-box__num">{{ $readRecords->count() }}</div>
                <div class="stat-box__lbl">قرأوا الإشعار</div>
            </div>
        </div>
        <div class="stat-box yellow">
            <div class="stat-box__icon"><i class="fas fa-envelope"></i></div>
            <div>
                <div class="stat-box__num">{{ $unreadRecords->count() }}</div>
                <div class="stat-box__lbl">لم يقرأوا بعد</div>
            </div>
        </div>
    </div>

    {{-- تبويبات --}}
    <div class="tab-btns">
        <button class="tab-btn active" onclick="switchTab('read', this)">
            <i class="fas fa-check me-1"></i> قرأوا ({{ $readRecords->count() }})
        </button>
        <button class="tab-btn" onclick="switchTab('unread', this)">
            <i class="fas fa-envelope me-1"></i> لم يقرأوا ({{ $unreadRecords->count() }})
        </button>
    </div>

    {{-- جدول القرأوا --}}
    <div id="tab-read" class="tab-pane active">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                @if($readRecords->count())
                <div class="table-responsive">
                    <table class="members-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم العضو</th>
                                <th>البريد الإلكتروني</th>
                                <th>وقت القراءة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($readRecords as $i => $rec)
                            <tr>
                                <td class="text-muted">{{ $i + 1 }}</td>
                                <td>
                                    <i class="fas fa-user-circle text-success me-1"></i>
                                    {{ $rec->user?->name_ar ?? $rec->user?->name ?? '—' }}
                                </td>
                                <td class="text-muted">{{ $rec->user?->email ?? '—' }}</td>
                                <td>{{ $rec->read_at?->format('d/m/Y H:i') ?? '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center text-muted py-5"><i class="fas fa-inbox fa-2x mb-2 d-block"></i>لا أحد قرأ هذا الإشعار بعد.</div>
                @endif
            </div>
        </div>
    </div>

    {{-- جدول ما قرأوش --}}
    <div id="tab-unread" class="tab-pane">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                @if($unreadRecords->count())
                <div class="table-responsive">
                    <table class="members-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم العضو</th>
                                <th>البريد الإلكتروني</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unreadRecords as $i => $rec)
                            <tr>
                                <td class="text-muted">{{ $i + 1 }}</td>
                                <td>
                                    <i class="fas fa-user-circle text-warning me-1"></i>
                                    {{ $rec->user?->name_ar ?? $rec->user?->name ?? '—' }}
                                </td>
                                <td class="text-muted">{{ $rec->user?->email ?? '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center text-muted py-5"><i class="fas fa-check-double fa-2x mb-2 d-block text-success"></i>جميع الأعضاء قرأوا هذا الإشعار.</div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.member-notifications.create') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-right me-1"></i> العودة للإشعارات
        </a>
    </div>

</div>

<script>
function switchTab(name, btn) {
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}
</script>
@endsection
