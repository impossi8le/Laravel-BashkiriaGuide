<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationsTable extends Migration 
{
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link')->nullable(); // Путь к изображению атрибута
            $table->json('phones');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organisations');
    }
}
