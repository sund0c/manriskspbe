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
        Aset::create([
            'nama' => 'SIMPEG',
            'url' => 'simpeg.baliprov.go.id',
            'ip' => '111.100.11.009',
            'keterangan' => 'Untuk manajemen kepegawaian ASN Pemprov Bali',
            'jenis' => 'APLIKASI',
            'user' => '2',
        ]);
        Aset::create([
            'nama' => 'VM-SIMPEG',
            'url' => '-',
            'ip' => '111.100.11.009',
            'keterangan' => 'Virtual machine aplikasi SIMPEG',
            'jenis' => 'INFRASTRUKTUR',
            'user' => 1,
        ]);
        Aset::create([
            'nama' => 'VM-SIKEPO',
            'url' => '-',
            'ip' => '102.123.11.23',
            'keterangan' => 'Virtual machine aplikasi SIKEPO',
            'jenis' => 'INFRASTRUKTUR',
            'user' => 1,
        ]);
    }
}
