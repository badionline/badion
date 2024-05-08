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
        Schema::create('schools', function (Blueprint $table) {
            $table->id("school_id");
            $table->string("name");
            $table->text("address");
            $table->bigInteger("phone");
            $table->string("email");
            $table->string("whatsapp")->nullable();
            $table->string("location")->nullable();
            $table->string("instagram")->nullable();
            $table->string("youtube")->nullable();
            $table->text("pan");
            $table->string("panfile");
            $table->string("registernumber");
            $table->bigInteger("adhaar");
            $table->text("adhaarfront");
            $table->text("adhaarback");
            $table->boolean("status")->default(1);
            // $table->unsignedBigInteger('plan_id');
            // $table->foreign('plan_id')->default(1)->references('plan_id')->on('plans');
            // $table->foreignId('plan_id')->nullable()->constrained(table: 'plans' , indexName: 'school_plan_id');
            // $table->foreignId('plan_id')->nullable()->constrained(table: 'plans', indexName: 'notifications_users_id', column: 'plan_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
