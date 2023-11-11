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
        Schema::create('submission_publications', function (Blueprint $table) {
            $table->id('submission_publication_id');
            $table->foreignId('submission_publication_user_id')->constrained('users','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('submission_publication_type');
            $table->string('submission_publication_title');
            $table->longText('submission_publication_description');
            $table->string('submission_publication_author');
            $table->string('submission_publication_contributor')->nullable();
            $table->string('submission_publication_file');
            $table->string('submission_publication_file_path');
            $table->string('submission_publication_volume')->nullable();
            $table->string('submission_publication_issue')->nullable();
            $table->date('submission_publication_date');
            $table->string('submission_publication_theme');
            $table->string('submission_publication_doi')->nullable();
            $table->string('submission_publication_publisher')->nullable();
            $table->string('submission_publication_status')->default('Pending');
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
        Schema::dropIfExists('submission_publications');
    }
};
