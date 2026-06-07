@php
    $application = $user->memberApplication;
@endphp

<div class="membership-section mt-5 pt-4 border-top">
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-2">
        <h4 class="mb-0">
            <i class="fas fa-id-card ms-2 text-primary"></i>
            بيانات العضوية
        </h4>
        <a href="{{ route('admin.manageMembership.edit', $application->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-edit ms-1"></i>
            تعديل طلب العضوية
        </a>
    </div>

    <h5 class="text-muted mb-3 fs-6">معلومات العضوية</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">رقم العضوية:</span>
                <div class="detail-value">{{ $application->membership_number ?: '—' }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">حالة العضوية:</span>
                <div class="detail-value">
                    <span class="badge {{ $application->status_badge_class }}">{{ $application->status_text }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">نوع العضوية:</span>
                <div class="detail-value">{{ $application->membership_type_label }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">تاريخ الانتهاء:</span>
                <div class="detail-value">
                    {{ $application->expiration_date ? \Carbon\Carbon::parse($application->expiration_date)->format('d/m/Y') : '—' }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">تاريخ تقديم الطلب:</span>
                <div class="detail-value">{{ $application->created_at?->format('d/m/Y H:i') ?? '—' }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">آخر تحديث للطلب:</span>
                <div class="detail-value">{{ $application->updated_at?->format('d/m/Y H:i') ?? '—' }}</div>
            </div>
        </div>
    </div>

    <h5 class="text-muted mb-3 fs-6 mt-2">البيانات الشخصية</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الاسم الكامل:</span>
                <div class="detail-value">{{ $application->full_name ?: '—' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الجنسية:</span>
                <div class="detail-value">{{ $application->nationality ?: '—' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">تاريخ الميلاد:</span>
                <div class="detail-value">{{ $application->date_of_birth?->format('d/m/Y') ?? '—' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الجنس:</span>
                <div class="detail-value">{{ $application->gender_label }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">رقم الهوية:</span>
                <div class="detail-value">{{ $application->national_id ?: '—' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الحالة الاجتماعية:</span>
                <div class="detail-value">{{ $application->marital_status_label }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الإمارة:</span>
                <div class="detail-value">{{ $application->emirate ?: '—' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">صندوق البريد:</span>
                <div class="detail-value">{{ $application->po_box ?: '—' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">المؤهل التعليمي:</span>
                <div class="detail-value">{{ $application->educational_qualification ?: '—' }}</div>
            </div>
        </div>
    </div>

    <h5 class="text-muted mb-3 fs-6 mt-2">بيانات التواصل</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">الهاتف المحمول:</span>
                <div class="detail-value">{{ $application->mobile_phone ?: '—' }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">هاتف المنزل:</span>
                <div class="detail-value">{{ $application->home_phone ?: '—' }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="detail-item">
                <span class="detail-label">البريد في الطلب:</span>
                <div class="detail-value" style="direction: ltr; text-align: right;">{{ $application->email ?: '—' }}</div>
            </div>
        </div>
    </div>

    <h5 class="text-muted mb-3 fs-6 mt-2">بيانات التقاعد</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">نوع التقاعد:</span>
                <div class="detail-value">{{ $application->contract_type ?: '—' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">تاريخ التقاعد:</span>
                <div class="detail-value">{{ $application->retirement_date?->format('d/m/Y') ?? '—' }}</div>
            </div>
        </div>
        @if ($application->early_reason)
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">سبب التقاعد المبكر:</span>
                    <div class="detail-value">{{ $application->early_reason }}</div>
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="detail-item">
                <span class="detail-label">جهة صرف المعاش:</span>
                <div class="detail-value">{{ $application->pension_label }}</div>
            </div>
        </div>
    </div>

    @php
        $documents = [
            'الصورة الشخصية' => $application->personal_photo_path,
            'صورة الجواز' => $application->passport_photo_path,
            'صورة الهوية' => $application->national_id_photo_path,
            'صورة المؤهل' => $application->educational_qualification_photo_path,
            'بطاقة التقاعد' => $application->retirement_card_photo_path,
            'البطاقة (أمام)' => $application->front_id,
            'البطاقة (خلف)' => $application->back_id,
        ];
        $hasDocuments = collect($documents)->filter()->isNotEmpty();
    @endphp

    @if ($hasDocuments)
        <h5 class="text-muted mb-3 fs-6 mt-2">المستندات والصور</h5>
        <div class="row">
            @foreach ($documents as $label => $path)
                @if ($path)
                    <div class="col-md-6 col-lg-4">
                        <div class="detail-item">
                            <span class="detail-label">{{ $label }}:</span>
                            <img src="{{ asset('storage/' . $path) }}" alt="{{ $label }}" class="image-preview w-100">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    @if (! empty($application->professional_experiences) && is_array($application->professional_experiences))
        <h5 class="text-muted mb-3 fs-6 mt-2">الخبرات المهنية</h5>
        @foreach ($application->professional_experiences as $index => $experience)
            <div class="detail-value mb-3">
                <strong>#{{ (int) $index + 1 }}</strong>
                — السنة: {{ $experience['year'] ?? '—' }}
                | المسمى: {{ $experience['job_title'] ?? '—' }}
                | جهة العمل: {{ $experience['employer'] ?? '—' }}
                | سنوات الخبرة: {{ $experience['years_of_experience'] ?? '—' }}
            </div>
        @endforeach
    @endif

    @if (! empty($application->previous_experience) && is_array($application->previous_experience))
        <h5 class="text-muted mb-3 fs-6 mt-2">خبرات سابقة</h5>
        @foreach ($application->previous_experience as $index => $experience)
            <div class="detail-value mb-3">
                <strong>#{{ (int) $index + 1 }}</strong>
                — السنة: {{ $experience['year'] ?? '—' }}
                | المسمى: {{ $experience['job_title'] ?? '—' }}
                | جهة العمل: {{ $experience['employer'] ?? '—' }}
                | سنوات الخبرة: {{ $experience['years_of_experience'] ?? '—' }}
            </div>
        @endforeach
    @endif
</div>
