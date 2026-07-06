<div class="membership-step-panel d-none" data-step-panel="3">
    <h3 class="membership-step-heading">{{ __('app.membership_step_3_title') }}</h3>
                    <p class="text-muted small mb-3">{{ __('app.membership_step_3_hint') }}</p>
                    <p class="text-muted small mb-3" style="color:#b45309 !important;">
                        <i class="fa-solid fa-circle-info" style="margin-left:4px;"></i>
                        الحد الأقصى لحجم كل ملف: 4 ميجابايت. يُفضّل ضغط الصور قبل الرفع لتسريع الإرسال.
                    </p>

    <div class="row g-3">
        @foreach ([
            'passport_photo' => 'passport_photo_preview',
            'national_id_photo' => 'national_id_photo_preview',
            'personal_photo' => 'personal_photo_preview',
            'educational_qualification_photo' => 'educational_qualification_photo_preview',
            'retirement_card_photo' => 'retirement_card_photo_preview',
        ] as $field => $previewAlt)
            <div class="col-md-6">
                <div style="border:1.5px solid #e2e8f0; border-radius:10px; padding:14px; background:#fafafa;">
                    <label class="form-label d-block mb-2" for="{{ $field }}">
                        <i class="fa-regular fa-image text-success" style="color:#016330; margin-left:5px;"></i>
                        {{ __('app.'.$field) }} <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="file" name="{{ $field }}" id="{{ $field }}" class="form-control" accept="image/*,.pdf" required>
                    <img id="preview_{{ $field }}" src="#" alt="{{ __('app.'.$previewAlt) }}" class="membership-doc-preview mt-2" style="display:none;max-width:180px;max-height:120px;">
                </div>
            </div>
        @endforeach
    </div>

    <div class="form-check mt-4">
        <input class="form-check-input" type="checkbox" name="terms_accepted" id="terms_accepted" value="1" required @checked(old('terms_accepted'))>
        <label class="form-check-label" for="terms_accepted">{{ __('app.agree_terms_and_privacy') }}</label>
    </div>
</div>
