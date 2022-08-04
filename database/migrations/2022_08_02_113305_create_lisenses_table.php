<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLisensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lisenses', function (Blueprint $table) {
            $table->id();
            $table->string('type_id');
            $table->string('key')->nullable();
            $table->string('user_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('actived_at')->nullable();
            $table->timestamp('expired_at')->nullable();            
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
        Schema::dropIfExists('lisenses');
    }
}
