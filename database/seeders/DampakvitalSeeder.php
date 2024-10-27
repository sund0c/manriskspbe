<?php

namespace Database\Seeders;

use App\Models\Dampakvital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DampakvitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dampakvital::create([
            'nama' => 'OPERASIONAL'
        ]);
        Dampakvital::create([
            'nama' => 'DATA DAN/ATAU INFORMASI'
        ]);
        Dampakvital::create([
            'nama' => 'FINANSIAL'
        ]);
        Dampakvital::create([
            'nama' => 'UMUM'
        ]);
        Dampakvital::create([
            'nama' => 'SALING KETERGANTUNGAN'
        ]);
    }
}
