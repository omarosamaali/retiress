<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>فواتيري</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styleU.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <style>
        .inv-page { max-width: 900px; margin: 90px auto 60px; padding: 0 16px; }
        .inv-breadcrumb { display:flex; align-items:center; gap:8px; font-size:13px; color:#64748b; margin-bottom:20px; }
        .inv-breadcrumb a { color:#b68a35; text-decoration:none; }
        .inv-title { font-size:1.4rem; font-weight:800; color:#1e293b; margin-bottom:24px; display:flex; align-items:center; gap:10px; }
        .inv-title i { color:#b68a35; }

        /* بطاقة واحدة */
        .inv-card {
            background:#fff;
            border-radius:14px;
            box-shadow:0 2px 12px rgba(0,0,0,.07);
            border:1px solid #e2e8f0;
            margin-bottom:16px;
            overflow:hidden;
        }
        .inv-card--urgent { border-color:#f59e0b; box-shadow:0 2px 12px rgba(245,158,11,.15); }
        .inv-card--done   { border-color:#d1fae5; opacity:.85; }

        .inv-card__header {
            display:flex; align-items:center; justify-content:space-between;
            padding:14px 20px;
            background:#fafafa;
            border-bottom:1px solid #f1f5f9;
            gap:12px;
            flex-wrap:wrap;
        }
        .inv-card__title { font-weight:700; font-size:15px; color:#1e293b; display:flex; align-items:center; gap:8px; }
        .inv-badge {
            display:inline-block; font-size:11px; font-weight:700;
            padding:3px 10px; border-radius:20px;
        }
        .inv-badge--pending  { background:#fffbeb; color:#b45309; border:1px solid #fde68a; }
        .inv-badge--waiting  { background:#ede9fe; color:#6d28d9; border:1px solid #ddd6fe; }
        .inv-badge--active   { background:#e8f3ed; color:#016330; border:1px solid #a7f3d0; }
        .inv-badge--rejected { background:#fef2f2; color:#b91c1c; border:1px solid #fecaca; }
        .inv-badge--done     { background:#f0fdf4; color:#15803d; border:1px solid #bbf7d0; }

        .inv-card__body { padding:16px 20px; }

        .inv-info-row { display:flex; gap:24px; flex-wrap:wrap; margin-bottom:14px; }
        .inv-info-item { display:flex; flex-direction:column; gap:2px; }
        .inv-info-item label { font-size:11px; color:#94a3b8; font-weight:600; text-transform:uppercase; }
        .inv-info-item span { font-size:14px; color:#1e293b; font-weight:600; }

        /* فورم رفع الإيصال */
        .inv-upload-box {
            background:#f8fafc;
            border:2px dashed #cbd5e1;
            border-radius:10px;
            padding:16px;
            margin-top:14px;
        }
        .inv-upload-box label { display:block; font-weight:700; font-size:13px; color:#475569; margin-bottom:8px; }
        .inv-upload-box input[type=file] {
            display:block; width:100%; padding:8px;
            border:1px solid #e2e8f0; border-radius:6px;
            background:#fff; font-size:13px;
        }
        .inv-upload-btn {
            margin-top:10px;
            display:inline-flex; align-items:center; gap:6px;
            background:#b68a35; color:#fff; border:none;
            padding:9px 22px; border-radius:8px; font-size:14px; font-weight:700;
            cursor:pointer; transition:background .18s;
        }
        .inv-upload-btn:hover { background:#8a6828; }

        .inv-receipt-preview {
            display:flex; align-items:center; gap:10px;
            background:#f0fdf4; border:1px solid #bbf7d0;
            border-radius:8px; padding:10px 14px; margin-top:10px;
        }
        .inv-receipt-preview i { color:#16a34a; font-size:18px; }

        /* زر التجديد */
        .inv-renew-btn {
            display:inline-flex; align-items:center; gap:8px;
            background:#b68a35; color:#fff; border:none;
            padding:11px 28px; border-radius:10px;
            font-size:15px; font-weight:800; cursor:pointer; transition:background .18s;
        }
        .inv-renew-btn:hover { background:#8a6828; }

        /* قسم التاريخ */
        .inv-section-title {
            font-size:14px; font-weight:700; color:#64748b;
            margin:28px 0 10px;
            display:flex; align-items:center; gap:8px;
        }
        .inv-section-title::after {
            content:''; flex:1; height:1px; background:#e2e8f0;
        }

        .inv-empty { text-align:center; padding:40px 20px; color:#94a3b8; }
        .inv-empty i { font-size:2.5rem; display:block; margin-bottom:10px; }

        @media (max-width:600px) {
            .inv-info-row { gap:14px; }
            .inv-card__header { padding:12px 14px; }
            .inv-card__body { padding:12px 14px; }
        }
    </style>
</head>
<body class="mp-body">
    <x-guest-header></x-guest-header>

    <div class="inv-page">

        <div class="inv-breadcrumb">
            <a href="{{ route('members.panel') }}"><i class="fa-solid fa-table-cells-large"></i> لوحة التحكم</a>
            <i class="fa-solid fa-chevron-left" style="font-size:10px;"></i>
            <span>فواتيري</span>
        </div>

        <div class="inv-title">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            فواتيري
        </div>

        {{-- رسائل النجاح/الخطأ --}}
        @if (session('success'))
            <div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-weight:600;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div style="background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-weight:600;">
                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
            </div>
        @endif

        {{-- ========== قسم: تحتاج إجراء ========== --}}
        @php
            $hasPendingItems = false;
            $membershipNeedsPayment = $membershipApp && (string)$membershipApp->status === '0';
            $membershipCanRenew     = $membershipApp && in_array((string)$membershipApp->status, ['3','4']);
            if ($membershipNeedsPayment || $pendingPaymentTransactions->count()) $hasPendingItems = true;
        @endphp

        @if ($hasPendingItems || $membershipCanRenew)
        <div class="inv-section-title">
            <i class="fa-solid fa-triangle-exclamation" style="color:#f59e0b;"></i>
            تحتاج إجراء
        </div>
        @endif

        {{-- === بطاقة العضوية — بانتظار الدفع === --}}
        @if ($membershipNeedsPayment)
        <div class="inv-card inv-card--urgent">
            <div class="inv-card__header">
                <div class="inv-card__title">
                    <i class="fa-solid fa-id-card" style="color:#b68a35;"></i>
                    تجديد / اشتراك العضوية
                </div>
                <span class="inv-badge inv-badge--pending">بانتظار الدفع</span>
            </div>
            <div class="inv-card__body">
                <div class="inv-info-row">
                    <div class="inv-info-item">
                        <label>الاسم</label>
                        <span>{{ $membershipApp->full_name }}</span>
                    </div>
                    <div class="inv-info-item">
                        <label>رقم العضوية</label>
                        <span>{{ $membershipApp->membership_number ?? '—' }}</span>
                    </div>
                    @if ($membershipApp->expiration_date)
                    <div class="inv-info-item">
                        <label>تاريخ الانتهاء الحالي</label>
                        <span>{{ \Carbon\Carbon::parse($membershipApp->expiration_date)->format('d/m/Y') }}</span>
                    </div>
                    @endif
                </div>

                @if ($membershipApp->payment_receipt)
                <div class="inv-receipt-preview">
                    <i class="fa-solid fa-paperclip"></i>
                    <span style="flex:1;font-size:13px;color:#166534;">تم رفع الإيصال — بانتظار مراجعة الموظفين</span>
                    @php $ext = pathinfo($membershipApp->payment_receipt, PATHINFO_EXTENSION); @endphp
                    @if (in_array(strtolower($ext), ['jpg','jpeg','png']))
                        <a href="{{ asset('storage/'.$membershipApp->payment_receipt) }}" target="_blank"
                           style="color:#16a34a;font-size:12px;font-weight:700;text-decoration:none;">
                            <i class="fa-solid fa-eye"></i> عرض
                        </a>
                    @else
                        <a href="{{ asset('storage/'.$membershipApp->payment_receipt) }}" target="_blank"
                           style="color:#16a34a;font-size:12px;font-weight:700;text-decoration:none;">
                            <i class="fa-solid fa-file-pdf"></i> عرض PDF
                        </a>
                    @endif
                </div>
                @endif

                <div class="inv-upload-box">
                    <label><i class="fa-solid fa-upload"></i> رفع إيصال الدفع (صورة أو PDF)</label>
                    <form method="POST" action="{{ route('members.membership.upload-receipt') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="payment_receipt" accept="image/*,.pdf" required>
                        @error('payment_receipt')
                            <span style="color:#b91c1c;font-size:12px;display:block;margin-top:4px;">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="inv-upload-btn">
                            <i class="fa-solid fa-paper-plane"></i> إرسال الإيصال
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif

        {{-- === معاملات إعلانات/خدمات بانتظار الدفع === --}}
        @foreach ($pendingPaymentTransactions as $txn)
        @php
            $txnTitle = $txn->event?->title_ar ?? $txn->service?->name_ar ?? 'معاملة';
            $txnPrice = $txn->event?->price ?? $txn->service?->price ?? 0;
        @endphp
        <div class="inv-card inv-card--urgent">
            <div class="inv-card__header">
                <div class="inv-card__title">
                    <i class="fa-solid fa-calendar-check" style="color:#b68a35;"></i>
                    {{ \Illuminate\Support\Str::limit($txnTitle, 60) }}
                </div>
                <span class="inv-badge inv-badge--pending">بانتظار الدفع</span>
            </div>
            <div class="inv-card__body">
                <div class="inv-info-row">
                    <div class="inv-info-item">
                        <label>النوع</label>
                        <span>{{ $txn->event ? 'إعلان / فعالية' : 'خدمة' }}</span>
                    </div>
                    <div class="inv-info-item">
                        <label>المبلغ</label>
                        <span>{{ $txnPrice > 0 ? number_format($txnPrice, 0) . ' درهم' : 'مجاني' }}</span>
                    </div>
                    <div class="inv-info-item">
                        <label>تاريخ الاشتراك</label>
                        <span>{{ $txn->subscribed_at ? \Carbon\Carbon::parse($txn->subscribed_at)->format('d/m/Y') : '—' }}</span>
                    </div>
                </div>

                @if ($txn->receipt_image)
                <div class="inv-receipt-preview">
                    <i class="fa-solid fa-paperclip"></i>
                    <span style="flex:1;font-size:13px;color:#166534;">تم رفع الإيصال — بانتظار مراجعة الموظفين</span>
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($txn->receipt_image) }}" target="_blank"
                       style="color:#16a34a;font-size:12px;font-weight:700;text-decoration:none;">
                        <i class="fa-solid fa-eye"></i> عرض
                    </a>
                </div>
                @endif

                <div class="inv-upload-box">
                    <label><i class="fa-solid fa-upload"></i> رفع إيصال الدفع (صورة أو PDF)</label>
                    <form method="POST" action="{{ route('members.upload_receipt', $txn) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="receipt_image" accept="image/*,.pdf" required>
                        <button type="submit" class="inv-upload-btn">
                            <i class="fa-solid fa-paper-plane"></i> إرسال الإيصال
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        {{-- === بطاقة التجديد — عضوية فعالة أو منتهية === --}}
        @if ($membershipCanRenew && !$membershipNeedsPayment)
        <div class="inv-section-title">
            <i class="fa-solid fa-rotate-right" style="color:#b68a35;"></i>
            تجديد العضوية
        </div>
        <div class="inv-card">
            <div class="inv-card__header">
                <div class="inv-card__title">
                    <i class="fa-solid fa-id-card" style="color:#b68a35;"></i>
                    تجديد العضوية
                </div>
                @if ((string)$membershipApp->status === '4')
                    <span class="inv-badge inv-badge--rejected">منتهية</span>
                @else
                    <span class="inv-badge inv-badge--active">فعالة</span>
                @endif
            </div>
            <div class="inv-card__body">
                <div class="inv-info-row">
                    <div class="inv-info-item">
                        <label>الاسم</label>
                        <span>{{ $membershipApp->full_name }}</span>
                    </div>
                    <div class="inv-info-item">
                        <label>رقم العضوية</label>
                        <span>{{ $membershipApp->membership_number ?? '—' }}</span>
                    </div>
                    @if ($membershipApp->expiration_date)
                    <div class="inv-info-item">
                        <label>تاريخ الانتهاء</label>
                        <span>{{ \Carbon\Carbon::parse($membershipApp->expiration_date)->format('d/m/Y') }}</span>
                    </div>
                    @endif
                </div>
                <form method="POST" action="{{ route('members.membership.request-renewal') }}"
                      onsubmit="return confirm('هل تريد تقديم طلب تجديد العضوية؟')">
                    @csrf
                    <button type="submit" class="inv-renew-btn">
                        <i class="fa-solid fa-rotate-right"></i> تجديد العضوية الآن
                    </button>
                </form>
                <p style="font-size:12px;color:#64748b;margin-top:10px;">
                    بعد الضغط سيتم تحويل الطلب لـ "بانتظار الدفع" وستتمكن من رفع إيصال الدفع من هذه الصفحة.
                </p>
            </div>
        </div>
        @endif

        {{-- ========== قسم: سجل المعاملات السابقة ========== --}}
        @if ($allTransactions->count())
        <div class="inv-section-title">
            <i class="fa-solid fa-clock-rotate-left" style="color:#64748b;"></i>
            سجل المعاملات
        </div>

        @foreach ($allTransactions as $txn)
        @php
            $txnTitle = $txn->event?->title_ar ?? $txn->service?->name_ar ?? 'معاملة';
            $txnPrice = $txn->event?->price ?? $txn->service?->price ?? 0;
            $badgeMap = [
                'active'                 => 'inv-badge--active',
                'waiting_for_activation' => 'inv-badge--waiting',
                'pending'                => 'inv-badge--pending',
                'rejected'               => 'inv-badge--rejected',
                'expired'                => 'inv-badge--rejected',
                'deactivated'            => 'inv-badge--rejected',
            ];
            $badgeClass = $badgeMap[$txn->status] ?? 'inv-badge--pending';
        @endphp
        <div class="inv-card inv-card--done">
            <div class="inv-card__header">
                <div class="inv-card__title" style="font-size:13px;">
                    <i class="fa-regular fa-calendar-check" style="color:#94a3b8;"></i>
                    {{ \Illuminate\Support\Str::limit($txnTitle, 70) }}
                </div>
                <span class="inv-badge {{ $badgeClass }}">{{ $txn->status_label }}</span>
            </div>
            @if ($txnPrice > 0 || $txn->receipt_image)
            <div class="inv-card__body" style="padding:10px 20px;">
                <div class="inv-info-row" style="margin-bottom:0;">
                    @if ($txnPrice > 0)
                    <div class="inv-info-item">
                        <label>المبلغ</label>
                        <span>{{ number_format($txnPrice, 0) }} درهم</span>
                    </div>
                    @endif
                    <div class="inv-info-item">
                        <label>التاريخ</label>
                        <span>{{ $txn->subscribed_at ? \Carbon\Carbon::parse($txn->subscribed_at)->format('d/m/Y') : '—' }}</span>
                    </div>
                    @if ($txn->receipt_image)
                    <div class="inv-info-item">
                        <label>الإيصال</label>
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($txn->receipt_image) }}" target="_blank"
                           style="color:#b68a35;font-size:13px;font-weight:700;text-decoration:none;">
                            <i class="fa-solid fa-eye"></i> عرض
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
        @endforeach
        @endif

        @if (!$hasPendingItems && !$membershipCanRenew && !$allTransactions->count())
        <div class="inv-empty">
            <i class="fa-solid fa-file-invoice"></i>
            <span>لا توجد فواتير أو معاملات بعد</span>
        </div>
        @endif

    </div>

    <x-footer-section></x-footer-section>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
</body>
</html>
