<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::insert([
            [
                'name' => 'Super Admin',
                'description' => 'Administrator Sistem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HIMA Sistem Informasi',
                'description' => 'Himpunan Mahasiswa Sistem Informasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BEM',
                'description' => 'Badan Eksekutif Mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}