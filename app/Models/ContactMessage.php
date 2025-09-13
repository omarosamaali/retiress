<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';
    use HasFactory;

    protected $fillable = [
        'name',
        'phone', 
        'email',
        'type',
        'message',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    // Accessors
    public function getTypeInArabicAttribute()
    {
        $types = [
            'complaint' => 'شكوى',
            'suggestion' => 'اقتراح', 
            'other' => 'أخرى'
        ];
        
        return $types[$this->type] ?? $this->type;
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('Y-m-d H:i');
    }

    // Methods
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }
}

