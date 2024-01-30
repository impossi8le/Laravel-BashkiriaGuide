<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->text('point')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('img')->nullable(); // Путь к изображению места
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('location');
    }
}
