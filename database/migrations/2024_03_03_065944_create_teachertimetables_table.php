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
        Schema::create('teachertimetables', function (Blueprint $table) {
            $table->id('timetable_id');
            $table->string('file');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('school_id')->on('schools');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachertimetables');
    }
};
