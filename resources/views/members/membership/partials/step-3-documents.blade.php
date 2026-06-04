<div class="membership-step-panel d-none" data-step-panel="3">
    <h3 class="membership-step-heading">{{ __('app.membership_step_3_title') }}</h3>
    <p class="text-muted small mb-3">{{ __('app.membership_step_3_hint') }}</p>

    <div class="row g-3">
        @foreach ([
            'passport_photo' => 'passport_photo_preview',
            'national_id_photo' => 'national_id_photo_preview',
            'personal_photo' => 'personal_photo_preview',
            'educational_qualification_photo' => 'educational_qualification_photo_preview',
            'retirement_card_photo' => 'retirement_card_photo_preview',
        ] as $field => $previewAlt)
            <div class="col-md-6">
                <label class="form-label" for="{{ $field }}">{{ __('app.'.$field) }} *</label>
                <input type="file" name="{{ $field }}" id="{{ $field }}" class="form-control" accept="image/*,.pdf" required>
                <img id="preview_{{ $field }}" src="#" alt="{{ __('app.'.$previewAlt) }}" class="membership-doc-preview mt-2" style="display:none;max-width:180px;">
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        @if ($turnstileSiteKey)
            <div class="cf-turnstile mb-3" data-sitekey="{{ $turnstileSiteKey }}"></div>
        @else
            <div class="alert alert-warning small">{{ __('app.turnstile_not_configured') }}</div>
        @endif
        @error('captcha_token')
            <div class="text-danger small mb-2">{{ $message }}</div>
        @enderror
        <input type="hidden" name="captcha_token" id="captcha_token" value="">
    </div>

    <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" name="terms_accepted" id="terms_accepted" value="1" required @checked(old('terms_accepted'))>
        <label class="form-check-label" for="terms_accepted">{{ __('app.agree_terms_and_privacy') }}</label>
    </div>
</div>
