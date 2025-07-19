<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'position_ar',
        'position_en',
        'image',
        'status',
        'committee_id',
        'council_id'
    ];

    // Relations
    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }

    public function council()
    {
        return $this->belongsTo(Council::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
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
