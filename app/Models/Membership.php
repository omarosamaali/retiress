<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
    ];

    public function user()
    {
return $this->hasOne(User::class, 'id', 'user_id');    }
}
