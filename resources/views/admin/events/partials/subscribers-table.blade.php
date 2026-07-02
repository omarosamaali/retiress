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

    {{-- شريط الحذف الجماعي (منفصل عن الجدول لتجنب تداخل النماذج) --}}
    <form id="bulk-delete-form" action="{{ route('admin.transactions.bulk-destroy') }}" method="POST"
          onsubmit="return confirm('هل أنت متأكد من حذف السجلات المحددة نهائياً؟')">
        @csrf
        <div id="bulk-actions-bar" style="display:none; align-items:center; gap:10px; background:#fff3cd; border:1px solid #ffc107; border-radius:8px; padding:10px 16px; margin-bottom:12px;">
            <span id="selected-count" style="font-weight:700; color:#856404;"></span>
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> حذف المحددة
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearSelection()">
                إلغاء التحديد
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th style="width:40px;">
                        <input type="checkbox" id="select-all" title="تحديد الكل" style="cursor:pointer; width:16px; height:16px;">
                    </th>
                    <th>#</th>
                    <th>تاريخ الاشتراك</th>
                    <th>اسم المشترك</th>
                    <th>البريد</th>
                    <th>نوع المعاملة</th>
                    <th>الإيصال</th>
                    <th>حالة الاشتراك</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($eventTransactions as $index => $transaction)
                    <tr>
                        <td>
                            <input type="checkbox" name="ids[]" value="{{ $transaction->id }}"
                                   form="bulk-delete-form" class="row-checkbox"
                                   style="cursor:pointer; width:16px; height:16px;">
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $transaction->subscribed_at
                                ? \Carbon\Carbon::parse($transaction->subscribed_at)->translatedFormat('d/m/Y - h:i A')
                                : '—' }}
                        </td>
                        <td>{{ $transaction->user?->name ?? '—' }}</td>
                        <td style="direction: ltr; text-align: right;">{{ $transaction->user?->email ?? '—' }}</td>
                        <td>
                            @php
                                $__evType = $transaction->event?->type_label ?? '—';
                                $__evBadge = match($transaction->event?->type) {
                                    'دورة'    => 'bg-primary',
                                    'محاضرة'  => 'bg-warning text-dark',
                                    'فعالية'  => 'bg-success',
                                    'خدمات','مميزات' => 'bg-danger',
                                    default   => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $__evBadge }}">{{ $__evType }}</span>
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
                        <td>
                            <span class="badge {{ $transaction->status_badge_class }} txn-status-badge"
                                  data-transaction-id="{{ $transaction->id }}">
                                {{ $transaction->status_label }}
                            </span>
                        </td>
                        <td style="min-width: 220px;">
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                <form action="{{ route('admin.transactions.update-status', $transaction) }}" method="POST"
                                      class="txn-status-form flex-grow-1" data-transaction-id="{{ $transaction->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status"
                                            class="form-select form-select-sm txn-status-select"
                                            aria-label="تغيير حالة الاشتراك">
                                        @foreach (\App\Models\Transaction::SUBSCRIPTION_STATUSES as $statusKey)
                                            @php
                                                $statusSample = new \App\Models\Transaction(['status' => $statusKey]);
                                            @endphp
                                            <option value="{{ $statusKey }}"
                                                {{ $transaction->status === $statusKey ? 'selected' : '' }}>
                                                {{ $statusSample->status_label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>

                                <form action="{{ route('admin.transactions.destroy', $transaction) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الاشتراك نهائياً؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="حذف">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">
                            لا يوجد مشتركون{{ ($subscriptionStatusFilter ?? 'all') !== 'all' ? ' بهذه الحالة' : '' }} لهذا الإعلان.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
(function () {
    const statusMeta = @json(collect(\App\Models\Transaction::SUBSCRIPTION_STATUSES)->mapWithKeys(function ($statusKey) {
        $sample = new \App\Models\Transaction(['status' => $statusKey]);
        return [$statusKey => [
            'label' => $sample->status_label,
            'badge' => $sample->status_badge_class,
        ]];
    }));

    document.querySelectorAll('.txn-status-select').forEach(function (select) {
        select.dataset.previousValue = select.value;

        select.addEventListener('change', function () {
            const newStatus = this.value;
            const previousStatus = this.dataset.previousValue;
            const label = statusMeta[newStatus]?.label ?? newStatus;

            if (! confirm('هل تريد تغيير حالة الاشتراك إلى «' + label + '»؟')) {
                this.value = previousStatus;
                return;
            }

            const transactionId = this.closest('.txn-status-form')?.dataset.transactionId;
            const badge = document.querySelector('.txn-status-badge[data-transaction-id="' + transactionId + '"]');

            if (badge && statusMeta[newStatus]) {
                badge.textContent = statusMeta[newStatus].label;
                badge.className = 'badge txn-status-badge ' + statusMeta[newStatus].badge;
            }

            this.closest('form').submit();
        });
    });

    const selectAll   = document.getElementById('select-all');
    const bar         = document.getElementById('bulk-actions-bar');
    const countLabel  = document.getElementById('selected-count');

    function updateBar() {
        const checked = document.querySelectorAll('.row-checkbox:checked');
        if (checked.length > 0) {
            bar.style.display = 'flex';
            countLabel.textContent = 'محدد: ' + checked.length + ' سجل';
        } else {
            bar.style.display = 'none';
        }
        const all = document.querySelectorAll('.row-checkbox');
        selectAll.checked = all.length > 0 && checked.length === all.length;
        selectAll.indeterminate = checked.length > 0 && checked.length < all.length;
    }

    selectAll.addEventListener('change', function () {
        document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = this.checked);
        updateBar();
    });

    document.querySelectorAll('.row-checkbox').forEach(cb => {
        cb.addEventListener('change', updateBar);
    });

    window.clearSelection = function () {
        document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = false);
        selectAll.checked = false;
        selectAll.indeterminate = false;
        updateBar();
    };
})();
</script>
