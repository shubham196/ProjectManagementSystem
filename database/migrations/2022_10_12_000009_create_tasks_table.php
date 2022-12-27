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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('project_id')->constrained();
            $table->string('name');
            $table->unsignedBigInteger('team_id');
            // $table->foreign('team_id')->references('id')->on('teams');
            $table->string('task_description');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('priority')->nullable();
            $table->string('status');
            $table->string('files')->nullable();
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
        Schema::dropIfExists('tasks');
    }
};
