<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'address',
        'office_number',
        'whatsapp',
        'email',
        'work_days',
        'holidays',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'tiktok_url',
        'ios_url',
        'android_url',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // دالة للحصول على بيانات التواصل النشطة
    public static function getActiveContactInfo()
    {
        return self::where('is_active', 1)->first();
    }

    // دالة للحصول على روابط السوشيال ميديا فقط
    public function getSocialLinksAttribute()
    {
        return [
            'facebook' => $this->facebook_url,
            'instagram' => $this->instagram_url,
            'youtube' => $this->youtube_url,
            'tiktok' => $this->tiktok_url
        ];
    }

    // دالة للتحقق من وجود روابط سوشيال ميديا
    public function hasSocialLinks()
    {
        return !empty($this->facebook_url) || 
               !empty($this->instagram_url) || 
               !empty($this->youtube_url) || 
               !empty($this->tiktok_url);
    }

    // دالة لتنسيق البريد الإلكتروني
    public function getFormattedEmailAttribute()
    {
        return $this->email ? "mailto:" . $this->email : null;
    }

    // دالة لتنسيق رقم الواتس آب
    public function getFormattedWhatsappAttribute()
    {
        if (!$this->whatsapp) return null;
        
        $whatsapp = preg_replace('/[^0-9]/', '', $this->whatsapp);
        return "https://wa.me/" . $whatsapp;
    }
}
