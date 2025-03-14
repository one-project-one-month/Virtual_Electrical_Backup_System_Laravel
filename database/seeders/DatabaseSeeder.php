<?php

namespace Database\Seeders;

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
        $this->call(BatteryTypeSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(GeneratorSeeder::class);
        $this->call(InverterTypeSeeder::class);
        $this->call(BatterySeeder::class);
        $this->call(InverterSeeder::class);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'password123',
            'role' => 'admin'
        ]);
    }
}
