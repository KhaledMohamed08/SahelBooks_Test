<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'type' => 'T-shirt',
            'price' => 30.99,
            'weight' => 0.2,
            'country_id' => 1,
        ]);
        Item::create([
            'type' => 'Blouse',
            'price' => 10.99,
            'weight' => 0.3,
            'country_id' => 2,
        ]);
        Item::create([
            'type' => 'Pants',
            'price' => 64.99,
            'weight' => 0.9,
            'country_id' => 2,
        ]);
        Item::create([
            'type' => 'Sweatpants',
            'price' => 84.99,
            'weight' => 1.1,
            'country_id' => 3,
        ]);
        Item::create([
            'type' => 'Jacket',
            'price' => 199.99,
            'weight' => 2.2,
            'country_id' => 1,
        ]);
        Item::create([
            'type' => 'Shoes',
            'price' => 79.99,
            'weight' => 1.3,
            'country_id' => 3,
        ]);
    }
}
