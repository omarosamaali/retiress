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
    @if ($turnstileSiteKey)
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endif
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

    <main class="membership-wizard-page" style="padding-top: 150px;">
        <div class="container" style="max-width: 900px;">
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

            <div class="membership-type-choice mb-4 text-center">
                <h2 class="h4 mb-3">{{ __('app.membership_application_title') }}</h2>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" id="btnNewMembership">{{ __('app.new') }}</button>
                    <button type="button" class="btn btn-outline-primary" id="btnRenewalMembership">{{ __('app.renewal') }}</button>
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
                    @include('members.membership.partials.step-3-documents', ['turnstileSiteKey' => $turnstileSiteKey])

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>window.membershipWizardInitialStep = {{ ($errors->any() || $errors->has('captcha_token')) ? 3 : 1 }};</script>
    <script src="{{ asset('assets/js/membership-wizard.js') }}" defer></script>
</body>
</html>
