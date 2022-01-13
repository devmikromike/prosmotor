<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsBssLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pros_bss_lines', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->nullable();
            $table->string('nameFI')->nullable();
            $table->string('nameSE')->nullable();
            $table->string('nameEN')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pros_bss_lines');
    }
}
