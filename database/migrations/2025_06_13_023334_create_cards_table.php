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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('tipo')->nullable();
            $table->string('nombre_propietario');
            $table->unsignedBigInteger('bank_id'); // Relación con bancos
            $table->timestamps();

            $table->foreign('bank_entity_id')->references('id')->on('bank_entities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
