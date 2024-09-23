<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentService extends Model
{
    use HasFactory;

    // تحديد اسم الجدول
    protected $table = 'government_services';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'logo', // عمود اللوجو
    ];

    public $timestamps = true; // لتفعيل التوقيتات تلقائياً
}
