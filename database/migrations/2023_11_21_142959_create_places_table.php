<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('orientationImg')->nullable(); // Используйте string вместо text
            $table->string('disabilities')->nullable(); // Используйте string вместо text
            $table->string('img')->nullable(); // Путь к изображению места
            $table->foreignId('subcategoryId')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('locationId')->nullable()->constrained('location')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('places');
    }
}
