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
        Schema::table('proof_reader_tests', function (Blueprint $table) {
            $table->string('status')->after('transcription_segments')->comment('0:Pending, 1:Approved, 2:Rejected')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proof_reader_tests', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
