<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushSubscription extends Model
{
    protected $fillable = ['member_id', 'endpoint', 'p256dh_key', 'auth_token'];
}
