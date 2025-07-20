<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'target_audience_ar',
        'target_audience_en',
        'required_documents_ar',
        'required_documents_en',
        'service_charter_ar',
        'service_charter_en',
        'disclaimer_ar',
        'disclaimer_en',
        'chanel',
        'price',
        'status',
    ];

    public function getStatusBadgeClassAttribute()
    {
        return $this->status == 1 ? 'bg-success' : 'bg-danger';
    }

    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'فعال' : 'غير فعال';
    }
}
