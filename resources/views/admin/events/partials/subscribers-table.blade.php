@php
    use Illuminate\Support\Facades\Storage;
    $filterBaseUrl = $filterBaseUrl ?? url()->current();
@endphp

<div class="subscribers-section mt-5 pt-4 border-top">
    <h5 class="mb-3">
        <i class="fas fa-users ms-2 text-primary"></i>
        المشتركون في هذا الإعلان
    </h5>

    <div class="mb-3">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
            <span class="text-muted small">نوع الإعلان:</span>
            @foreach (\App\Models\Event::TYPES as $eventType)
                <span class="badge {{ $event->type === $eventType ? 'bg-secondary' : 'bg-light text-muted border' }}">
                    {{ $eventType }}{{ $event->type === $eventType ? ' ✓' : '' }}
                </span>
            @endforeach
            <span class="text-muted small ms-2">الفئة:</span>
            <span class="badge {{ $event->isForMembersOnly() ? 'bg-info' : 'bg-dark' }}">{{ $event->audience_label }}</span>
            <span class="text-muted small ms-2">إجمالي المشتركين:</span>
            <span class="badge bg-primary">{{ $subscriptionStatusCounts['all'] ?? 0 }}</span>
        </div>
        @if (! empty($subscriptionTypeCounts))
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <span class="text-muted small">أنواع المعاملات:</span>
                @foreach ($subscriptionTypeCounts as $txnType => $count)
                    @php
                        $typeLabel = match ($txnType) {
                            'event' => 'إعلان / فعالية',
                            'service' => 'خدمة',
                            default => $txnType,
                        };
                    @endphp
                    <span class="badge bg-info">{{ $typeLabel }}: {{ $count }}</span>
                @endforeach
            </div>
        @endif
    </div>

    <div class="mb-4 d-flex flex-wrap gap-2">
        <a href="{{ $filterBaseUrl }}?subscription_status=all"
            class="btn btn-sm {{ ($subscriptionStatusFilter ?? 'all') === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
            الكل ({{ $subscriptionStatusCounts['all'] ?? 0 }})
        </a>
        @foreach (\App\Models\Transaction::SUBSCRIPTION_STATUSES as $statusKey)
            @php
                $sample = new \App\Models\Transaction(['status' => $statusKey]);
            @endphp
            <a href="{{ $filterBaseUrl }}?subscription_status={{ $statusKey }}"
                class="btn btn-sm {{ ($subscriptionStatusFilter ?? 'all') === $statusKey ? 'btn-primary' : 'btn-outline-secondary' }}">
                {{ $sample->status_label }} ({{ $subscriptionStatusCounts[$statusKey] ?? 0 }})
            </a>
        @endforeach
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>تاريخ الاشتراك</th>
                    <th>اسم المشترك</th>
                    <th>البريد</th>
                    <th>نوع المعاملة</th>
                    <th>حالة الاشتراك</th>
                    <th>الإيصال</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($eventTransactions as $index => $transaction)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $transaction->subscribed_at
                                ? \Carbon\Carbon::parse($transaction->subscribed_at)->translatedFormat('d/m/Y - h:i A')
                                : '—' }}
                        </td>
                        <td>{{ $transaction->user?->name ?? '—' }}</td>
                        <td style="direction: ltr; text-align: right;">{{ $transaction->user?->email ?? '—' }}</td>
                        <td><span class="badge bg-info">{{ $transaction->type_label }}</span></td>
                        <td>
                            <span class="badge {{ $transaction->status_badge_class }}">
                                {{ $transaction->status_label }}
                            </span>
                        </td>
                        <td>
                            @if ($transaction->receipt_image)
                                <a href="{{ Storage::url($transaction->receipt_image) }}" target="_blank">
                                    <img src="{{ Storage::url($transaction->receipt_image) }}" alt="إيصال"
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                </a>
                            @else
                                <span class="text-muted small">{{ __('app.no_receipt_yet') }}</span>
                            @endif
                        </td>
                        <td style="min-width: 180px;">
                            @if ($transaction->status === 'pending')
                                <form action="{{ route('admin.transactions.approve', $transaction) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">{{ __('app.approve') }}</button>
                                </form>
                            @elseif ($transaction->status === 'waiting_for_payment')
                                <span class="badge bg-warning text-dark">بانتظار رفع الإيصال</span>
                            @elseif ($transaction->status === 'waiting_for_activation')
                                <form action="{{ route('admin.transactions.activate', $transaction) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">{{ __('app.activate') }}</button>
                                </form>
                            @elseif ($transaction->status === 'active')
                                <form action="{{ route('admin.transactions.deactivate', $transaction) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">{{ __('app.deactivate') }}</button>
                                </form>
                            @elseif ($transaction->status === 'deactivated')
                                <form action="{{ route('admin.transactions.activate', $transaction) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">{{ __('app.activate') }}</button>
                                </form>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            لا يوجد مشتركون{{ ($subscriptionStatusFilter ?? 'all') !== 'all' ? ' بهذه الحالة' : '' }} لهذا الإعلان.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
