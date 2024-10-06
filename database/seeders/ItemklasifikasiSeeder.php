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
            'urut' => '1',
            'tanya' => 'Kapan informasi ini perlu tersedia?',
            'j1' => 'Ketika ada waktu untuk menyediakan',
            'j2' => 'Ketika ada waktu untuk menyediakan',
            'j3' => '1 s/d 7 hari',
            'j4' => '24/7',
            'domain' => '3'
        ]);
        Itemklasifikasi::create([
            'urut' => '2',
            'tanya' => 'Bagaimana dampak terhadap keamanan dan keselamatan pribadi jika informasi tidak tersedia saat dibutuhkan?.Contoh informasi tentang shelter perlindungan saat bencana.',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '3'
        ]);
        Itemklasifikasi::create([
            'urut' => '3',
            'tanya' => 'Bagaimana dampak finansial jika informasi tidak tersedia saat dibutuhkan ?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '3'
        ]);
        Itemklasifikasi::create([
            'urut' => '4',
            'tanya' => 'Bagaimana dampak terhadap operasional dan pencapaian organisasi jika informasi tidak tersedia saat dibutuhkan ?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '3'
        ]);
        Itemklasifikasi::create([
            'urut' => '5',
            'tanya' => 'Bagaimana dampak terhadap kepercayaan publik jika informasi tidak tersedia saat dibutuhkan ?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '3'
        ]);
//==
        Itemklasifikasi::create([
            'urut' => '1',
            'tanya' => 'Apakah informasi ini termasuk atau mengandung Data/Informasi Pribadi?. Sesuaikan dengan UU PDP.',
            'j1' => 'Tidak',
            'j2' => 'Tidak',
            'j3' => 'Ya',
            'j4' => 'Ya',
            'domain' => '2'
        ]);
        Itemklasifikasi::create([
            'urut' => '2',
            'tanya' => 'Apakah informasi ini digunakan untuk membuat keputusan?',
            'j1' => 'Tidak',
            'j2' => 'Tidak',
            'j3' => 'Ya',
            'j4' => 'Ya',
            'domain' => '2'
        ]);
        Itemklasifikasi::create([
            'urut' => '3',
            'tanya' => 'Bagaimana dampak dari modifikasi atau penghancuran informasi yang tidak sah terhadap keamanan dan keselamatan pribadi?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '2'
        ]);
        Itemklasifikasi::create([
            'urut' => '4',
            'tanya' => 'Bagaimana dampak finansial dari modifikasi atau penghancuran informasi yang tidak sah?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '2'
        ]);
        Itemklasifikasi::create([
            'urut' => '5',
            'tanya' => 'Bagaimana dampak dari modifikasi atau penghancuran informasi yang tidak sah terhadap operasional dan pencapaian misi organisasi?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '2'
        ]);
        Itemklasifikasi::create([
            'urut' => '6',
            'tanya' => 'Bagaimana dampak dari modifikasi atau penghancuran informasi yang tidak sah terhadap kepercayaan publik?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '2'
        ]);
        Itemklasifikasi::create([
            'urut' => '7',
            'tanya' => 'Bagaimana integritas informasi diwajibkan oleh hukum atau regulasi ? Jika ya, bagaimana dampak dari modifikasi atau penghancuran informasi yang tidak sah?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '2'
        ]);
        Itemklasifikasi::create([
            'urut' => '8',
            'tanya' => 'Apakah informasi ini (seperti transaksi finansial, penilaian kinerja) diandalkan untuk membuat keputusan organisasi? Jika ya, bagaimana dampak dari modifikasi atau penghancuran yang tidak sah?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '2'
        ]);
//==
        Itemklasifikasi::create([
            'urut' => '1',
            'tanya' => 'Apakah informasi ini tersedia untuk umum?',
            'j1' => 'Tidak',
            'j2' => 'Tidak',
            'j3' => 'Ya',
            'j4' => 'Ya',
            'domain' => '1'
        ]);
        Itemklasifikasi::create([
            'urut' => '2',
            'tanya' => 'Apakah informasi ini termasuk atau mengandung Data/Informasi Pribadi. Sesuaikan dengan UU PDP.',
            'j1' => 'Tidak',
            'j2' => 'Tidak',
            'j3' => 'Ya',
            'j4' => 'Ya',
            'domain' => '1'
        ]);
        Itemklasifikasi::create([
            'urut' => '3',
            'tanya' => 'Bagaimana dampak dari pengungkapan informasi yang tidak sah terhadap keamanan dan keselamatan pribadi?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '1'
        ]);
        Itemklasifikasi::create([
            'urut' => '4',
            'tanya' => 'Bagaimana dampak kerugian dalam aspek keuangan dari pengungkapan informasi yang tidak sah?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '1'
        ]);
        Itemklasifikasi::create([
            'urut' => '5',
            'tanya' => 'Bagaimana dampak dari pengungkapan informasi yang tidak sah terhadap operasional dan pencapaian misi organisasi?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '1'
        ]);
        Itemklasifikasi::create([
            'urut' => '6',
            'tanya' => 'Bagaimana dampak dari pengungkapan informasi informasi yang tidak sah terhadap kepercayaan publik, reputasi organisasi dan kepentingan publik?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '1'
        ]);
        Itemklasifikasi::create([
            'urut' => '7',
            'tanya' => 'Bagaimana kerahasiaan diwajibkan oleh hukum atau regulasi ? Jika ya, bagaimana dampak dari pengungkapan yang tidak sah?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '1'
        ]);
        Itemklasifikasi::create([
            'urut' => '8',
            'tanya' => 'Apakah informasi ini dimaksudkan untuk distribusi terbatas ? Jika ya, bagaimana dampak dari pengungkapan yang tidak sah?',
            'j1' => 'Tidak Berdampak',
            'j2' => 'Terbatas',
            'j3' => 'Serius',
            'j4' => 'Parah',
            'domain' => '1'
        ]);

    }
}
