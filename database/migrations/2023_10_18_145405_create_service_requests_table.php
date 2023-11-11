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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id('service_request_id');
            $table->foreignId('service_request_user_id')->constrained('users','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('service_request_agency');
            $table->string('service_request_agency_classification');
            $table->string('service_request_client');
            $table->date('service_request_date');
            $table->string('service_request_type');
            $table->string('service_request_training_topic')->nullable();
            $table->string('service_request_analysis')->nullable();
            // $table->string('service_request_specific_analysis')->nullable();
            $table->string('service_request_software')->nullable();
            $table->longText('service_request_reason');
            $table->longText('service_request_survey_description')->nullable();
            $table->longText('service_request_survey_target')->nullable();
            $table->string('service_request_survey_coverage')->nullable();
            $table->string('service_request_status')->default('Pending');
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
        Schema::dropIfExists('service_requests');
    }
};
