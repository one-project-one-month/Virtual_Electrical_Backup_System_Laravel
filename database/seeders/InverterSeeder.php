<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inverter;
use Carbon\Carbon;

class InverterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Inverter::insert([
            [
                'watt' => 3000,
                'inverter_type_id' => 1,
                'brand_id' => 1,
                'wave_type' => 'Pure Sine Wave',
                'model' => 'Model-X3000',
                'inverter_volt' => 24,
                'compatible_battery' => '12V Lead-Acid',
                'inverter_price' => 199.99,
                'image' => 'inverter1.jpg',
                'description' => 'Reliable and efficient inverter for home use.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'watt' => 5000,
                'inverter_type_id' => 2,
                'brand_id' => 2,
                'wave_type' => 'Modified Sine Wave',
                'model' => 'Pro-5000',
                'inverter_volt' => 48,
                'compatible_battery' => '24V Lithium-ion',
                'inverter_price' => 349.99,
                'image' => 'inverter2.png',
                'description' => 'High-performance inverter with advanced cooling.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'watt' => 8000,
                'inverter_type_id' => 2,
                'brand_id' => 1,
                'wave_type' => 'Pure Sine Wave',
                'model' => 'UltraPower-8000',
                'inverter_volt' => 60,
                'compatible_battery' => '48V Lithium-ion',
                'inverter_price' => 499.99,
                'image' => 'Inverter3.jpg',
                'description' => 'Industrial-grade inverter for large-scale applications.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
