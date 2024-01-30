<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesHasAttributeTable extends Migration
{
    public function up()
    {
        Schema::create('places_has_attribute', function (Blueprint $table) {
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('attributes')->onDelete('cascade');
            $table->primary(['place_id', 'attribute_id']); // Композитный первичный ключ
        });
    }

    public function down()
    {
        Schema::dropIfExists('places_has_attribute');
    }
}
