<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // تحديد اسم الجدول
    protected $table = 'services';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'name',
        'details',
        'date',
        'viewers',
        'country',
        'city',
        'street',
        'images',
    ];

    // التعامل مع حقل الصور كـ JSON
    protected $casts = [
        'images' => 'array',
    ];

    public $timestamps = true; // لتفعيل التوقيتات تلقائياً
}
