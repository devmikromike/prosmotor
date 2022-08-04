<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLisenseTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lisense_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->nullable();
            $table->boolean('active')->default(1);
            $table->text('desc')->nullable();
            $table->bigInteger('days')->nullable();
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
        Schema::dropIfExists('lisense_types');
    }
}
