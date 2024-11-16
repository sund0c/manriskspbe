<?php

namespace Database\Seeders;

use App\Models\Areadampak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreadampakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['area' => 'FINANSIAL','uraian' => 'Penurunan pendapatan akibat penurunan kinerja, termasuk biaya-biaya perbaikan','insignificant' => 'Kerugian finansial < 10 juta','low' => 'Kerugian finansial > 10 juta sd 50 juta','medium' => 'Kerugian finansial > 50 juta sd 250 juta','high' => 'Kerugian finansial > 250 juta sd 1 M','critical' => 'Kerugian finansial > 1 M'],
            ['area' => 'LAYANAN','uraian' => 'Gangguan yang menyebabkan terhentinya layanan organisasi','insignificant' => 'Terhentinya layanan < 1 hari','low' => 'Terhentinya layanan > 1 hari sd 3 hari','medium' => 'Terhentinya layanan > 3 hari sd 7 hari','high' => 'Terhentinya layanan > 7 hari sd 14 hari','critical' => 'Terhentinya layanan < 14 hari'],
            ['area' => 'KINERJA','uraian' => 'Penurunan kinerja dari berbagai sudut seperti kecepatan, kualitas dan lainnya','insignificant' => 'Penurunan kinerja < 5%','low' => 'Penurunan kinerja > 5% sd 15%','medium' => 'Penurunan kinerja > 15% sd 25%','high' => 'Penurunan kinerja > 25% sd 50%','critical' => 'Penurunan kinerja > 50%'],
            ['area' => 'HUKUM','uraian' => 'Biaya yang muncul akibat tuntutan hukum','insignificant' => 'Tuntutan < 10 juta','low' => 'Tuntutan > 10 juta sd 50 juta','medium' => 'Tuntutan > 50 juta sd 250 juta','high' => 'Tuntutan > 250 juta sd 1 M','critical' => 'Tuntutan > 1 M'],
            ['area' => 'REPUTASI','uraian' => 'Kepercayaan publik/pengguna','insignificant' => '< 5 komentar negatif /bulan','low' => 'Komentar negatif > 5 sd 15 /bulan','medium' => 'Komentar negatif > 15 sd 25 /bulan','high' => 'Komentar negatif > 25 sd 50 /bulan','critical' => 'Komentar negatif > 50 /bulan'],
        ];
        				
    foreach ($data as $item) {
        $existingRecord = Areadampak::where('area', $item['area'])->first();

        if (!$existingRecord) {
            Areadampak::create($item);
        }
    }


}
}
