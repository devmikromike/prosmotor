<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();             
            $table->string('careOf')->nullable();
            $table->string('street')->nullable();
            $table->string('postCode')->nullable();
            $table->string('type')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('regDate')->nullable();
            $table->string('endDate')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
