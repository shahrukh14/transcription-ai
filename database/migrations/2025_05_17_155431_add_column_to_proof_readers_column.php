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
        Schema::table('proof_readers', function (Blueprint $table) {
            $table->string('assessment_1_status')->after('assessment_1_complete')->default(0)->comment('0:Pending, 1:Approved, 2:Rejected');
            $table->string('assessment_2_status')->after('assessment_2_complete')->default(0)->comment('0:Pending, 1:Approved, 2:Rejected');
            $table->string('re_do_assessment')->after('assessment_2_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proof_readers', function (Blueprint $table) {
            $table->dropColumn('assessment_1_status');
            $table->dropColumn('assessment_2_status');
            $table->dropColumn('re_do_assessment');
        });
    }
};
