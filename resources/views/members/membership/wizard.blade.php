<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('app.membership_application_title') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styleU.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body { background: #f0f4f8; }

        /* ── Force centered layout (RTL-safe) ── */
        .membership-wizard-page {
            padding-top: 130px;
            padding-bottom: 50px;
            min-height: 100vh;
            display: flex !important;
            flex-direction: column;
            align-items: center;
            width: 100% !important;
            box-sizing: border-box;
        }
        .mwiz-container {
            width: 100%;
            max-width: 820px;
            padding: 0 16px;
            box-sizing: border-box;
        }

        /* ── Custom Grid (RTL-safe, no Bootstrap dependency) ── */
        .mwiz-row {
            display: grid;
            gap: 14px;
            margin-bottom: 16px;
            align-items: start;
        }
        .mwiz-row--2 { grid-template-columns: 1fr 1fr; }
        .mwiz-row--3 { grid-template-columns: 1fr 1fr 1fr; }
        .mwiz-row--1 { grid-template-columns: 1fr; }
        @media(max-width: 640px) {
            .mwiz-row--2, .mwiz-row--3 { grid-template-columns: 1fr; }
        }
        .mwiz-req { color: #dc2626; }
        .form-control, .form-select { display: block; width: 100%; box-sizing: border-box; }
        /* Required for wizard step toggling (replaces Bootstrap d-none) */
        .d-none { display: none !important; }

        /* ── Type toggle ── */
        .mwiz-type-toggle {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 28px;
        }
        .mwiz-type-btn {
            border: 2px solid #e2e8f0;
            background: #fff;
            border-radius: 12px;
            padding: 12px 28px;
            font-size: .92rem;
            font-weight: 700;
            cursor: pointer;
            color: #64748b;
            font-family: inherit;
            transition: all .18s;
        }
        .mwiz-type-btn.active { border-color: #016330; background: #f0fdf4; color: #016330; }
        .mwiz-type-btn:hover:not(.active) { border-color: #cbd5e1; background: #f8fafc; }

        /* ── Steps nav ── */
        .membership-steps-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0 0 28px;
            gap: 0;
        }
        .membership-steps-nav li {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .85rem;
            color: #94a3b8;
            font-weight: 600;
        }
        .membership-steps-nav li:not(:last-child)::after {
            content: '';
            display: inline-block;
            width: 50px;
            height: 2px;
            background: #e2e8f0;
            margin: 0 10px;
        }
        .membership-steps-nav li.active:not(:last-child)::after,
        .membership-steps-nav li.completed:not(:last-child)::after { background: #016330; }
        .membership-steps-nav li span {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #94a3b8;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .82rem; font-weight: 700; flex-shrink: 0;
        }
        .membership-steps-nav li.active { color: #016330; }
        .membership-steps-nav li.active span { background: #016330; color: #fff; }
        .membership-steps-nav li.completed span { background: #10b981; color: #fff; }

        /* ── Card ── */
        .membership-wizard-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 28px rgba(0,0,0,.08);
            padding: 32px 36px;
        }
        @media(max-width:600px) { .membership-wizard-card { padding: 20px 16px; } }

        /* ── Step headings ── */
        .membership-step-heading {
            font-size: 1.05rem;
            font-weight: 700;
            color: #016330;
            border-bottom: 2px solid #e8f3ed;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .membership-step-subheading {
            font-size: .92rem;
            font-weight: 700;
            color: #374151;
            margin: 20px 0 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .membership-step-subheading::before {
            content: '';
            display: inline-block;
            width: 4px; height: 16px;
            background: #016330;
            border-radius: 2px;
        }

        /* ── Form controls ── */
        .form-label { font-weight: 600; font-size: .84rem; color: #374151; margin-bottom: 5px; }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1.5px solid #e2e8f0;
            padding: 9px 12px;
            font-size: .9rem;
            font-family: inherit;
            transition: border-color .18s, box-shadow .18s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #016330;
            box-shadow: 0 0 0 3px rgba(1,99,48,.1);
            outline: none;
        }
        .form-control[type="file"] { padding: 7px 10px; }

        /* ── Doc preview ── */
        .membership-doc-preview { border-radius: 8px; border: 2px solid #016330; object-fit: cover; }

        /* ── Actions ── */
        .membership-wizard-actions { padding-top: 20px; border-top: 1px solid #f1f5f9; margin-top: 8px; }
        .membership-wizard-actions .btn {
            padding: 10px 28px;
            border-radius: 10px;
            font-weight: 700;
            font-size: .9rem;
            font-family: inherit;
        }
        .btn-primary { background: #016330 !important; border-color: #016330 !important; }
        .btn-primary:hover { background: #014d25 !important; border-color: #014d25 !important; }
        .btn-success { background: #10b981 !important; border-color: #10b981 !important; }
        .btn-success:hover { background: #059669 !important; }

        /* ── Alerts ── */
        .alert { border-radius: 10px; font-size: .9rem; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
        .alert-danger { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
    </style>
</head>
<body>
    <div id="renewalModal" class="membership-renewal-modal" style="display:none;">
        <div class="modal-content">
            <span class="close" id="closeRenewalModal">&times;</span>
            <h3>{{ __('app.membership_renewal_form_title') }}</h3>
            <form id="renewalForm" method="POST" action="{{ route('members.renewal') }}">
                @csrf
                <div class="mb-3">
                    <label for="membership_id_kw">{{ __('app.membership_id') }} *</label>
                    <input type="text" id="membership_id_kw" name="membership_id_kw" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="national_id_kw">{{ __('app.national_id') }} *</label>
                    <input type="text" id="national_id_kw" name="national_id_kw" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email_kw">{{ __('app.email') }} *</label>
                    <input type="email" id="email_kw" name="email_kw" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">{{ __('app.confirm_renewal') }}</button>
            </form>
        </div>
    </div>

    <x-guest-header></x-guest-header>

    <main class="membership-wizard-page">
        <div class="mwiz-container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="text-center mb-4">
                <h2 style="font-size:1.4rem; font-weight:700; color:#1e293b; margin-bottom:16px;">
                    {{ __('app.membership_application_title') }}
                </h2>
                <div class="mwiz-type-toggle">
                    <button type="button" class="mwiz-type-btn active" id="btnNewMembership">
                        <i class="fa-solid fa-user-plus me-2" style="margin-left:6px;"></i>{{ __('app.new') }}
                    </button>
                    <button type="button" class="mwiz-type-btn" id="btnRenewalMembership">
                        <i class="fa-solid fa-rotate-right me-2" style="margin-left:6px;"></i>{{ __('app.renewal') }}
                    </button>
                </div>
            </div>

            <div id="newMembershipWizard">
                <ul class="membership-steps-nav" id="membershipStepsNav">
                    <li class="active" data-step="1"><span>1</span>{{ __('app.membership_step_1_short') }}</li>
                    <li data-step="2"><span>2</span>{{ __('app.membership_step_2_short') }}</li>
                    <li data-step="3"><span>3</span>{{ __('app.membership_step_3_short') }}</li>
                </ul>

                <form id="membershipWizardForm" action="{{ route('members.application.store') }}" method="POST" enctype="multipart/form-data" class="membership-wizard-card">
                    @csrf
                    @include('members.membership.partials.step-1-personal')
                    @include('members.membership.partials.step-2-details')
                    @include('members.membership.partials.step-3-documents')

                    <div class="membership-wizard-actions mt-4 d-flex justify-content-between gap-2">
                        <button type="button" class="btn btn-secondary" id="wizardPrevBtn" style="display:none;">{{ __('app.previous') }}</button>
                        <button type="button" class="btn btn-primary" id="wizardNextBtn">{{ __('app.next') }}</button>
                        <button type="submit" class="btn btn-success" id="wizardSubmitBtn" style="display:none;">{{ __('app.submit_application') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <x-footer-section></x-footer-section>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>window.membershipWizardInitialStep = {{ $errors->any() ? 3 : 1 }};</script>
    <script src="{{ asset('assets/js/membership-wizard.js') }}" defer></script>
</body>
</html>
