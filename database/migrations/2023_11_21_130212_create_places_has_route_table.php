<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesHasRouteTable extends Migration
{
    public function up()
    {
        Schema::create('places_has_route', function (Blueprint $table) {
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('route_id');
            $table->primary(['place_id', 'route_id']);

            $table->foreign('route_id')->references('id')->on('route')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('places_has_route');
    }
}

