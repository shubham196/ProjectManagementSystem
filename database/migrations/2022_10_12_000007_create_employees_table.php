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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('designation_id');
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->longText('profile_photo');
            $table->string('company');
            $table->string('mobile_no');
            $table->string('join_date');
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
        Schema::dropIfExists('employees');
    }
};
