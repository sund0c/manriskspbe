<?php

namespace Database\Seeders;

use App\Models\Layananspbe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Layananspbe::create([
            'nama' => 'PERENCANAAN',
            'jenis' => 'ADPEM'
        ]);
        Layananspbe::create([
            'nama' => 'PENGANGGARAN',
            'jenis' => 'ADPEM'
        ]);
        Layananspbe::create([
            'nama' => 'KEUANGAN',
            'jenis' => 'ADPEM'
        ]);
        Layananspbe::create([
            'nama' => 'PENGADAAN BARANG DAN JASA',
            'jenis' => 'ADPEM'
        ]);
        Layananspbe::create([
            'nama' => 'KEPEGAWAIAN',
            'jenis' => 'ADPEM'
        ]);
        Layananspbe::create([
            'nama' => 'KEARSIPAN',
            'jenis' => 'ADPEM'
        ]);
        Layananspbe::create([
            'nama' => 'PENGELOLAAN BARANG MILIK DAERAH',
            'jenis' => 'ADPEM'
        ]);
        Layananspbe::create([
            'nama' => 'PENGAWASAN INTERNAL TERKAIT PEMERINTAH',
            'jenis' => 'ADPEM'
        ]);
        Layananspbe::create([
            'nama' => 'AKUNTABILITAS KINERJA ORGANISASI',
            'jenis' => 'ADPEM'
        ]);
        Layananspbe::create([
            'nama' => 'KINERJA PEGAWAI',
            'jenis' => 'ADPEM'
        ]);

        Layananspbe::create([
            'nama' => 'PENGADUAN PELAYANAN',
            'jenis' => 'PUBLIK'
        ]);
        Layananspbe::create([
            'nama' => 'DATA TERBUKA',
            'jenis' => 'PUBLIK'
        ]);
        Layananspbe::create([
            'nama' => 'JARINGAN DOKUMNENTASI DAN INFORMASI HUKUM',
            'jenis' => 'PUBLIK'
        ]);
        Layananspbe::create([
            'nama' => 'PUBLIK SEKTORAL',
            'jenis' => 'PUBLIK'
        ]);
    }
}
