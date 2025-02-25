<?php

namespace Database\Seeders;

use App\Models\Battery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Battery::create([
            'battery_name'=>'example-battery',
            'storage_amp' => 50.00,
            'battery_volt' => 50.00,
            'image' => 'example-image.jpg',
            'description' => 'example description',
            'brand_id' => 1,
            'battery_type_id' => 1,
        ]);

        Battery::create([
            'battery_name'=>'example-battery',
            'storage_amp' => 50.00,
            'battery_volt' => 50.00,
            'image' => 'example-image.jpg',
            'description' => 'example description',
            'brand_id' => 1,
            'battery_type_id' => 1,
        ]);

        Battery::create([
            'battery_name'=>'example-battery',
            'storage_amp' => 50.00,
            'battery_volt' => 50.00,
            'image' => 'example-image.jpg',
            'description' => 'example description',
            'brand_id' => 1,
            'battery_type_id' => 1,
        ]);

        Battery::create([
            'battery_name'=>'example-battery',
            'storage_amp' => 50.00,
            'battery_volt' => 50.00,
            'image' => 'example-image.jpg',
            'description' => 'example description',
            'brand_id' => 1,
            'battery_type_id' => 1,
        ]);
    }
}