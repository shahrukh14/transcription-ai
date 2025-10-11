<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
    **/
    public function up(): void
    {
        Schema::create('assessment_tests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('test_duration')->nullable()->comment('In Minutes');
            $table->string('audio_file')->nullable();
            $table->string('audio_file_original_name')->nullable();
            $table->string('audio_duration')->nullable()->comment('In Seconds');;
            $table->string('audio_language')->nullable();
            $table->text('transcription_text')->nullable();
            $table->json('transcription_segments')->nullable();
            $table->json('transcription_original_segments')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_tests');
    }
};
