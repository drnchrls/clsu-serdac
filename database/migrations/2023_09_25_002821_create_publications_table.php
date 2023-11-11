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
        Schema::create('publications', function (Blueprint $table) {
            $table->id('publication_id');
            $table->string('publication_type');
            $table->string('publication_title');
            $table->longText('publication_description');
            $table->string('publication_author');
            $table->date('publication_date');
            $table->string('publication_file');
            $table->string('publication_file_path');
            $table->string('publication_contributor')->nullable();
            $table->string('publication_volume')->nullable();
            $table->string('publication_issue')->nullable();
            $table->string('publication_theme');
            $table->string('publication_doi')->nullable();
            $table->string('publication_publisher')->nullable();
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
        Schema::dropIfExists('publications');
    }
};
