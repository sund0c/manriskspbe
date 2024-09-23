<?php

namespace Database\Seeders;

use App\Models\Klasifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KlasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Klasifikasi::create([
            'nama' => 'CONFIDENTIALITY (Kerahasiaan)'
        ]);
        Klasifikasi::create([
            'nama' => 'INTEGRITY (Integritas)'
        ]);
        Klasifikasi::create([
            'nama' => 'AVAILABILITY (Ketersediaan)'
        ]);

    }
}
