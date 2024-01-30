<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteTable extends Migration
{
    public function up()
    {
        Schema::create('route', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('pointStart')->nullable();
            $table->text('pointEnd')->nullable();
            $table->unsignedBigInteger('agencyId')->nullable();
            $table->timestamps();

            $table->foreign('agencyId')->references('id')->on('agency')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('route');
    }
}
