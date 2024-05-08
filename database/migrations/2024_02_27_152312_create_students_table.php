<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id("student_id");
            $table->string('name');
            $table->string('email');
            $table->bigInteger('phone');
            $table->string('address');
            $table->enum('gender', ['M', 'F']);
            $table->bigInteger('addmissionno');
            $table->string('profilepic');
            $table->string('dob');
            $table->bigInteger('aadhaar');
            $table->integer('rollno');
            $table->string('pname');
            $table->string('pemail');
            $table->bigInteger('pphone');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('school_id')->on('schools');
            $table->unsignedBigInteger('user_id')->unique();
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
        Schema::dropIfExists('students');
    }
};
