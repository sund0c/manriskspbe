<?php

namespace Database\Seeders;

use App\Models\Itemklasifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemklasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Itemklasifikasi::create([
            'tanya' => 'Kapan informasi ini perlu tersedia?',
            'j1' => 'Ketika ada waktu untuk menyediakan',
            'j2' => '1 s/d 7 hari',
            'j3' => '24/7',
            'domain' => '3'
        ]);
        Itemklasifikasi::create([
            'tanya' => 'Bagaimana dampak terhadap keamanan dan keselamatan pribadi jika informasi tidak tersedia saat dibutuhkan?',
            'j1' => 'Tidak Berdampak atau Terbatas',
            'j2' => 'Serius',
            'j3' => 'Tinggi/Parah',
            'domain' => '3'
        ]);
        Itemklasifikasi::create([
            'tanya' => 'Apakah informasi ini termasuk atau mengandung Data/Informasi Pribadi?',
            'j1' => 'Tidak',
            'j2' => '0',
            'j3' => 'Ya',
            'domain' => '2'
        ]);
        Itemklasifikasi::create([
            'tanya' => 'Bagaimana dampak dari modifikasi atau penghancuran informasi yang tidak sah terhadap keamanan dan keselamatan pribadi?',
            'j1' => 'Tidak Berdampak atau Terbatas',
            'j2' => 'Serius',
            'j3' => 'Tinggi/Parah',
            'domain' => '2'
        ]);
        Itemklasifikasi::create([
            'tanya' => 'Bagaimana dampak dari pengungkapan informasi yang tidak sah terhadap keamanan dan keselamatan pribadi ?',
            'j1' => 'Tidak Berdampak atau Terbatas',
            'j2' => 'Serius',
            'j3' => 'Tinggi/Parah',
            'domain' => '1'
        ]);
        Itemklasifikasi::create([
            'tanya' => 'Bagaimana dampak kerugian dalam aspek keuangan dari pengungkapan informasi yang tidak sah ?',
            'j1' => 'Tidak Berdampak atau Terbatas',
            'j2' => 'Serius',
            'j3' => 'Tinggi/Parah',
            'domain' => '1'
        ]);
    }
}
