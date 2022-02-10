<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectsTable extends Migration
{
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('vatId')->unique();           
            $table->string('www')->nullable();
            $table->string('registrationDate');
            $table->timestamps();
    //        $table->foreign('bssCode')->references('code')->on('pros_bss_lines');
        });
    }
    public function down()
    {
        Schema::dropIfExists('prospects');
    }
}
