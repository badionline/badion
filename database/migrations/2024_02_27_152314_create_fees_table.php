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
        Schema::create('fees', function (Blueprint $table) {
            $table->id('fee_id');
            $table->string('amount');
            $table->unsignedBigInteger('feescategory_id');
            $table->foreign('feescategory_id')->references('feescategory_id')->on('feescategories');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('school_id')->on('schools');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
