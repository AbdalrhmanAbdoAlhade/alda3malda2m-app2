<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    // تحديد اسم الجدول
    protected $table = 'statistics';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'clients',
        'Annual_contracts',
        'Years_of_experience',
        'Long_term_contracts',
    ];

    // إذا كان الجدول يحتوي على توقيتات، فإن Laravel سيقوم بالتعامل معها تلقائيًا.
    public $timestamps = true;
}
