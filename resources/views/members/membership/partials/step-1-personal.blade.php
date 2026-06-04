<div class="membership-step-panel" data-step-panel="1">
    <h3 class="membership-step-heading">{{ __('app.membership_step_1_title') }}</h3>
    <p class="text-muted small mb-3">{{ __('app.membership_step_1_hint') }}</p>

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label" for="full_name">{{ __('app.full_name') }} *</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required
                value="{{ old('full_name') }}" placeholder="{{ __('app.full_name_placeholder') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="membership_nationality">{{ __('app.nationality') }} *</label>
            @include('members.membership.partials.nationality-options')
        </div>
        <div class="col-md-4">
            <label class="form-label" for="date_of_birth">{{ __('app.date_of_birth') }} *</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required value="{{ old('date_of_birth') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label" for="gender">{{ __('app.gender') }} *</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="">{{ __('app.select') }}</option>
                <option value="male" @selected(old('gender') === 'male')>{{ __('app.male') }}</option>
                <option value="female" @selected(old('gender') === 'female')>{{ __('app.female') }}</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="emirate">{{ __('app.emirate') }} *</label>
            <select name="emirate" id="emirate" class="form-control" required>
                <option value="">{{ __('app.select') }}</option>
                @foreach (['أبو ظبي' => 'abu_dhabi', 'دبي' => 'dubai', 'الشارقة' => 'sharjah', 'عجمان' => 'ajman', 'الفجيرة' => 'fujairah', 'راس الخيمة' => 'ras_al_khaimah', 'أم القيوين' => 'um_al_quwain', 'العين' => 'al_ain'] as $val => $key)
                    <option value="{{ $val }}" @selected(old('emirate') === $val)>{{ __('app.'.$key) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="marital_status">{{ __('app.marital_status') }} *</label>
            <select name="marital_status" id="marital_status" class="form-control" required>
                <option value="">{{ __('app.select') }}</option>
                @foreach (['single', 'married', 'divorced', 'widowed', 'separated', 'engaged'] as $status)
                    <option value="{{ $status }}" @selected(old('marital_status') === $status)>{{ __('app.'.$status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="national_id">{{ __('app.national_id') }} *</label>
            <input type="text" name="national_id" id="national_id" class="form-control" required
                value="{{ old('national_id') }}" placeholder="{{ __('app.national_id_placeholder') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label" for="educational_qualification">{{ __('app.educational_qualification') }} *</label>
            <select name="educational_qualification" id="educational_qualification" class="form-control" required>
                <option value="">{{ __('app.select') }}</option>
                @foreach (['دكتوراه' => 'doctorate', 'ماجيستير' => 'masters', 'بكالوريوس' => 'bachelors', 'دبلوم' => 'diploma', 'ثانوي' => 'secondary', 'اعدادي' => 'preparatory', 'ابتدائي' => 'primary', 'غير ذلك' => 'other'] as $val => $key)
                    <option value="{{ $val }}" @selected(old('educational_qualification') === $val)>{{ __('app.'.$key) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <h4 class="membership-step-subheading mt-4">{{ __('app.retirement_details') }}</h4>
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label" for="retirement_date">{{ __('app.retirement_date') }}</label>
            <input type="date" name="retirement_date" id="retirement_date" class="form-control" value="{{ old('retirement_date') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label" for="contract_type">{{ __('app.contract_type') }} *</label>
            <select name="contract_type" id="contract_type" class="form-control" required>
                <option value="">{{ __('app.select') }}</option>
                <option value="نظامي" @selected(old('contract_type') === 'نظامي')>{{ __('app.regular') }}</option>
                <option value="مبكر" @selected(old('contract_type') === 'مبكر')>{{ __('app.early') }}</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="pension">{{ __('app.pension') }} *</label>
            <select name="pension" id="pension" class="form-control" required>
                <option value="">{{ __('app.select') }}</option>
                @foreach (['pensions_and_social', 'sharjah_social', 'dubai_social', 'pensions__social', 'ministry_of_defense', 'ministry_of_interior', 'police_dubai'] as $pensionKey)
                    <option value="{{ $pensionKey }}" @selected(old('pension') === $pensionKey)>{{ __('app.'.$pensionKey) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12" id="early_reason_container" style="display: {{ old('contract_type') === 'مبكر' ? 'block' : 'none' }};">
            <label class="form-label" for="early_reason">{{ __('app.early_reason') }}</label>
            <input type="text" name="early_reason" id="early_reason" class="form-control"
                value="{{ old('early_reason') }}" placeholder="{{ __('app.early_reason_placeholder') }}">
        </div>
    </div>
</div>
