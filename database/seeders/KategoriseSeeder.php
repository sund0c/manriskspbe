<?php

namespace Database\Seeders;

use App\Models\Kategorise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategorise::create([
            'tanya' => 'Memiliki kewajiban kepatuhan terhadap Peraturan atau Standard Tertentu',
            'j1' => 'Peraturan atau Standard Nasional dan Internasional',
            'j2' => 'Peraturan atau Standard Nasional',
            'j3' => 'Tidak ada Peraturan Khusus'
        ]);
        Kategorise::create([
            'tanya' => 'Potensi kerugian atau dampak negatif dari insiden ditembusnya keamanan aplikasi (sabotase, terorisme)',
            'j1' => 'Menimbulkan korban jiwa',
            'j2' => 'Terbatas pada kerugian finansial',
            'j3' => 'Mengakibatkan ganggunan operasional sementara (tidak membahayakan dan mengakibatkan kurgian finansial)'
        ]);
    }
}
