<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Default
        User::firstOrCreate(
            ['email' => 'admin@amikom.ac.id'],
            [
                'name' => 'Admin Amikom',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Kategori
        $categoryIT = Category::firstOrCreate([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $categoryEntertainment = Category::firstOrCreate([
            'name' => 'Entertainment',
            'slug' => 'entertainment',
        ]);

        // Event 1
        Event::create([
            'category_id' => $categoryEntertainment->id,
            'title' => 'Jazz Night 2025',
            'description' => 'Nikmati malam yang indah dengan alunan musik.',
            'date' => '2026-05-10 19:00:00',
            'location' => 'Amikom Baru',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-1.png',
        ]);

        // Event 2
        Event::create([
            'category_id' => $categoryIT->id,
            'title' => 'AI Summit & Expo 2026',
            'description' => 'Jelajahi tren terkini dalam bidang Artificial Intelligence.',
            'date' => '2026-05-01 13:00:00',
            'location' => 'Ruang Cinema',
            'price' => 45000,
            'stock' => 150,
            'poster_path' => 'posters/event-2.png',
        ]);
    }
}