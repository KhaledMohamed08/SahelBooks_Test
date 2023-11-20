<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rate::create([
            'country_id' => 1,
            'rate' => 2,
        ]);
        Rate::create([
            'country_id' => 2,
            'rate' => 3,
        ]);
        Rate::create([
            'country_id' => 3,
            'rate' => 2,
        ]);
    }
}
