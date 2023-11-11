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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id('staff_id');
            $table->string('staff_fname');
            $table->string('staff_lname');
            $table->string('staff_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('staff_password');
            $table->string('staff_role');
            $table->string('staff_contact');
            $table->rememberToken();
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
        Schema::dropIfExists('staffs');
    }
};
