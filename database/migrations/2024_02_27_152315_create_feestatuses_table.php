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
        Schema::create('feestatuses', function (Blueprint $table) {
            $table->id('feestatus_id');
            $table->enum("status", [0, 1])->default(0);
            $table->bigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('fee_id');
            $table->foreign('fee_id')->references('fee_id')->on('fees');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students');
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
        Schema::dropIfExists('feestatuses');
    }
};
