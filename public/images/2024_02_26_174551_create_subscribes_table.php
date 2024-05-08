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
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id('subscribe_id');
            $table->date('from');
            $table->date('to');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('school_id')->on('schools');
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('plan_id')->on('plans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribes');
    }
};
