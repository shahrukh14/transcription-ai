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
        Schema::table('assessment_tests', function (Blueprint $table) {
            $table->string('assessment_type')->after('transcription_original_segments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessment_tests', function (Blueprint $table) {
            $table->dropColumn('assessment_tests');
        });
    }
};
