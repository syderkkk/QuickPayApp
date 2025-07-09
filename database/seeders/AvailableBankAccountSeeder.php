<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Simulation\AvailableBankAccount;

class AvailableBankAccountSeeder extends Seeder
{
    public function run(): void
    {
        AvailableBankAccount::insert([
            [
                'bank_entity_id' => 1, // BCP
                'account_number' => '1234567890123',
                'type' => 'ahorros',
                'currency' => 'PEN',
                'balance' => 5000.00,
                'status' => 'active',
            ],
            [
                'bank_entity_id' => 2, // BBVA
                'account_number' => '9876543210923',
                'type' => 'corriente',
                'currency' => 'PEN',
                'balance' => 3000.00,
                'status' => 'active',
            ],
            [
                'bank_entity_id' => 2, // Interbank
                'account_number' => '5876241210923',
                'type' => 'corriente',
                'currency' => 'PEN',
                'balance' => 0.00,
                'status' => 'active',
            ],
        ]);
    }
}