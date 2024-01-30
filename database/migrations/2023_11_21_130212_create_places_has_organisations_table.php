<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesHasOrganisationsTable extends Migration
{
    public function up()
    {
        Schema::create('places_has_organisations', function (Blueprint $table) {
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('organisation_id');
            $table->primary(['place_id', 'organisation_id']);


            $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('places_has_organisations');
    }
}
