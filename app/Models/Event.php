<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    public const TYPES = ['فعالية', 'دورة', 'محاضرة', 'خدمات', 'اجتماعات'];

    public const AUDIENCE_ALL = 'للجميع';

    public const AUDIENCE_MEMBERS_ONLY = 'للأعضاء فقط';

    public const AUDIENCES = [self::AUDIENCE_ALL, self::AUDIENCE_MEMBERS_ONLY];

    protected $fillable = [
        'type',
        'audience',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'main_image',
        'sub_image',
        'price',
        'starts_at',
        'ends_at',
        'subscription_deadline',
        'status',
        'created_at',
    ];

    protected $casts = [
        'starts_at'             => 'datetime',
        'ends_at'               => 'datetime',
        'subscription_deadline' => 'datetime',
        'status'                => 'boolean',
    ];

    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? Storage::url($this->main_image) : null;
    }

    public function getSubImageUrlAttribute()
    {
        return $this->sub_image ? Storage::url($this->sub_image) : null;
    }

    public function getStatusBadgeClassAttribute()
    {
        return $this->status == 1 ? 'bg-success' : 'bg-danger';
    }

    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'فعال' : 'غير فعال';
    }

    public function getTypeLabelAttribute(): string
    {
        // إذا كان النوع القديم "مميزات" نعرضه كـ "خدمات" بدون تعديل DB
        if ($this->type === 'مميزات') return 'خدمات';
        return in_array($this->type, self::TYPES, true) ? $this->type : 'فعالية';
    }

    public function getTypeBadgeClassAttribute(): string
    {
        return match ($this->type) {
            'دورة'              => 'event-type-badge--course',
            'محاضرة'            => 'event-type-badge--lecture',
            'فعالية'            => 'event-type-badge--event',
            'خدمات', 'مميزات'  => 'event-type-badge--feature',
            'اجتماعات'          => 'event-type-badge--meeting',
            default             => 'event-type-badge--default',
        };
    }

    public function getAudienceLabelAttribute(): string
    {
        return in_array($this->audience, self::AUDIENCES, true) ? $this->audience : self::AUDIENCE_ALL;
    }

    /** @deprecated Use starts_at; kept for legacy blades referencing event_date */
    public function getEventDateAttribute(): ?Carbon
    {
        return $this->display_starts_at;
    }

    public function getDisplayStartsAtAttribute(): ?Carbon
    {
        $value = $this->starts_at ?? $this->created_at;

        return $value ? Carbon::parse($value) : null;
    }

    public function getDisplayEndsAtAttribute(): ?Carbon
    {
        return $this->ends_at ? Carbon::parse($this->ends_at) : null;
    }

    public function hasScheduleEnd(): bool
    {
        return $this->ends_at !== null;
    }

    public function isExpired(): bool
    {
        return $this->ends_at !== null && \Carbon\Carbon::parse($this->ends_at)->isPast();
    }

    public function isRegistrationClosed(): bool
    {
        return $this->subscription_deadline !== null
            && \Carbon\Carbon::parse($this->subscription_deadline)->isPast();
    }

    public function getSubscriptionDeadlineTimestampAttribute(): ?int
    {
        return $this->subscription_deadline
            ? \Carbon\Carbon::parse($this->subscription_deadline)->timestamp
            : null;
    }

    public function isFree(): bool
    {
        return $this->price === null || (int) $this->price === 0;
    }

    public function isForMembersOnly(): bool
    {
        return $this->audience === self::AUDIENCE_MEMBERS_ONLY;
    }

    public function isVisibleTo(?User $user = null): bool
    {
        if ((int) $this->status !== 1) {
            return false;
        }

        if ($this->audience === self::AUDIENCE_ALL) {
            return true;
        }

        $user = $user ?? Auth::user();

        return $user && $user->canViewMemberOnlyAnnouncements();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 1);
    }

    public function scopeVisibleToAudience(Builder $query, ?User $user = null): Builder
    {
        $user = $user ?? Auth::user();

        return $query->where(function (Builder $q) use ($user) {
            $q->where('audience', self::AUDIENCE_ALL);

            if ($user && $user->canViewMemberOnlyAnnouncements()) {
                $q->orWhere('audience', self::AUDIENCE_MEMBERS_ONLY);
            }
        });
    }

    public function scopeNotExpired(Builder $query): Builder
    {
        return $query->where(function (Builder $q) {
            $q->whereNull('ends_at')
              ->orWhere('ends_at', '>=', now());
        });
    }

    public function scopePubliclyListed(Builder $query, ?User $user = null): Builder
    {
        return $query->published()->visibleToAudience($user)->notExpired();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function latestSubscriptionFor(?User $user): ?Transaction
    {
        if (! $user) {
            return null;
        }

        return $this->transactions()
            ->where('user_id', $user->id)
            ->latest('subscribed_at')
            ->first();
    }

    public function userHasOpenSubscription(?User $user): bool
    {
        $subscription = $this->latestSubscriptionFor($user);

        return $subscription && $subscription->isOpenSubscription();
    }
}
