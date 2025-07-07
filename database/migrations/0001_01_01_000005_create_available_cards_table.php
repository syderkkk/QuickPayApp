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
        Schema::create('S_available_cards', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('brand');
            $table->string('last_four', 4);
            $table->string('cvv', 4);
            $table->string('expiry_month', 2);
            $table->string('expiry_year', 4);
            $table->foreignId('available_bank_account_id')->constrained('S_available_bank_accounts');
            $table->enum('status', ['active', 'blocked'])->default('active');
            $table->decimal('balance', 12, 2)->default(10000.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('S_available_cards');
    }
};
