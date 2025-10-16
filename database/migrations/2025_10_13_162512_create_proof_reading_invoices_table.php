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
        Schema::create('proof_reading_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('proof_reader_id');
            $table->decimal('amount', 8,2)->default(0);
            $table->decimal('cf_amount', 8,2)->default(0);
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proof_reading_invoices');
    }
};
