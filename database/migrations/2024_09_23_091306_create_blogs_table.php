<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان المدونة
            $table->text('content'); // محتوى المدونة
            $table->string('imgSrc'); // رابط الصورة
            $table->timestamps(); // لإنشاء created_at و updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
