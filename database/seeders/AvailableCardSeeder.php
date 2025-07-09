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
                'number'          => '4111111111111111',
                'brand'           => 'Visa',
                'last_four'       => '1111',
                'cvv'             => '123',
                'expiry_month'    => '12',
                'expiry_year'     => '2027',
                'available_bank_account_id'  => 1, // BCP
                'status'          => 'active',
            ],
            [
                'number'          => '5500000000000004',
                'brand'           => 'Mastercard',
                'last_four'       => '0004',
                'cvv'             => '456',
                'expiry_month'    => '11',
                'expiry_year'     => '2026',
                'available_bank_account_id'  => 2, // BBVA
                'status'          => 'active',
            ],
            [
                'number'          => '4000000000000000',
                'brand'           => 'Visa',
                'last_four'       => '0000',
                'cvv'             => '123',
                'expiry_month'    => '12',
                'expiry_year'     => '2027',
                'available_bank_account_id'  => 3, // BCP
                'status'          => 'active',
            ],
        ]);
    }
}
