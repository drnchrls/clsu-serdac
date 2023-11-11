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
        Schema::create('service_responses', function (Blueprint $table) {
            $table->id('service_response_id');
            $table->foreignId('service_response_request_id')->constrained('service_requests','service_request_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('service_response_meeting_type')->nullable();
            $table->string('service_response_meeting_place')->nullable();
            $table->dateTime('service_response_meeting_time')->nullable();
            $table->string('service_response_meeting_link')->nullable();
            $table->longText('service_response_remark');
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
        Schema::dropIfExists('service_responses');
    }
};
