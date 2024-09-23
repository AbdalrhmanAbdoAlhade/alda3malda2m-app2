<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // تحديد اسم الجدول
    protected $table = 'clients';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'logo', // عمود اللوجو
    ];

    public $timestamps = true; // لتفعيل التوقيتات تلقائياً
}
