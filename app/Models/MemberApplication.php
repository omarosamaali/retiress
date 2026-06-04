<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberApplication extends Model
{
    use HasFactory;

    public const MEMBERSHIP_FILTER_EXPIRED = 'expired';

    public const MEMBERSHIP_FILTER_NOT_EXPIRED = 'not_expired';

    public const MEMBERSHIP_FILTER_ACTIVE = 'active';

    public const MEMBERSHIP_FILTER_PENDING_PAYMENT = 'pending_payment';

    public const MEMBERSHIP_FILTER_PENDING_ACTIVATION = 'pending_activation';

    public const MEMBERSHIP_FILTER_PENDING_APPROVAL = 'pending_approval';

    public const MEMBERSHIP_FILTER_NONE = 'none';

    public const MEMBERSHIP_STATUS_FILTERS = [
        self::MEMBERSHIP_FILTER_EXPIRED => 'منتهية',
        self::MEMBERSHIP_FILTER_NOT_EXPIRED => 'غير منتهية',
        self::MEMBERSHIP_FILTER_ACTIVE => 'فعالة',
        self::MEMBERSHIP_FILTER_PENDING_PAYMENT => 'بانتظار الدفع',
        self::MEMBERSHIP_FILTER_PENDING_ACTIVATION => 'بانتظار التفعيل',
        self::MEMBERSHIP_FILTER_PENDING_APPROVAL => 'بانتظار الموافقة',
        self::MEMBERSHIP_FILTER_NONE => 'بدون عضوية',
    ];

    protected $table = 'member_applications';

    protected $fillable = [
        'user_id',
        'full_name',
        'nationality',
        'date_of_birth',
        'gender',
        'expiration_warning_sent_at',
        'emirate',
        'expiration_date',
        'marital_status',
        'national_id',
        'educational_qualification',
        'passport_photo_path',
        'national_id_photo_path',
        'personal_photo_path',
        'educational_qualification_photo_path',
        'retirement_card_photo_path',
        'mobile_phone',
        'front_id',
        'back_id',
        'home_phone',
        'email',
        'po_box',
        'membership_number',
        'status',
        'retirement_date',
        'contract_type',
        'early_reason',
        'professional_experiences',
        'previous_experience',
        'pension',
    ];

    /**
     * Cast attributes to native types.
     * ده هيحول البيانات من JSON string لمصفوفة PHP تلقائياً والعكس.
     *
     * @var array
     */
    protected $casts = [
        'professional_experiences' => 'array',
        'previous_experience' => 'array',
        'date_of_birth' => 'date',
        'retirement_date' => 'date',
        'expiration_date' => 'datetime',
    ];


    /**
     * العلاقة مع المستخدم الذي يملك طلب العضوية هذا.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isExpiredByDate(): bool
    {
        return $this->expiration_date
            && Carbon::parse($this->expiration_date)->endOfDay()->isPast();
    }

    public function scopeMembershipExpired(Builder $query): Builder
    {
        return $query->where(function (Builder $q) {
            $q->where('status', '4')
                ->orWhere(function (Builder $q2) {
                    $q2->whereNotNull('expiration_date')
                        ->whereDate('expiration_date', '<', now()->toDateString());
                });
        });
    }

    public function scopeMembershipNotExpired(Builder $query): Builder
    {
        return $query->where(function (Builder $q) {
            $q->where('status', '!=', '4')
                ->where(function (Builder $q2) {
                    $q2->whereNull('expiration_date')
                        ->orWhereDate('expiration_date', '>=', now()->toDateString());
                });
        });
    }

    public function getStatusTextAttribute(): string
    {
        if ($this->isExpiredByDate() || (string) $this->status === '4') {
            return 'منتهية';
        }

        return match ((string) $this->status) {
            '0' => 'بانتظار الدفع',
            '1' => 'بانتظار التفعيل',
            '2' => 'بانتظار الموافقة',
            '3' => 'فعالة',
            default => 'غير محددة',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        if ($this->isExpiredByDate() || (string) $this->status === '4') {
            return 'bg-danger';
        }

        return match ((string) $this->status) {
            '0' => 'bg-danger',
            '1' => 'bg-secondary',
            '2' => 'bg-primary',
            '3' => 'bg-success',
            default => 'bg-secondary',
        };
    }

    public function getMembershipTypeLabelAttribute(): string
    {
        return match ($this->contract_type) {
            'نظامي' => 'تقاعد نظامي',
            'مبكر' => 'تقاعد مبكر',
            default => 'غير محدد',
        };
    }

    public function getPensionLabelAttribute(): string
    {
        if (blank($this->pension)) {
            return '—';
        }

        $translationKey = 'app.'.$this->pension;
        $label = __($translationKey);

        return $label !== $translationKey ? $label : $this->pension;
    }

    public function getGenderLabelAttribute(): string
    {
        return match ($this->gender) {
            'male', 'ذكر' => 'ذكر',
            'female', 'انثي', 'أنثى' => 'أنثى',
            default => $this->gender ?: '—',
        };
    }

    public function getMaritalStatusLabelAttribute(): string
    {
        return match ($this->marital_status) {
            'single' => 'أعزب / عزباء',
            'married' => 'متزوج / متزوجة',
            'divorced' => 'مطلق / مطلقة',
            'widowed' => 'أرمل / أرملة',
            'separated' => 'منفصل / منفصلة',
            'engaged' => 'مخطوب / مخطوبة',
            default => $this->marital_status ?: '—',
        };
    }

    public function latestProfessionalExperience(): ?array
    {
        $experiences = collect($this->professional_experiences ?? [])
            ->filter(fn ($row) => filled($row['job_title'] ?? null) || filled($row['employer'] ?? null));

        if ($experiences->isEmpty()) {
            $experiences = collect($this->previous_experience ?? [])
                ->filter(fn ($row) => filled($row['job_title'] ?? null) || filled($row['employer'] ?? null));
        }

        if ($experiences->isEmpty()) {
            return null;
        }

        return $experiences
            ->sortByDesc(fn ($row) => (int) preg_replace('/\D/', '', (string) ($row['year'] ?? '0')))
            ->first();
    }

    public function membershipDisplayStatus(): array
    {
        if ($this->isExpiredByDate() || (string) $this->status === '4') {
            return [
                'key' => 'expired',
                'label' => __('app.membership_status_expired'),
                'days_left' => null,
                'badge_class' => 'membership-status--expired',
            ];
        }

        if ((string) $this->status === '3' && $this->expiration_date) {
            $expiry = Carbon::parse($this->expiration_date)->startOfDay();
            $daysLeft = (int) today()->diffInDays($expiry, false);

            if ($daysLeft < 0) {
                return [
                    'key' => 'expired',
                    'label' => __('app.membership_status_expired'),
                    'days_left' => null,
                    'badge_class' => 'membership-status--expired',
                ];
            }

            if ($daysLeft <= 30) {
                return [
                    'key' => 'expiring',
                    'label' => __('app.membership_status_expiring', ['days' => $daysLeft]),
                    'days_left' => $daysLeft,
                    'badge_class' => 'membership-status--expiring',
                ];
            }

            return [
                'key' => 'active',
                'label' => __('app.membership_status_active'),
                'days_left' => $daysLeft,
                'badge_class' => 'membership-status--active',
            ];
        }

        return [
            'key' => 'pending',
            'label' => $this->status_text,
            'days_left' => null,
            'badge_class' => 'membership-status--pending',
        ];
    }

    public function isMembershipActiveForCard(): bool
    {
        return $this->user?->hasActiveMembership() ?? false;
    }

    public function toMembershipCardPayload(): array
    {
        $status = $this->membershipDisplayStatus();
        $experience = $this->latestProfessionalExperience();
        $showDetails = $this->isMembershipActiveForCard();

        return [
            'show_details' => $showDetails,
            'status' => $status,
            'full_name' => $showDetails ? ($this->full_name ?: $this->user?->name) : null,
            'photo_url' => $showDetails && $this->personal_photo_path
                ? asset('storage/'.$this->personal_photo_path)
                : null,
            'job_title' => $showDetails ? ($experience['job_title'] ?? null) : null,
            'employer' => $showDetails ? ($experience['employer'] ?? null) : null,
            'membership_number' => $showDetails ? $this->membership_number : null,
            'expiration_date' => $showDetails && $this->expiration_date
                ? Carbon::parse($this->expiration_date)->translatedFormat('d/m/Y')
                : null,
            'renew_url' => route('members.my-membership'),
        ];
    }
}
