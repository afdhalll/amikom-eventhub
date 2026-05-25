<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('partners')->insert([
                'name' => fake()->company(),
                'logo_url' => 'https://placehold.co/200x200',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}