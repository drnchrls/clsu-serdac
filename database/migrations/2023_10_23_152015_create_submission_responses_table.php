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
        Schema::create('submission_responses', function (Blueprint $table) {
            $table->id('submission_response_id');
            $table->foreignId('submission_response_request_id')->constrained('submission_publications','submission_publication_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->longText('submission_response_remark');
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
        Schema::dropIfExists('submission_responses');
    }
};
