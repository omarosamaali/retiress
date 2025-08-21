<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Magazine extends Model
{
    protected $table = 'magazines';

    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'member_id', // إضافة member_id هنا
        'main_image',
        'sub_image',
        'status',
    ];

    /**
     * تعريف العلاقة مع موديل MemberApplication
     */
    public function member()
    {
        return $this->belongsTo(MemberApplication::class, 'member_id');
    }


    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? Storage::url($this->main_image) : null;
    }

    public function getPdfUrlAttribute()
    {
        return $this->pdf ? Storage::url($this->pdf) : null;
    }


    public function getStatusBadgeClassAttribute()
    {
        return $this->status == 1 ? 'bg-success' : 'bg-danger';
    }

    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'فعال' : 'غير فعال';
    }
}
