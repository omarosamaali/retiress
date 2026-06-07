<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>فواتيري</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styleU.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <style>
        .inv-page {
            max-width: 1100px;
            margin: 90px auto 40px;
            padding: 0 16px;
        }
        .inv-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #64748b;
            margin-bottom: 20px;
        }
        .inv-breadcrumb a { color: #016330; text-decoration: none; }
        .inv-breadcrumb a:hover { text-decoration: underline; }
        .inv-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .inv-title i { color: #059669; }
        .inv-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
        }
        @media (max-width: 900px) { .inv-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 600px) { .inv-grid { grid-template-columns: repeat(2, 1fr); } }

        .inv-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 1px 8px rgba(0,0,0,.08);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid #e2e8f0;
            transition: transform .15s, box-shadow .15s;
        }
        .inv-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.13); }

        .inv-card__thumb {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 2rem;
        }
        .inv-card__thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .inv-card__body {
            padding: 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .inv-card__event {
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.3;
        }
        .inv-card__date {
            font-size: 10px;
            color: #64748b;
        }
        .inv-card__amount {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 13px;
            font-weight: 800;
            color: #059669;
            margin-top: auto;
        }
        .inv-card__amount img { height: 13px; width: auto; vertical-align: middle; }
        .inv-card__status {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
            margin-top: 4px;
        }
        .inv-card__actions {
            padding: 8px 12px 12px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }
        .inv-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .inv-btn--view { background: #e8f3ed; color: #016330; }
        .inv-btn--receipt { background: #e8f0fe; color: #1a73e8; }
        .inv-btn--view:hover { background: #d1fae5; }
        .inv-btn--receipt:hover { background: #dbeafe; }

        .inv-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
            font-size: 1rem;
        }
        .inv-empty i { font-size: 3rem; display: block; margin-bottom: 12px; }
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
            <span style="font-size:14px;font-weight:600;color:#64748b;margin-right:4px;">({{ $invoiceTransactions->count() }})</span>
        </div>

        <div class="inv-grid">
            @forelse ($invoiceTransactions as $transaction)
                @php
                    $__ev     = $transaction->event;
                    $__title  = $__ev ? (app()->getLocale() == 'ar' ? $__ev->title_ar : $__ev->title_en) : '—';
                    $__price  = $__ev?->price ?? 0;
                    $__isFree = $__ev?->isFree() ?? true;
                    $__date   = $transaction->subscribed_at
                        ? \Carbon\Carbon::parse($transaction->subscribed_at)->format('d/m/Y — h:i A')
                        : ($transaction->created_at?->format('d/m/Y — h:i A') ?? '—');
                    $__statusColors = [
                        'active'                => ['bg'=>'#e8f3ed','color'=>'#016330'],
                        'waiting_for_payment'   => ['bg'=>'#fffbeb','color'=>'#b45309'],
                        'waiting_for_activation'=> ['bg'=>'#ede9fe','color'=>'#6d28d9'],
                        'pending'               => ['bg'=>'#fef9c3','color'=>'#854d0e'],
                        'rejected'              => ['bg'=>'#fef2f2','color'=>'#b91c1c'],
                        'expired'               => ['bg'=>'#f1f5f9','color'=>'#475569'],
                        'deactivated'           => ['bg'=>'#f1f5f9','color'=>'#475569'],
                    ];
                    $__sc = $__statusColors[$transaction->status] ?? ['bg'=>'#f1f5f9','color'=>'#475569'];
                @endphp
                <div class="inv-card">
                    {{-- Thumbnail --}}
                    <div class="inv-card__thumb">
                        @if ($transaction->receipt_image)
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($transaction->receipt_image) }}" target="_blank"
                               style="display:block;width:100%;height:100%;">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($transaction->receipt_image) }}"
                                     alt="إيصال {{ $__title }}">
                            </a>
                        @else
                            <i class="fa-solid fa-file-invoice"></i>
                        @endif
                    </div>

                    <div class="inv-card__body">
                        <div class="inv-card__event">{{ \Illuminate\Support\Str::limit($__title, 50) }}</div>
                        <div class="inv-card__date"><i class="fa-regular fa-clock"></i> {{ $__date }}</div>
                        <div class="inv-card__amount">
                            @if ($__isFree)
                                <span style="color:#016330;">مجاني</span>
                            @else
                                {{ number_format((float) $__price, 0) }}
                                <img src="{{ asset('assets/images/drhm.svg') }}" alt="درهم">
                            @endif
                        </div>
                        <span class="inv-card__status" style="background:{{ $__sc['bg'] }};color:{{ $__sc['color'] }};">
                            {{ $transaction->status_label }}
                        </span>
                    </div>

                    <div class="inv-card__actions">
                        @if ($__ev)
                            <a href="{{ route('events.show', $__ev) }}" class="inv-btn inv-btn--view">
                                <i class="fa-solid fa-eye"></i> الإعلان
                            </a>
                        @endif
                        @if ($transaction->receipt_image)
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($transaction->receipt_image) }}"
                               target="_blank" class="inv-btn inv-btn--receipt">
                                <i class="fa-solid fa-image"></i> الإيصال
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="inv-empty">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>لا توجد فواتير بعد</span>
                </div>
            @endforelse
        </div>

    </div>

    <x-footer-section></x-footer-section>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
</body>
</html>
