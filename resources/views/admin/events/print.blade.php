<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>طباعة — {{ $event->title_ar }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Cairo", "Segoe UI", Tahoma, Arial, sans-serif;
            direction: rtl;
            color: #1a1a1a;
            background: #fff;
            font-size: 13px;
            line-height: 1.5;
        }

        /* ===== صفحة الطباعة ===== */
        .print-page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 14mm 16mm;
        }

        /* ===== الهيدر ===== */
        .ph {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid #b68a35;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }
        .ph__logo { height: 64px; width: auto; }
        .ph__info { text-align: center; flex: 1; }
        .ph__info h1 {
            font-size: 18px;
            font-weight: 800;
            color: #b68a35;
            margin-bottom: 2px;
        }
        .ph__info p { font-size: 11px; color: #555; }
        .ph__date { font-size: 11px; color: #666; text-align: left; white-space: nowrap; }

        /* ===== عنوان الإعلان ===== */
        .ev-title-bar {
            background: linear-gradient(135deg, #b68a35 0%, #d4a847 100%);
            color: #fff;
            text-align: center;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 16px;
        }
        .ev-title-bar h2 { font-size: 16px; font-weight: 800; }
        .ev-title-bar p  { font-size: 11px; opacity: .88; margin-top: 3px; }

        /* ===== تفاصيل الإعلان ===== */
        .ev-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 18px;
        }
        .ev-detail-item {
            background: #f8f8f8;
            border: 1px solid #e8e8e8;
            border-radius: 6px;
            padding: 8px 12px;
        }
        .ev-detail-item label {
            display: block;
            font-size: 10px;
            color: #888;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        .ev-detail-item span {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
        }

        /* ===== ملخص المشتركين ===== */
        .subs-summary {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #e8f3ed;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 10px 16px;
            margin-bottom: 14px;
        }
        .subs-summary__icon { font-size: 22px; }
        .subs-summary__text { flex: 1; }
        .subs-summary__text strong { font-size: 14px; color: #166534; display: block; }
        .subs-summary__text span   { font-size: 11px; color: #555; }
        .subs-summary__count {
            font-size: 28px;
            font-weight: 900;
            color: #16a34a;
            min-width: 50px;
            text-align: center;
        }

        /* ===== جدول المشتركين ===== */
        .subs-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        .subs-table thead tr {
            background: #1a1a1a;
            color: #fff;
        }
        .subs-table thead th {
            padding: 9px 10px;
            text-align: right;
            font-weight: 700;
            font-size: 11px;
            border: 1px solid #333;
        }
        .subs-table tbody tr:nth-child(even) { background: #f9f9f9; }
        .subs-table tbody tr:nth-child(odd)  { background: #fff; }
        .subs-table tbody td {
            padding: 8px 10px;
            border: 1px solid #e0e0e0;
            vertical-align: middle;
        }
        .subs-table tbody tr:hover { background: #fef9ec; }

        .badge-active {
            display: inline-block;
            background: #e8f3ed;
            color: #166534;
            border: 1px solid #a7f3d0;
            border-radius: 12px;
            padding: 2px 8px;
            font-size: 10px;
            font-weight: 700;
        }

        /* ===== فوتر ===== */
        .print-footer {
            border-top: 2px solid #e0e0e0;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 10px;
            color: #888;
            margin-top: auto;
        }

        /* ===== لا يوجد مشتركون ===== */
        .no-subs {
            text-align: center;
            padding: 40px 20px;
            color: #94a3b8;
            border: 2px dashed #e2e8f0;
            border-radius: 10px;
        }

        /* ===== أزرار الطباعة — تختفي عند الطبع ===== */
        .screen-only {
            text-align: center;
            padding: 16px;
            background: #f1f5f9;
        }
        .btn-print {
            background: #b68a35;
            color: #fff;
            border: none;
            padding: 12px 36px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin: 0 6px;
        }
        .btn-back {
            background: #475569;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin: 0 6px;
            text-decoration: none;
            display: inline-block;
        }

        @media print {
            .screen-only { display: none !important; }
            .print-page   { padding: 10mm 12mm; width: 100%; }
            body          { font-size: 12px; }
        }
    </style>
</head>
<body>

{{-- أزرار العرض على الشاشة --}}
<div class="screen-only">
    <button class="btn-print" onclick="window.print()">
        🖨️ طباعة
    </button>
    <a class="btn-back" href="{{ route('admin.event.edit', $event->id) }}">
        ← رجوع
    </a>
</div>

<div class="print-page">

    {{-- ===== الهيدر ===== --}}
    <div class="ph">
        <img src="{{ asset('assets/images/new-logo.png') }}" alt="شعار الجمعية" class="ph__logo">
        <div class="ph__info">
            <h1>جمعية الإمارات للمتقاعدين</h1>
            <p>Emirates Retired Persons Association</p>
        </div>
        <div class="ph__date">
            <div>تاريخ الطباعة</div>
            <div><strong>{{ now()->format('d/m/Y — H:i') }}</strong></div>
        </div>
    </div>

    {{-- ===== عنوان الإعلان ===== --}}
    <div class="ev-title-bar">
        <h2>{{ $event->title_ar }}</h2>
        @if ($event->title_en)
            <p>{{ $event->title_en }}</p>
        @endif
    </div>

    {{-- ===== تفاصيل الإعلان ===== --}}
    <div class="ev-details">
        <div class="ev-detail-item">
            <label>نوع الإعلان</label>
            <span>{{ $event->type ?? '—' }}</span>
        </div>
        <div class="ev-detail-item">
            <label>الفئة المستهدفة</label>
            <span>{{ $event->audience ?? '—' }}</span>
        </div>
        <div class="ev-detail-item">
            <label>السعر</label>
            <span>{{ $event->isFree() ? 'مجاني' : number_format($event->price, 0) . ' درهم' }}</span>
        </div>
        @if ($event->starts_at)
        <div class="ev-detail-item">
            <label>تاريخ البدء</label>
            <span>{{ $event->starts_at->format('d/m/Y') }}</span>
        </div>
        @endif
        @if ($event->ends_at)
        <div class="ev-detail-item">
            <label>تاريخ الانتهاء</label>
            <span>{{ $event->ends_at->format('d/m/Y') }}</span>
        </div>
        @endif
        @if ($event->subscription_deadline)
        <div class="ev-detail-item">
            <label>آخر موعد للتسجيل</label>
            <span>{{ $event->subscription_deadline->format('d/m/Y') }}</span>
        </div>
        @endif
        <div class="ev-detail-item">
            <label>رقم الإعلان</label>
            <span>#{{ $event->id }}</span>
        </div>
        <div class="ev-detail-item">
            <label>الحالة</label>
            <span>{{ $event->status ? 'منشور' : 'مسودة' }}</span>
        </div>
    </div>

    {{-- ===== ملخص عدد المشتركين ===== --}}
    <div class="subs-summary">
        <div class="subs-summary__icon">✅</div>
        <div class="subs-summary__text">
            <strong>المشتركون المعتمدون</strong>
            <span>الأعضاء الذين تمت الموافقة على اشتراكهم في هذا الإعلان</span>
        </div>
        <div class="subs-summary__count">{{ $approvedTransactions->count() }}</div>
    </div>

    {{-- ===== جدول المشتركين ===== --}}
    @if ($approvedTransactions->count())
    <table class="subs-table">
        <thead>
            <tr>
                <th style="width:36px;">#</th>
                <th>اسم المشترك</th>
                <th>البريد الإلكتروني</th>
                <th>تاريخ الاشتراك</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($approvedTransactions as $i => $txn)
            <tr>
                <td style="text-align:center; font-weight:700; color:#888;">{{ $i + 1 }}</td>
                <td><strong>{{ $txn->user?->name ?? '—' }}</strong></td>
                <td style="direction:ltr; text-align:right; font-size:11px; color:#475569;">
                    {{ $txn->user?->email ?? '—' }}
                </td>
                <td>
                    {{ $txn->subscribed_at
                        ? \Carbon\Carbon::parse($txn->subscribed_at)->format('d/m/Y — h:i A')
                        : '—' }}
                </td>
                <td><span class="badge-active">فعال ✓</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-subs">
        <div style="font-size:2rem; margin-bottom:8px;">📋</div>
        <div>لا يوجد مشتركون معتمدون في هذا الإعلان حتى الآن</div>
    </div>
    @endif

    {{-- ===== الفوتر ===== --}}
    <div class="print-footer">
        <span>جمعية الإمارات للمتقاعدين — www.uaeretired.ae</span>
        <span>إجمالي المشتركين المعتمدين: <strong>{{ $approvedTransactions->count() }}</strong></span>
        <span>طُبع بتاريخ: {{ now()->format('d/m/Y') }}</span>
    </div>

</div>

</body>
</html>
