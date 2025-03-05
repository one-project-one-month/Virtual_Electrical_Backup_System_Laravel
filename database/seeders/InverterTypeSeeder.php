<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InverterTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('inverter_types')->insert([
            [
                'name' => 'Off-Grid Inverter',
                'efficiency' => 90,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'On-Grid Inverter',
                'efficiency' => 95,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Hybrid Inverter',
                'efficiency' => 92,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Micro Inverter',
                'efficiency' => 96,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
