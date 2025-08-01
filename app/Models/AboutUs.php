<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'key', // المفتاح دا بيعبر عن نوع المحتوي
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'main_image',
        'sub_image',
        'status',
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
        return $this->status ? 'bg-success' : 'bg-danger';
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'فعال' : 'غير فعال';
    }
}
