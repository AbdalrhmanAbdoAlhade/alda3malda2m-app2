<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentServicesTable extends Migration
{
    public function up()
    {
        Schema::create('government_services', function (Blueprint $table) {
            $table->id();
            $table->string('logo'); // عمود خاص بالصورة (اللوجو)
            $table->timestamps(); // هذا لإنشاء أعمدة created_at و updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('government_services');
    }
}