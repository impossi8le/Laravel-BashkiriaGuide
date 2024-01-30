<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyTable extends Migration
{
    public function up()
    {
        Schema::create('agency', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('phones');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agency');
    }
}
