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
        Schema::create('results', function (Blueprint $table) {
            $table->id('result_id');
            $table->string('marks');
            // $table->string('attendence');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('subject_id')->on('subjects');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('school_id')->on('schools');
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references('exam_id')->on('exams');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
