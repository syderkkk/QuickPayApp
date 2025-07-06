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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['send', 'request', 'withdraw', 'card_payment']);
            $table->foreignId('sender_id')->nullable()->constrained('users');
            $table->foreignId('receiver_id')->nullable()->constrained('users');
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3);
            $table->string('reason')->nullable();
            $table->enum('status', ['completed', 'failed', 'pending', 'cancelled'])->default('pending');
            $table->decimal('converted_amount', 15, 2)->nullable();
            $table->string('receiver_currency', 3)->nullable();
            $table->decimal('exchange_rate', 15, 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
