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
        Schema::create('task_claim_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proof_reader_id');
            $table->unsignedBigInteger('task_id');
            $table->string('claim_date')->nullable();
            $table->string('unclaim_date')->nullable();
            $table->string('completed_date')->nullable();
            $table->string('status')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_claim_records');
    }
};
