<?php

namespace App\Models;

// ... other use statements ...
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Event;
use App\Models\Message;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ADMIN_PANEL_ROLES = [
        'مدير',
        'مشرف',
        'موظف استقبال',
        'أمين الصندوق',
        'مدخل بيانات',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // <--- تأكد أن 'name' موجود هنا
        'name_ar', // <--- وتأكد من وجود هذه أيضاً إذا كنت تريد حفظها
        'name_en',
        'email',
        'password',
        'phone_number',
        'phone_verified_at',
        'profile_image',
        'user_type',
        'status',
        'role',
        // 'otp',
        'otp_expires_at', // Make sure this is in fillable if you set it directly
        'contract_signed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'otp_expires_at' => 'datetime', // <--- Add this line!
        'phone_verified_at' => 'datetime', // Good practice if it's a timestamp
        'contract_signed_at' => 'datetime', // Good practice if it's a timestamp
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->canAccessAdminPanel();
    }

    public function canAccessAdminPanel(): bool
    {
        $role = trim((string) $this->role);

        return in_array($role, self::ADMIN_PANEL_ROLES, true);
    }

    public function isStaff(): bool
    {
        return $this->canAccessAdminPanel() || (bool) ($this->is_admin ?? false);
    }

    public function isMemberRole(): bool
    {
        return $this->role === 'عضو';
    }

    public function scopeStaff(Builder $query): Builder
    {
        return $query->where(function (Builder $q) {
            $q->whereIn('role', self::ADMIN_PANEL_ROLES)
                ->orWhere('is_admin', true);
        });
    }

    public function scopeMembers(Builder $query): Builder
    {
        return $query->where('role', 'عضو');
    }

    public function isActive()
    {
        return $this->status === 'فعال';
    }

    public function resolvedPhone(): ?string
    {
        return $this->phone_number
            ?: $this->memberApplication?->mobile_phone
            ?: $this->memberApplication?->home_phone;
    }

    public function canViewMemberOnlyAnnouncements(): bool
    {
        return $this->isActive() && $this->role === 'عضو';
    }

    public function canSubscribeToEvent(Event $event): bool
    {
        return $this->getSubscribeToEventBlockReason($event) === null;
    }

    public function getSubscribeToEventBlockReason(Event $event): ?string
    {
        if (! $event->isVisibleTo($this)) {
            return 'not_visible';
        }

        // إعلانات للجميع — أي مستخدم مسجل يمكنه الاشتراك
        if (! $event->isForMembersOnly()) {
            return null;
        }

        // إعلانات للأعضاء فقط — يجب عضوية فعالة بأكثر من 3 أشهر
        if (! $this->memberApplication) {
            return 'membership_required';
        }

        if (! $this->hasActiveMembership()) {
            return 'membership_inactive';
        }

        if (! $this->hasMembershipWithMonthsRemaining(3)) {
            return 'membership_expiring_soon';
        }

        return null;
    }

    public function hasMembershipWithMonthsRemaining(int $months): bool
    {
        $application = $this->memberApplication;
        if (! $application || ! $application->expiration_date) {
            return false;
        }
        return \Carbon\Carbon::parse($application->expiration_date)->isAfter(now()->addMonths($months));
    }

    public function getRoleBadgeClass()
    {
        return match ($this->role) {
            'مدير' => 'bg-primary',
            'موظف استقبال' => 'bg-success',
            'مدخل بيانات' => 'bg-warning text-dark',
            'عضو' => 'bg-info',
            default => 'bg-secondary'
        };
    }
    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'فعال' => 'فعال',
            'غير فعال' => 'غير فعال',
            'بانتظار التفعيل' => 'بانتظار التفعيل',
            'بإنتظار إستكمال البيانات' => 'بإنتظار إستكمال البيانات',
            default => 'غير معروف'
        };
    }
    public function getStatusBadgeClass()
    {
        return match ($this->status) {
            'فعال' => 'badge-success',
            'غير فعال' => 'badge-danger',
            'بانتظار التفعيل' => 'badge-warning',
            default => 'badge-secondary'
        };
    }

    public function membership()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }

    public function hasActiveMembership(): bool
    {
        $application = $this->memberApplication;

        if (! $application) {
            return false;
        }

        if ($application->isExpiredByDate() || (string) $application->status === '4') {
            return false;
        }

        return (string) $application->status === '3';
    }

    /**
     * تحديد علاقة المستخدم مع طلبات العضوية.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function memberApplications()
    {
        return $this->hasMany(MemberApplication::class);
    }

    public function memberApplication()
    {
        return $this->hasOne(MemberApplication::class);
    }

    public function userNotifications(): HasMany
    {
        return $this->hasMany(UserNotification::class);
    }

    public function unreadUserNotificationsCount(): int
    {
        return $this->userNotifications()
            ->visibleInBell()
            ->unread()
            ->count();
    }

    public function unreadChatMessagesCount(): int
    {
        return Message::where('to_user_id', $this->id)
            ->whereNull('read_at')
            ->count();
    }

    public function headerNotificationCount(): int
    {
        return $this->unreadUserNotificationsCount() + $this->unreadChatMessagesCount();
    }

    public function scopeFilterMembershipStatus($query, ?string $status)
    {
        if (blank($status) || ! array_key_exists($status, MemberApplication::MEMBERSHIP_STATUS_FILTERS)) {
            return $query;
        }

        return match ($status) {
            MemberApplication::MEMBERSHIP_FILTER_NONE => $query->whereDoesntHave('memberApplication'),
            MemberApplication::MEMBERSHIP_FILTER_EXPIRED => $query->whereHas(
                'memberApplication',
                fn ($q) => $q->membershipExpired()
            ),
            MemberApplication::MEMBERSHIP_FILTER_NOT_EXPIRED => $query->whereHas(
                'memberApplication',
                fn ($q) => $q->membershipNotExpired()
            ),
            MemberApplication::MEMBERSHIP_FILTER_ACTIVE => $query->whereHas(
                'memberApplication',
                fn ($q) => $q->membershipNotExpired()->where('status', '3')
            ),
            MemberApplication::MEMBERSHIP_FILTER_PENDING_PAYMENT => $query->whereHas(
                'memberApplication',
                fn ($q) => $q->membershipNotExpired()->where('status', '0')
            ),
            MemberApplication::MEMBERSHIP_FILTER_PENDING_ACTIVATION => $query->whereHas(
                'memberApplication',
                fn ($q) => $q->membershipNotExpired()->where('status', '1')
            ),
            MemberApplication::MEMBERSHIP_FILTER_PENDING_APPROVAL => $query->whereHas(
                'memberApplication',
                fn ($q) => $q->membershipNotExpired()->where('status', '2')
            ),
            default => $query,
        };
    }

    public function getMembershipStatusTextAttribute(): string
    {
        if (! $this->memberApplication) {
            return 'لا توجد عضوية';
        }

        return $this->memberApplication->status_text;
    }

    public function getMembershipStatusBadgeClassAttribute(): string
    {
        if (! $this->memberApplication) {
            return 'bg-secondary';
        }

        return $this->memberApplication->status_badge_class;
    }

    public function getMembershipTypeTextAttribute(): string
    {
        return $this->memberApplication?->membership_type_label ?? '—';
    }
}
