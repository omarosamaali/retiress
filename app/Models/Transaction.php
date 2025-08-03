<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id','service_id', 'status', 'subscribed_at', 'receipt_image','type']; // أضف 'receipt_image' هنا

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
