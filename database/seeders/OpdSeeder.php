<?php

namespace Database\Seeders;

use App\Models\Opd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Opd::create([
            'nama' => 'Dinas Komunikasi dan Informatika',
            'singkatan' => 'DISKOMINFOS'
        ]);
        Opd::create([
            'nama' => 'Badan Kepegawaian dan Pengembangan SDM ',
            'singkatan' => 'BKPSDM'
        ]);
        Opd::create([
            'nama' => 'UPT Pengembangan Kompetensi SDM',
            'singkatan' => 'UPT.PKSDM'
        ]);    }
}
