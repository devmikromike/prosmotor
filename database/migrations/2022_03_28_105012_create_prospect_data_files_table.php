<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectDataFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospect_data_files', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->nullable();
            $table->integer('version');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('internal_path')->nullable();
            $table->string('org_name')->unique();
            $table->string('old_name')->nullable();
            $table->string('external_path')->nullable();
            $table->string('new_file_name')->nullable();
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
        Schema::dropIfExists('prospect_data_files');
    }
}
