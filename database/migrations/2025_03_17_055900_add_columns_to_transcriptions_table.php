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
        Schema::table('transcriptions', function (Blueprint $table) {
            $table->integer('audio_file_duration')->after('audio_file_name')->comment('in seconds')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transcriptions', function (Blueprint $table) {
            $table->dropColumn('audio_file_duration');
        });
    }
};
