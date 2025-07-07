<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Simulation\AvailableCard;

class AvailableCardSeeder extends Seeder
{
    public function run(): void
    {
        AvailableCard::insert([
            [
                'card_number'    => '4111111111111111',
                'brand'          => 'Visa',
                'last_four'      => '1111',
                'bank_entity_id' => 1, // BCP
                'status'         => 'active',
            ],
            [
                'card_number'    => '5500000000000004',
                'brand'          => 'Mastercard',
                'last_four'      => '0004',
                'bank_entity_id' => 2, // BBVA
                'status'         => 'active',
            ],
        ]);
    }
}