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

    <h4 class="membership-step-subheading">{{ __('app.previous_professional_details') }}</h4>
    <p class="text-muted small">{{ __('app.professional_optional_hint') }}</p>
    <div class="table-responsive">
        <table class="table professional-table" id="professionalTable">
            <thead>
                <tr>
                    <th>{{ __('app.year') }}</th>
                    <th>{{ __('app.job_title') }}</th>
                    <th>{{ __('app.employer') }}</th>
                    <th>{{ __('app.years_of_experience') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="professionalTableBody">
                <tr>
                    <td><input type="text" name="professional_experience[0][year]" class="form-control" placeholder="{{ __('app.example_year_range') }}"></td>
                    <td><input type="text" name="professional_experience[0][job_title]" class="form-control" placeholder="{{ __('app.example_job_title') }}"></td>
                    <td><input type="text" name="professional_experience[0][employer]" class="form-control" placeholder="{{ __('app.example_employer') }}"></td>
                    <td><input type="text" name="professional_experience[0][years_of_experience]" class="form-control" placeholder="{{ __('app.example_years_exp') }}"></td>
                    <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteProfessionalRow(this)">{{ __('app.delete') }}</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-sm btn-success mb-0" onclick="addNewProfessionalRow()">{{ __('app.add_professional_data') }}</button>
</div>
