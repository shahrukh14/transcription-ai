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
            $table->json('language_known')->after('wallet')->nullable();
            $table->string('whatsapp_number')->after('mobile')->nullable();
            $table->string('typing_speed')->after('language_known')->nullable();
            $table->string('work_hours')->after('typing_speed')->nullable();
            $table->string('city')->after('image')->nullable();
            $table->string('state')->after('city')->nullable();
            $table->text('work_experience')->after('state')->nullable();
            $table->text('paragraph')->after('work_experience')->nullable();
            $table->string('application_form_submit')->after('email_verified')->default(0);
            $table->string('assessment_1_complete')->after('application_form_submit')->default(0);
            $table->string('assessment_2_complete')->after('assessment_1_complete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proof_readers', function (Blueprint $table) {
            $table->dropColumn('language_known');
            $table->dropColumn('whatsapp_number');
            $table->dropColumn('typing_speed');
            $table->dropColumn('work_hours');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('work_experience');
            $table->dropColumn('paragraph');
            $table->dropColumn('application_form_submit');
            $table->dropColumn('assessment_1_complete');
            $table->dropColumn('assessment_2_complete');
        });
    }
};
