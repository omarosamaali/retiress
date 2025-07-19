<?php

namespace App\Models;

// ... other use statements ...
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // <--- تأكد أن 'name' موجود هنا
        'name_ar', // <--- وتأكد من وجود هذه أيضاً إذا كنت تريد حفظها
        'name_en',
        'email',
        'password',
        'phone_number',
        'phone_verified_at',
        'profile_image',
        'user_type',
        'status',
        'role',
        // 'otp',
        'otp_expires_at', // Make sure this is in fillable if you set it directly
        'contract_signed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'otp_expires_at' => 'datetime', // <--- Add this line!
        'phone_verified_at' => 'datetime', // Good practice if it's a timestamp
        'contract_signed_at' => 'datetime', // Good practice if it's a timestamp
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // إزالة casts لـ status لأنه enum نصي
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'مدير';
    }

    public function isActive()
    {
        return $this->status === 'فعال';
    }

    public function getRoleBadgeClass()
    {
        return match ($this->role) {
            'مدير' => 'bg-primary',
            'موظف استقبال' => 'bg-success',
            'مدخل بيانات' => 'bg-warning text-dark',
            'عضو' => 'bg-info',
            default => 'bg-secondary'
        };
    }
    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'فعال' => 'فعال',
            'غير فعال' => 'غير فعال',
            'بانتظار التفعيل' => 'بانتظار التفعيل',
            'بإنتظار إستكمال البيانات' => 'بإنتظار إستكمال البيانات',
            default => 'غير معروف'
        };
    }
    public function getStatusBadgeClass()
    {
        return match ($this->status) {
            'فعال' => 'badge-success',
            'غير فعال' => 'badge-danger',
            'بانتظار التفعيل' => 'badge-warning',
            default => 'badge-secondary'
        };
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'chef_id', 'user_id');
    }

    public function chefProfile()
    {
        return $this->hasOne(ChefProfile::class);
    }

    public function deliveryLocations()
    {
        return $this->hasMany(DeliveryLocation::class);
    }

    
}
