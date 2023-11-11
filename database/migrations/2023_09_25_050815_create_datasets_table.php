<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id('dataset_id');
            $table->string('dataset_title');
            $table->longText('dataset_description');
            $table->string('dataset_author');
            $table->date('dataset_date');
            $table->string('dataset_file');
            $table->string('dataset_file_path');
            $table->string('dataset_contributor')->nullable();
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
        Schema::dropIfExists('datasets');
    }
};
