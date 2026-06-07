@php
    $memberData = $member ?? (isset($user) ? $user->memberApplication : null) ?? new \App\Models\MemberApplication([
        'status' => '3',
        'gender' => 'male',
        'full_name' => old('name'),
        'email' => old('email'),
    ]);
    $professionalExperiences = old(
        'professional_experiences',
        $memberData->professional_experiences ?: [['year' => '', 'job_title' => '', 'employer' => '', 'years_of_experience' => '']]
    );
    $previousExperiences = old(
        'previous_experience',
        $memberData->previous_experience ?: [['year' => '', 'job_title' => '', 'employer' => '', 'years_of_experience' => '']]
    );
@endphp

<div class="membership-edit-section mt-5 pt-4 border-top">
    <h5 class="mb-4 text-primary">
        <i class="fas fa-id-card ms-2"></i>
        بيانات العضوية
    </h5>

    <div class="row">
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">حالة العضوية:</span>
                <select class="form-select" name="membership_status" required>
                    @foreach (['0' => 'بانتظار الدفع', '1' => 'بانتظار التفعيل', '2' => 'بانتظار الموافقة', '3' => 'فعالة', '4' => 'منتهية'] as $value => $label)
                        <option value="{{ $value }}" {{ old('membership_status', $memberData->status) == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('membership_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">رقم العضوية:</span>
                <input type="text" class="form-control" name="membership_number"
                    value="{{ old('membership_number', $memberData->membership_number) }}">
                @error('membership_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">تاريخ الانتهاء:</span>
                <input type="date" class="form-control" name="expiration_date"
                    value="{{ old('expiration_date', $memberData->expiration_date ? \Carbon\Carbon::parse($memberData->expiration_date)->format('Y-m-d') : '') }}">
                @error('expiration_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <h6 class="text-muted mt-3 mb-3">البيانات الشخصية</h6>
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الاسم الكامل:</span>
                <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $memberData->full_name) }}" required>
                @error('full_name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الجنسية:</span>
                <input type="text" class="form-control" name="nationality" value="{{ old('nationality', $memberData->nationality) }}" required>
                @error('nationality')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">تاريخ الميلاد:</span>
                <input type="date" class="form-control" name="date_of_birth"
                    value="{{ old('date_of_birth', $memberData->date_of_birth?->format('Y-m-d')) }}" required>
                @error('date_of_birth')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الجنس:</span>
                <select class="form-select" name="gender" required>
                    <option value="male" {{ old('gender', $memberData->gender) === 'male' ? 'selected' : '' }}>ذكر</option>
                    <option value="female" {{ old('gender', $memberData->gender) === 'female' ? 'selected' : '' }}>أنثى</option>
                </select>
                @error('gender')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">رقم الهوية:</span>
                <input type="text" class="form-control" name="national_id" value="{{ old('national_id', $memberData->national_id) }}" required>
                @error('national_id')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الحالة الاجتماعية:</span>
                <select class="form-select" name="marital_status">
                    <option value="">—</option>
                    @foreach (['single' => 'أعزب / عزباء', 'married' => 'متزوج / متزوجة', 'divorced' => 'مطلق / مطلقة', 'widowed' => 'أرمل / أرملة', 'separated' => 'منفصل / منفصلة', 'engaged' => 'مخطوب / مخطوبة'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('marital_status', $memberData->marital_status) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
                @error('marital_status')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الإمارة:</span>
                <input type="text" class="form-control" name="emirate" value="{{ old('emirate', $memberData->emirate) }}" required>
                @error('emirate')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">المؤهل التعليمي:</span>
                <input type="text" class="form-control" name="educational_qualification"
                    value="{{ old('educational_qualification', $memberData->educational_qualification) }}" required>
                @error('educational_qualification')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">صندوق البريد:</span>
                <input type="text" class="form-control" name="po_box" value="{{ old('po_box', $memberData->po_box) }}">
                @error('po_box')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <h6 class="text-muted mt-3 mb-3">بيانات التواصل (العضوية)</h6>
    <div class="row">
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">الهاتف المحمول:</span>
                <input type="text" class="form-control" name="mobile_phone" value="{{ old('mobile_phone', $memberData->mobile_phone) }}" required>
                @error('mobile_phone')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">هاتف المنزل:</span>
                <input type="text" class="form-control" name="home_phone" value="{{ old('home_phone', $memberData->home_phone) }}">
                @error('home_phone')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">البريد في الطلب:</span>
                <input type="email" class="form-control" name="membership_email" value="{{ old('membership_email', $memberData->email) }}" required>
                @error('membership_email')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <h6 class="text-muted mt-3 mb-3">بيانات التقاعد</h6>
    <div class="row">
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">نوع التقاعد:</span>
                <select class="form-select" name="contract_type">
                    <option value="">—</option>
                    <option value="نظامي" {{ old('contract_type', $memberData->contract_type) === 'نظامي' ? 'selected' : '' }}>نظامي</option>
                    <option value="مبكر" {{ old('contract_type', $memberData->contract_type) === 'مبكر' ? 'selected' : '' }}>مبكر</option>
                </select>
                @error('contract_type')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">تاريخ التقاعد:</span>
                <input type="date" class="form-control" name="retirement_date"
                    value="{{ old('retirement_date', $memberData->retirement_date?->format('Y-m-d')) }}">
                @error('retirement_date')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">جهة صرف المعاش:</span>
                <select class="form-select" name="pension">
                    <option value="">{{ __('app.select') }}</option>
                    @foreach (['pensions_and_social', 'sharjah_social', 'dubai_social', 'pensions__social', 'ministry_of_defense', 'ministry_of_interior', 'police_dubai'] as $pensionKey)
                        <option value="{{ $pensionKey }}" {{ old('pension', $memberData->pension) === $pensionKey ? 'selected' : '' }}>
                            {{ __('app.'.$pensionKey) }}
                        </option>
                    @endforeach
                </select>
                @error('pension')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="detail-item">
                <span class="detail-label">سبب التقاعد المبكر:</span>
                <textarea class="form-control" name="early_reason" rows="2">{{ old('early_reason', $memberData->early_reason) }}</textarea>
                @error('early_reason')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <h6 class="text-muted mt-3 mb-3">المستندات (ارفع ملفاً جديداً لاستبدال الحالي)</h6>
    @php
        $documentFields = [
            'personal_photo' => ['label' => 'الصورة الشخصية', 'path' => $memberData->personal_photo_path],
            'passport_photo' => ['label' => 'صورة الجواز', 'path' => $memberData->passport_photo_path],
            'national_id_photo' => ['label' => 'صورة الهوية', 'path' => $memberData->national_id_photo_path],
            'educational_qualification_photo' => ['label' => 'صورة المؤهل', 'path' => $memberData->educational_qualification_photo_path],
            'retirement_card_photo' => ['label' => 'بطاقة التقاعد', 'path' => $memberData->retirement_card_photo_path],
            'front_id' => ['label' => 'البطاقة (أمام)', 'path' => $memberData->front_id],
            'back_id' => ['label' => 'البطاقة (خلف)', 'path' => $memberData->back_id],
        ];
    @endphp
    <div class="row">
        @foreach ($documentFields as $fieldName => $doc)
            <div class="col-md-6 col-lg-4">
                <div class="detail-item">
                    <span class="detail-label">{{ $doc['label'] }}:</span>
                    @if ($doc['path'])
                        <img src="{{ asset('storage/'.$doc['path']) }}" alt="{{ $doc['label'] }}" class="image-preview w-100 mb-2">
                    @endif
                    <input type="file" class="form-control" name="{{ $fieldName }}" accept="image/*,.pdf">
                    @error($fieldName)<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        @endforeach
    </div>

    <h6 class="text-muted mt-3 mb-3">الخبرات المهنية</h6>
    <div id="professional-experiences">
        @foreach ($professionalExperiences as $index => $experience)
            <div class="row experience-row mb-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="professional_experiences[{{ $index }}][year]"
                        placeholder="السنة" value="{{ $experience['year'] ?? '' }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="professional_experiences[{{ $index }}][job_title]"
                        placeholder="المسمى" value="{{ $experience['job_title'] ?? '' }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="professional_experiences[{{ $index }}][employer]"
                        placeholder="جهة العمل" value="{{ $experience['employer'] ?? '' }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="professional_experiences[{{ $index }}][years_of_experience]"
                        placeholder="سنوات الخبرة" value="{{ $experience['years_of_experience'] ?? '' }}">
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-professional-experience">+ إضافة خبرة</button>

    <h6 class="text-muted mt-3 mb-3">خبرات سابقة</h6>
    <div id="previous-experiences">
        @foreach ($previousExperiences as $index => $experience)
            <div class="row experience-row mb-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="previous_experience[{{ $index }}][year]"
                        placeholder="السنة" value="{{ $experience['year'] ?? '' }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="previous_experience[{{ $index }}][job_title]"
                        placeholder="المسمى" value="{{ $experience['job_title'] ?? '' }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="previous_experience[{{ $index }}][employer]"
                        placeholder="جهة العمل" value="{{ $experience['employer'] ?? '' }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="previous_experience[{{ $index }}][years_of_experience]"
                        placeholder="سنوات الخبرة" value="{{ $experience['years_of_experience'] ?? '' }}">
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-previous-experience">+ إضافة خبرة سابقة</button>
</div>
