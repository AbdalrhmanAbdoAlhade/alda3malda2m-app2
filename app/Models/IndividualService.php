<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualService extends Model
{
    use HasFactory;

    // تحديد اسم الجدول
    protected $table = 'individual_services';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'name',
        'mail',
        'phone',
        'service_type',
        'service_details',
    ];

    public $timestamps = true; // لتفعيل التوقيتات تلقائياً
}
