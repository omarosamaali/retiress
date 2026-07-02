<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public const SUBSCRIPTION_STATUSES = [
        'pending',
        'waiting_for_payment',
        'waiting_for_activation',
        'active',
        'rejected',
        'expired',
        'deactivated',
    ];

    public const OPEN_STATUSES = [
        'pending',
        'waiting_for_payment',
        'waiting_for_activation',
        'active',
    ];

    protected $fillable = ['user_id', 'event_id', 'service_id', 'status', 'subscribed_at', 'receipt_image', 'type', 'membership_number'];

    protected $casts = [
        'subscribed_at' => 'datetime',
    ];

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'بانتظار الموافقة',
            'waiting_for_payment' => 'بانتظار الدفع',
            'waiting_for_activation' => 'بانتظار التفعيل',
            'active' => 'فعال',
            'rejected' => 'مرفوض',
            'expired' => 'منتهي',
            'deactivated' => 'غير فعال',
            default => $this->status ?? '—',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-secondary',
            'waiting_for_payment' => 'bg-warning text-dark',
            'waiting_for_activation' => 'bg-info',
            'active' => 'bg-success',
            'rejected' => 'bg-danger',
            'expired' => 'bg-dark',
            'deactivated' => 'bg-warning text-dark',
            default => 'bg-secondary',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'event' => 'إعلان / فعالية',
            'service' => 'خدمة',
            default => $this->type ?? '—',
        };
    }

    public function isOpenSubscription(): bool
    {
        return in_array($this->status, self::OPEN_STATUSES, true);
    }

    public function isExpiredSubscription(): bool
    {
        return in_array($this->status, ['expired', 'rejected', 'deactivated'], true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->subscribed_at)) {
                $transaction->subscribed_at = now();
            }
        });
    }
}
