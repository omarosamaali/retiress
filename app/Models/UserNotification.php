<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNotification extends Model
{
    protected $fillable = [
        'member_broadcast_notification_id',
        'user_id',
        'read_at',
        'dismissed_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'dismissed_at' => 'datetime',
    ];

    public function broadcast(): BelongsTo
    {
        return $this->belongsTo(MemberBroadcastNotification::class, 'member_broadcast_notification_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVisibleInBell(Builder $query): Builder
    {
        return $query->whereNull('dismissed_at');
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull('read_at');
    }
}
