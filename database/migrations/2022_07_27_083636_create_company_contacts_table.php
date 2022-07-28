<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->nullable();
            $table->string('contact_id')->nullable();
            $table->timestamp('modified_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('creator_id')->nullable();        // Auth->user()     
            $table->timestamp('shared_at')->nullable();
            $table->tinyInteger('shared_enabled')->default(0);   // Boolean
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
        Schema::dropIfExists('company_contacts');
    }
}
