<?php

namespace Database\Seeders;

use App\Models\Aset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aset::create([
            'nama' => 'SIKEPO',
            'url' => 'sikepo.baliprov.go.id',
            'ip' => '102.123.11.23',
            'keterangan' => 'Untuk monitoring kinerja ASN Pemprov Bali',
            'jenis' => 'APLIKASI',
            'user' => 1,
        ]);
    }
}
