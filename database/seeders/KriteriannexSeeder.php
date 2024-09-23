<?php

namespace Database\Seeders;

use App\Models\Kriteriaannex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriannexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kriteriaannex::create([
            'tanya' => 'Apakah organisasi memiliki kebijakan keamanan informasi yang terdokumentasi?',
            'penjelasan' => 'Pertanyaan ini mengidentifikasi apakah kebijakan formal sudah dibuat dan terdokumentasi secara baik.',
            'tujuan' => 'Untuk memastikan bahwa organisasi memiliki kebijakan yang jelas terkait keamanan informasi.',
            'item' => 1
        ]);
        Kriteriaannex::create([
            'tanya' => 'Bagaimana kebijakan keamanan informasi disetujui dan oleh siapa?',
            'penjelasan' => 'Menanyakan proses persetujuan kebijakan, termasuk otoritas yang terlibat.',
            'tujuan' => 'Untuk memastikan bahwa kebijakan mendapatkan persetujuan dari pimpinan dan otoritas terkait.',
            'item' => 1
        ]);
        Kriteriaannex::create([
            'tanya' => 'Apakah kebijakan keamanan informasi diperbarui secara berkala?',
            'penjelasan' => 'Mengidentifikasi apakah kebijakan ditinjau dan diperbarui berdasarkan perubahan atau evaluasi risiko baru.',
            'tujuan' => 'Untuk menjamin relevansi dan keakuratan kebijakan seiring waktu.',
            'item' => 1
        ]);
        Kriteriaannex::create([
            'tanya' => 'Bagaimana kebijakan keamanan informasi dikomunikasikan kepada seluruh karyawan?',
            'penjelasan' => 'Pertanyaan ini menggali mekanisme penyampaian kebijakan kepada seluruh tingkat organisasi.',
            'tujuan' => 'Untuk memastikan semua karyawan memahami dan mengikuti kebijakan.',
            'item' => 1
        ]);
    }
}
