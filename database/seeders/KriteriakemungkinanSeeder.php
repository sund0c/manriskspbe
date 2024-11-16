<?php

namespace Database\Seeders;

use App\Models\Kriteriakemungkinan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriakemungkinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['rare' => '<10% akan terjadi dalam periode waktu satu (1) tahun',
            'unlikely' => 'Antara 10-25% akan terjadi dalam periode waktu satu (1) tahun',
            'possible' => 'Antara 25-50% akan terjadi dalam periode waktu satu (1) tahun',
            'likely' => 'Antara 50-90% akan terjadi dalam periode waktu satu (1) tahun',
            'almost' => '>90% akan terjadi dalam periode waktu satu (1) tahun'],
        ];
        				
    foreach ($data as $item) {
        $existingRecord = Kriteriakemungkinan::where('rare', $item['rare'])->first();

        if (!$existingRecord) {
            Kriteriakemungkinan::create($item);
        }
    }


}
}
