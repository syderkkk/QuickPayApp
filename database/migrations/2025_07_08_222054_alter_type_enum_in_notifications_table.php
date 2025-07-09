<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Agrega 'refund' al ENUM de la columna 'type'
        DB::statement("ALTER TABLE notifications MODIFY COLUMN type ENUM('payment', 'request', 'system', 'refund') DEFAULT 'system'");
    }

    public function down(): void
    {
        // Quita 'refund' del ENUM de la columna 'type'
        DB::statement("ALTER TABLE notifications MODIFY COLUMN type ENUM('payment', 'request', 'system') DEFAULT 'system'");
    }
};
