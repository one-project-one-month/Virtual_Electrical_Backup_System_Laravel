<?php

namespace Database\Seeders;

use App\Models\BatteryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatteryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        BatteryType::create([
            'battery_type_name' => 'battert_type_1',
            'percentage' => 55.55,
        ]);
        BatteryType::create([
            'battery_type_name' => 'battert_type_2',
            'percentage' => 55.55,
        ]);
        BatteryType::create([
            'battery_type_name' => 'battert_type_3',
            'percentage' => 55.55,
        ]);
        BatteryType::create([
            'battery_type_name' => 'battert_type_4',
            'percentage' => 55.55,
        ]);

    }
}