<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'main_image',
        'sub_image',
        'price',
        'status',
    ];

    protected $casts = [
        'sub_image' => 'array',
    ];

    protected $attributes = [
        'sub_image' => '[]', // Default to empty array
    ];

    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? Storage::url($this->main_image) : null;
    }

    public function getSubImageUrlAttribute()
    {
        $imgs = [];
        foreach ($this->sub_image ?? [] as $image) { // Ensure sub_image is an array
            $imgs[] = Storage::url($image);
        }
        return $imgs;
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