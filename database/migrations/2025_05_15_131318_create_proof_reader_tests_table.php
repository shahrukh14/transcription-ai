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
        Schema::create('proof_reader_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('assessment_tests_id');
            $table->string('start_time')->nullable();
            $table->string('submit_time')->nullable();
            $table->json('transcription_segments')->nullable();
            $table->string('attachments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proof_reader_tests');
    }
};
