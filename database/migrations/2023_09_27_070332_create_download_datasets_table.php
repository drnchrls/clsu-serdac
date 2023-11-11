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
        Schema::create('download_datasets', function (Blueprint $table) {
            $table->id('download_id');
            $table->foreignId('download_user_id')->constrained('users','id')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->foreignId('download_dataset_id')->constrained('datasets','dataset_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('download_dataset_id');
            $table->string('download_dataset_title');
            $table->string('download_dataset_author');
            $table->date('download_date');
            $table->mediumText('download_reason');
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
        Schema::dropIfExists('download_datasets');
    }
};
