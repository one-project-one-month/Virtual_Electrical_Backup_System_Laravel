<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GeneratorSeeder extends Seeder
{
    public function run()
    {
        DB::table('generators')->insert([
            [
                'name' => 'Honda EU2200i',
                'model' => 'EU2200i',
                'watt' => 2200,
                'fuel_type' => 'Gasoline',
                'brand_id' => 1,
                'image' => 'yamaha_ef2000.jpg',
                'generator_price' => 999.99,
                'description' => 'Quiet and fuel-efficient portable inverter generator.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Yamaha EF2000iSv2',
                'model' => 'EF2000iSv2',
                'watt' => 2000,
                'fuel_type' => 'Gasoline',
                'brand_id' => 2,
                'image' => 'yamaha_ef2000.jpg',
                'generator_price' => 899.99,
                'description' => 'Lightweight, compact, and efficient inverter generator.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Champion 3800-Watt Dual Fuel',
                'model' => '3800DF',
                'watt' => 3800,
                'fuel_type' => 'Dual Fuel',
                'brand_id' => 2,
                'image' => 'champion_3800.jpg',
                'generator_price' => 549.99,
                'description' => 'Versatile dual-fuel generator with electric start.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
