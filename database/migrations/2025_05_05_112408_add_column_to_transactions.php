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
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id')->default(0)->change();
            $table->unsignedBigInteger('wallet_id')->after('package_id')->default(0);
            $table->string('transaction_for')->after('signature')->nullable();
            $table->string('remark')->after('currency')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id')->default(0)->change();
            $table->dropColumn('wallet_id');
            $table->dropColumn('transaction_for');
            $table->dropColumn('remark');
        });
    }
};
