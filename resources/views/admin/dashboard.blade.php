@extends('layouts.admin')

@section('title', 'الرئيسية - لوحة التحكم')
@section('page-title', 'الرئيسية')

@push('styles')
<style>
    .stats-card {
        background: #ffffff;
        color: rgb(0, 0, 0);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-card .icon {
        font-size: 3rem;
        opacity: 0.8;
        margin-bottom: 15px;
    }

    .stats-card .number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .stats-card .label {
        font-size: 15px;
        font-weight: 600;
    }

    .welcome-section {
        background: white;
        border-radius: 15px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .welcome-section h2 {
        color: #333;
        margin-bottom: 20px;
        font-weight: 700;

    }

    .welcome-section p {
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .icon i {
        padding: 5px;
        width: 50px;
        font-size: 19px;
        height: 50px;
        text-align: center;
        align-items: center;
        justify-content: center;
        display: flex;
        transition: .5s;
    }

    .icon.first i {
        background: rgb(48 126 243 / 10%);
        color: rgb(48 126 243);
    }

    .stats-card:hover i {
        transform: rotateY(180deg);
    }

    .icon.second i {
        background: rgb(83 166 83 / 10%);
        color: rgb(83 166 83);
    }

    .icon.third i {
        background: rgb(48 126 243 / 10%);
        color: rgb(48 126 243);
    }

    .icon.fourth i {
        background: #ffa50078;
        color: #ff1f00;
    }

    .container-top {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .text-muted {
        color: #6c757d !important;
        font-size: 13px;
    }

</style>
@endpush

@section('content')
{{-- إشعارات الداشبورد --}}
@if ($newMembershipRequests > 0)
<div class="dash-alerts">
    <a href="{{ route('admin.manageMembership.index') }}" class="dash-alert dash-alert--membership">
        <i class="fa-solid fa-user-clock"></i>
        <span>{{ $newMembershipRequests }} طلب عضوية جديد بانتظار الموافقة</span>
        <i class="fa-solid fa-chevron-left dash-alert__arrow"></i>
    </a>
</div>
@endif

<div class="welcome-section">
    <h2>مرحباً بك في لوحة تحكم الإدارة</h2>
    <p>
        مرحباً <strong>{{ Auth::user()->name }}</strong>، يمكنك من خلال هذه اللوحة إدارة جميع
        جوانب النظام بسهولة وفعالية. استخدم القوائم الجانبية للوصول إلى الأقسام المختلفة.
    </p>
</div>

<div class="container">

    {{-- ── قسم العضويات ── --}}
    <p class="fw-bold mb-2" style="color:#6c757d;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;">إحصائيات العضويات</p>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon first container-top">
                    <i class="fas fa-users"></i>
                    <div class="label">عضويات فعالة</div>
                </div>
                <div class="number" data-count="{{ $activeMembersCount }}">0</div>
                <p class="text-muted">آخر انضمام:
                    {{ $activeMembersApplications->first()?->created_at->diffForHumans() ?? 'غير متوفر' }}
                </p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon fourth container-top">
                    <i class="fas fa-user-slash"></i>
                    <div class="label">عضويات منتهية</div>
                </div>
                <div class="number" data-count="{{ $expiredMembersCount }}">0</div>
                <p class="text-muted">المنتهية يدوياً أو بالتاريخ</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon second container-top">
                    <i class="fas fa-clock"></i>
                    <div class="label">بانتظار الموافقة</div>
                </div>
                <div class="number" data-count="{{ $membersPendingApproval }}">0</div>
                <p class="text-muted">طلبات تحتاج مراجعة</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon third container-top">
                    <i class="fas fa-credit-card"></i>
                    <div class="label">بانتظار الدفع</div>
                </div>
                <div class="number" data-count="{{ $membersPendingPayment }}">0</div>
                <p class="text-muted">لم يتم الدفع بعد</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon first container-top">
                    <i class="fas fa-user-check"></i>
                    <div class="label">بانتظار التفعيل</div>
                </div>
                <div class="number" data-count="{{ $membersPendingActivation }}">0</div>
                <p class="text-muted">تم الدفع، انتظار التفعيل</p>
            </div>
        </div>
    </div>

    {{-- ── قسم الإعلانات ── --}}
    <p class="fw-bold mb-2" style="color:#6c757d;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;">إحصائيات الإعلانات</p>
    <div class="row g-3 mb-2">
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon third container-top">
                    <i class="fas fa-calendar-check"></i>
                    <div class="label">إعلانات فعالة</div>
                </div>
                <div class="number" data-count="{{ $activeEventsCount }}">0</div>
                <p class="text-muted">آخر إضافة: {{ $activeEvents->first()?->created_at->diffForHumans() ?? 'غير متوفر' }}</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon fourth container-top">
                    <i class="fas fa-calendar-times"></i>
                    <div class="label">إعلانات معطّلة</div>
                </div>
                <div class="number" data-count="{{ $inActiveEventsCount }}">0</div>
                <p class="text-muted">آخر إضافة: {{ $inActiveEvents->first()?->created_at->diffForHumans() ?? 'غير متوفر' }}</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon second container-top">
                    <i class="fas fa-hourglass-half"></i>
                    <div class="label">اشتراكات بانتظار الموافقة</div>
                </div>
                <div class="number" data-count="{{ $subPending }}">0</div>
                <p class="text-muted">تحتاج إجراء</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon third container-top">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <div class="label">اشتراكات بانتظار الدفع</div>
                </div>
                <div class="number" data-count="{{ $subWaitingPayment }}">0</div>
                <p class="text-muted">لم يرفع الإيصال</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon first container-top">
                    <i class="fas fa-spinner"></i>
                    <div class="label">بانتظار التفعيل</div>
                </div>
                <div class="number" data-count="{{ $subWaitingActivation }}">0</div>
                <p class="text-muted">تم الدفع، انتظار التفعيل</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon second container-top">
                    <i class="fas fa-check-circle"></i>
                    <div class="label">اشتراكات فعالة</div>
                </div>
                <div class="number" data-count="{{ $subActive }}">0</div>
                <p class="text-muted">نشطة حالياً</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon fourth container-top">
                    <i class="fas fa-times-circle"></i>
                    <div class="label">اشتراكات مرفوضة</div>
                </div>
                <div class="number" data-count="{{ $subRejected }}">0</div>
                <p class="text-muted">تم الرفض</p>
            </div>
        </div>
    </div>

    {{-- ── قسم الخدمات ── --}}
    <p class="fw-bold mb-2 mt-4" style="color:#6c757d;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;">إحصائيات الخدمات</p>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon first container-top">
                    <i class="fas fa-concierge-bell"></i>
                    <div class="label">خدمات فعالة</div>
                </div>
                <div class="number" data-count="{{ $activeServicesCount }}">0</div>
                <p class="text-muted">آخر إضافة: {{ $activeServices->first()?->created_at->diffForHumans() ?? 'غير متوفر' }}</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon fourth container-top">
                    <i class="fas fa-ban"></i>
                    <div class="label">خدمات معطّلة</div>
                </div>
                <div class="number" data-count="{{ $inActiveServicesCount }}">0</div>
                <p class="text-muted">آخر إضافة: {{ $inActiveServices->first()?->created_at->diffForHumans() ?? 'غير متوفر' }}</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon second container-top">
                    <i class="fas fa-hourglass-half"></i>
                    <div class="label">اشتراكات بانتظار الموافقة</div>
                </div>
                <div class="number" data-count="{{ $svcSubPending }}">0</div>
                <p class="text-muted">تحتاج إجراء</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon third container-top">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <div class="label">اشتراكات بانتظار الدفع</div>
                </div>
                <div class="number" data-count="{{ $svcSubWaitingPayment }}">0</div>
                <p class="text-muted">لم يرفع الإيصال</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon first container-top">
                    <i class="fas fa-spinner"></i>
                    <div class="label">بانتظار التفعيل</div>
                </div>
                <div class="number" data-count="{{ $svcSubWaitingActivation }}">0</div>
                <p class="text-muted">تم الدفع، انتظار التفعيل</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon second container-top">
                    <i class="fas fa-check-circle"></i>
                    <div class="label">اشتراكات فعالة</div>
                </div>
                <div class="number" data-count="{{ $svcSubActive }}">0</div>
                <p class="text-muted">نشطة حالياً</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stats-card">
                <div class="icon fourth container-top">
                    <i class="fas fa-times-circle"></i>
                    <div class="label">اشتراكات مرفوضة</div>
                </div>
                <div class="number" data-count="{{ $svcSubRejected }}">0</div>
                <p class="text-muted">تم الرفض</p>
            </div>
        </div>
    </div>

</div>

<div class="row" style="margin-bottom: 20px;">
    <div class="col-12">
        <div class="table-container" style="max-width: 100%; margin-top: 20px;">
            <p style="margin-bottom: 20px;">جميع المعاملات الخاصة ب
                طلبات العضوية والخدمات والبرامج</p>
            <table>
                <thead>
                    <tr>
                        <th scope="col">{{ __('app.service_name') }}</th>
                        <th scope="col">{{ __('app.date_time') }}</th>
                        <th scope="col">{{ __('app.type') }}</th>
                        <th scope="col">{{ __('app.status') }}</th>
                        <th scope="col">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $index => $transaction)
                    <tr class="table-row">
                        <td>

                            @switch($transaction->type)
                            @case('service')
                            @if ($transaction->service)
                            {{ $transaction->service->name_ar }}
                            @endif
                            @break

                            @case('event')
                            @if ($transaction->event)
                            {{ $transaction->event->title_ar }}
                            @endif
                            @break
                            @endswitch
                        </td>
                        <td>{{ \Carbon\Carbon::parse($transaction->subscribed_at)->translatedFormat('d/m/Y - h:i A') }}
                        </td>

                        {{-- <td>{{ app()->getLocale() == 'ar' ? $transaction->service->name_ar : $transaction->service->name_en }}</td> --}}

                        <td style="color: #000 !important;">
                            @switch($transaction->type)
                            @case('service')
                            <span style="color: #000 !important;">{{ __('app.service') }}</span>
                            @break

                            @case('event')
                            <span style="color: #000 !important;">{{ __('app.event') }}</span>
                            @break

                            @case('membership')
                            <span style="color: #000 !important;">{{ __('app.membership') }}</span>
                            @break
                            @endswitch
                        </td>
                        <td>
                            @switch($transaction->status)
                            @case('pending')
                            {{ __('app.pending_approval') }}
                            @break

                            @case('waiting_for_payment')
                            {{ __('app.waiting_for_payment') }}
                            @break

                            @case('waiting_for_activation')
                            {{ __('app.waiting_for_activation') }}
                            @break

                            @case('active')
                            {{ __('app.active') }}
                            @break

                            @case('rejected')
                            {{ __('app.rejected') }}
                            @break

                            @case('expired')
                            {{ __('app.expired') }}
                            @break

                            @case('deactivated')
                            {{ __('app.deactivated') }}
                            @break

                            @default
                            {{ $transaction->status }}
                            @endswitch
                        </td>
                        <td style="min-width: 142px;">
                            <a href="{{ route('services.show', $transaction) }}" type="button" class="btn btn-gray">{{ __('app.view') }}</a>
                            @if ($transaction->status == 'waiting_for_payment')
                            <button type="button" class="btn btn-blue trigger-file-input" data-transaction-id="{{ $transaction->id }}">
                                {{ __('app.upload_receipt') }}
                            </button>
                            <form id="uploadReceiptForm-{{ $transaction->id }}" action="{{ route('members.upload_receipt', $transaction) }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input type="file" class="form-control d-none" id="receipt_image_input-{{ $transaction->id }}" name="receipt_image" accept="image/*">
                            </form>
                            @elseif($transaction->receipt_image)
                            <a href="{{ Storage::url($transaction->receipt_image) }}" style="background-color: #007BFF; color: white;" target="_blank" class="btn btn-secondary">
                                {{ __('app.view_receipt') }}
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($memberships as $index => $transaction)
                    <tr class="table-row">
                        <td>
                            {{ $transaction->full_name }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($transaction->subscribed_at)->translatedFormat('d/m/Y - h:i A') }}
                        </td>
                        <td>
                            {{ __('app.membership') }}
                        </td>
                        <td>
                            @switch($transaction->status)
                            @case('0')
                            بإنتظار الدفع
                            @break

                            @case('1')
                            بإنتظار التفعيل
                            @break

                            @case('2')
                            بإنتظار الموافقة
                            @break

                            @case('3')
                            فعال
                            @break

                            @case('4')
                            منتهي
                            @break

                            @default
                            حالة غير معروفة
                            @endswitch
                        </td>
                        <td style="min-width: 142px;">
                            <a href="{{ route('admin.manageMembership.show', $transaction->id) }}" type="button" class="btn btn-gray">{{ __('app.view') }}</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div>
                {{ $transactions->links() }}
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-events-table :events="$serviceTypeEvents" title="أحدث إعلانات الخدمات" />
    </div>
    <div class="col-6">
        <x-events-table :events="$otherTypeEvents" title="أحدث الإعلانات (فعاليات ودورات)" />
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-services-cricle :services="$activeServices" />
    </div>
    <div class="col-6">
        <x-events-cricle :events="$activeEvents" />
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle ms-2"></i>
            <strong>نصيحة:</strong> يمكنك الوصول إلى جميع الأقسام من خلال القائمة الجانبية.
            لا تتردد في استكشاف جميع الميزات المتاحة.
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.number').forEach(counter => {
            const target = +counter.dataset.count;
            const increment = target / 100;
            const count = () => {
                const current = +counter.innerText;
                counter.innerText = current < target ? Math.ceil(current + increment) : target;
                if (current < target) setTimeout(count, 20);
            };
            count();
        });
    });

</script>

@endsection
