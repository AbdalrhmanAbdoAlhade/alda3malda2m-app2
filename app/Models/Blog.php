<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // تحديد اسم الجدول
    protected $table = 'blogs';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'title',
        'content',
        'imgSrc',
    ];

    public $timestamps = true; // لتفعيل التوقيتات تلقائياً
}
