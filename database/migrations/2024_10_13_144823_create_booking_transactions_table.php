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
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->string('booking_trx_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->date('started_at');
            $table->unsignedBigInteger('total_participant');
            $table->unsignedBigInteger('total_amount');
            $table->boolean('is_paid');
            $table->string('proof');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
