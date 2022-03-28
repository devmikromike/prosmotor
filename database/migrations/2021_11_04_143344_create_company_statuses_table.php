<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('company_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('prospect_id')->nullable();
            $table->tinyInteger('blacklisted')->default(0);   // Boolean
            $table->integer('category_id')->nullable();
            $table->string('default_location_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('type_id')->nullable();
            //$table->string()->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_statuses');
    }
}
