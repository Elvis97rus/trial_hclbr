<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Helpers\House;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (House::getList() as $item) {
            \App\Models\House::factory()->create([
                'name' => $item[0],
                'price' => $item[1],
                'bedrooms' => $item[2],
                'bathrooms' => $item[3],
                'storeys' => $item[4],
                'garages' => $item[5],
            ]);
        }
    }
}
