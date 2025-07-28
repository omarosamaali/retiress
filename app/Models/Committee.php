<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image',
        'status',
    ];

    // Relations
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function getStatusBadgeClassAttribute()
    {
        return $this->status ? 'bg-success' : 'bg-danger';
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'فعال' : 'غير فعال';
    }
}
