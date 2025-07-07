<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        Country::create([
            'code' => 'PE',
            'name' => 'Peru',
            'currency' => 'PEN',
        ]);
        Country::create([
            'code' => 'AR',
            'name' => 'Argentina',
            'currency' => 'ARS',
        ]);

        $this->call([
            BankEntitySeeder::class,
            AvailableBankAccountSeeder::class,
            AvailableCardSeeder::class,
        ]);
    }
}
