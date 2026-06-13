@extends('layouts.admin')

@section('title', 'جميع الإشعارات')
@section('page-title', 'جميع الإشعارات')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('admin.member-notifications.create') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus me-1"></i> إشعار جديد
    </a>
</div>

<div class="card">
    <div class="card-header fw-semibold">
        <i class="fa-solid fa-bell me-1"></i> جميع الإشعارات المرسلة
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size:.9rem;">
            <thead class="table-light">
                <tr>
                    <th style="width:40%">العنوان / النص</th>
                    <th>أرسل بواسطة</th>
                    <th>وقت الإرسال</th>
                    <th style="width:80px"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $item)
                <tr>
                    <td>
                        <div class="fw-semibold text-dark">{{ $item->title }}</div>
                        <div class="text-muted small">{{ Str::limit($item->body, 100) }}</div>
                    </td>
                    <td class="text-muted small">{{ $item->creator?->name ?? '—' }}</td>
                    <td class="text-muted small" style="white-space:nowrap;">
                        <i class="fa-regular fa-clock me-1"></i>
                        {{ $item->sent_at?->format('d/m/Y H:i') }}
                    </td>
                    <td>
                        <a href="{{ route('admin.member-notifications.show', $item->id) }}"
                           class="btn btn-sm btn-outline-primary" title="التفاصيل">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">لا توجد إشعارات مرسلة بعد.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($notifications->hasPages())
    <div class="card-footer d-flex justify-content-center">
        {{ $notifications->links() }}
    </div>
    @endif
</div>
@endsection
