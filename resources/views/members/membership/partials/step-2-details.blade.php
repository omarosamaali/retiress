<div class="membership-step-panel d-none" data-step-panel="2">
    <h3 class="membership-step-heading">{{ __('app.membership_step_2_title') }}</h3>
    <p class="text-muted small mb-3">{{ __('app.membership_step_2_hint') }}</p>

    <h4 class="membership-step-subheading">{{ __('app.contact_details') }}</h4>
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <label class="form-label" for="mobile_phone">{{ __('app.mobile_phone') }} *</label>
            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control" required
                value="{{ old('mobile_phone') }}" placeholder="{{ __('app.mobile_phone_placeholder') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="home_phone">{{ __('app.home_phone') }}</label>
            <input type="text" name="home_phone" id="home_phone" class="form-control"
                value="{{ old('home_phone') }}" placeholder="{{ __('app.home_phone_placeholder') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="email">{{ __('app.email') }} *</label>
            <input type="email" name="email" id="email" class="form-control" required
                value="{{ old('email', auth()->user()?->email) }}" placeholder="{{ __('app.email_placeholder') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="po_box">{{ __('app.po_box') }}</label>
            <input type="text" name="po_box" id="po_box" class="form-control"
                value="{{ old('po_box') }}" placeholder="{{ __('app.po_box_placeholder') }}">
        </div>
    </div>

</div>
