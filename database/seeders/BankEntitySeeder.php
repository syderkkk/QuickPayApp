<?php

namespace Database\Seeders;

use App\Models\Simulation\BankEntity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BankEntity::insert([
            ['nombre' => 'Banco de Crédito del Perú', 'codigo' => 'BCP'],
            ['nombre' => 'BBVA Perú', 'codigo' => 'BBVA'],
        ]);
    }
}
