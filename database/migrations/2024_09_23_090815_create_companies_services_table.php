<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesServicesTable extends Migration
{
    public function up()
    {
        Schema::create('companies_services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الشركة
            $table->string('mail'); // البريد الإلكتروني
            $table->string('phone'); // رقم الهاتف
            $table->string('service_type'); // نوع الخدمة
            $table->text('service_details'); // تفاصيل الخدمة
            $table->timestamps(); // لإنشاء created_at و updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies_services');
    }
}
