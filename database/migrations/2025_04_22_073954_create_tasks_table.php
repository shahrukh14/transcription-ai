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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('audio_id')->nullable();
            $table->string('uploaded_dt')->nullable();
            $table->string('level')->nullable();
            $table->string('pay_per_min')->nullable();
            $table->string('incentives')->nullable();
            $table->string('claimed_dt')->nullable();
            $table->string('claimed_by')->nullable();
            $table->string('status')->nullable();
            $table->string('submitted_dt')->nullable();
            $table->string('updated_proofreading')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
