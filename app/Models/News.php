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
        'youtube_url',
        'price',
        'status',
        'created_at',
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

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (! $this->youtube_url) return null;

        $url = trim($this->youtube_url);

        // youtu.be/ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // youtube.com/watch?v=ID or /embed/ID
        if (preg_match('/(?:v=|\/embed\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        return null;
    }
}