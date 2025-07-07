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
        Schema::create('S_available_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_entity_id')->constrained('S_bank_entities');
            $table->string('account_number')->unique();
            $table->string('type'); // ahorros/corriente
            $table->string('currency', 3);
            $table->decimal('balance', 15, 2)->default(0);
            $table->enum('status', ['active', 'blocked'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('S_available_bank_accounts');
    }
};
