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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->date('date');
            $table->enum('status', ["P", "A", "L"]);
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('school_id')->on('schools');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
