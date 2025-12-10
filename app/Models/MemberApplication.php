<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberApplication extends Model
{
    use HasFactory;

    protected $table = 'member_applications';

    protected $fillable = [
        'user_id',
        'full_name',
        'nationality',
        'date_of_birth',
        'gender',
        'expiration_warning_sent_at',
        'emirate',
        'expiration_date',
        'marital_status',
        'national_id',
        'educational_qualification',
        'passport_photo_path',
        'national_id_photo_path',
        'personal_photo_path',
        'educational_qualification_photo_path',
        'retirement_card_photo_path',
        'mobile_phone',
        'front_id',
        'back_id',
        'home_phone',
        'email',
        'po_box',
        'membership_number',
        'status',
        'retirement_date',
        'contract_type',
        'early_reason',
        'professional_experiences',
        'previous_experience',
        'pension',
    ];

    /**
     * Cast attributes to native types.
     * ده هيحول البيانات من JSON string لمصفوفة PHP تلقائياً والعكس.
     *
     * @var array
     */
    protected $casts = [
        'professional_experiences' => 'array',
        'previous_experience' => 'array',
        'date_of_birth' => 'date', // ممكن نضيف casting للتواريخ
        'retirement_date' => 'date',
    ];


    /**
     * العلاقة مع المستخدم الذي يملك طلب العضوية هذا.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * توليد رقم طلب العضوية فريد تلقائيًا قبل الحفظ.
     */

}
