<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الخدمة
            $table->text('details'); // تفاصيل الخدمة
            $table->date('date'); // تاريخ الخدمة
            $table->integer('viewers')->default(0); // عدد المشاهدين
            $table->string('country'); // الدولة
            $table->string('city'); // المدينة
            $table->string('street'); // الشارع
            $table->json('images'); // صور الخدمة
            $table->timestamps(); // لإنشاء created_at و updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
