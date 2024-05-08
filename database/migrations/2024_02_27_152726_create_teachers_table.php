<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id("teacher_id");
            $table->string('name');
            $table->string('email');
            $table->enum('gender', ['M','F']);
            $table->bigInteger('phone');
            $table->string('address');
            $table->string('graduation');
            $table->string('dob');
            $table->integer('salary');
            $table->string('profilepic');
            $table->bigInteger('aadhaar');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('school_id')->on('schools');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
