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
            'urut' => '1',
            'tanya' => 'Nilai investasi dalam RUPIAH saat aplikasi dibangun. Jika dibangun secara mandiri (tidak ada biaya) maka hitung gaji/honor yang diterima oleh pembuat selama membuat aplikasi. Nilai termasuk juga biaya listrik saat membangun, koneksi internet saat membangun. Nilai di luar INFRASTRUKTUR (server/cloud/badwidth internet server).',
            'j1' => 'Lebih dari Rp. 30 Miliar',
            'j2' => 'Lebih dari Rp. 3 Miliar s/d Rp. 30 Miliar',
            'j3' => 'Kurang dari Rp. 3 Miliar'
        ]);
        Kategorise::create([
            'urut' => '2',
            'tanya' => 'Total anggaran DALAM RUPIAH operasional tahunan untuk pengelolaan aplikasi. Honor/gaji admin/vendor, listrik, internet dan hal lainnya untuk melakukan pengelolaan. Nilai di luar pengelolaan INFRASTRUKTUR (server/cloud/badwidth internet server).',
            'j1' => 'Lebih dari Rp. 10 Miliar',
            'j2' => 'Lebih dari Rp. 1 Miliar s/d Rp. 10 Miliar',
            'j3' => 'Kurang dari Rp. 1 Miliar'
        ]);
        Kategorise::create([
            'urut' => '3',
            'tanya' => 'Memiliki kewajiban kepatuhan terhadap Peraturan atau Standard Tertentu',
            'j1' => 'Peraturan atau Standard Nasional dan Internasional',
            'j2' => 'Peraturan atau Standard Nasional',
            'j3' => 'Tidak ada Peraturan Khusus'
        ]);
        Kategorise::create([
            'urut' => '4',
            'tanya' => 'Menggunakan teknik kriptografi khusus untuk kemanana informasi dalam aplikasi',
            'j1' => 'Teknik kriptografi khusus yang disertifikasi oleh Negara',
            'j2' => 'Teknik kriptografi sesuai standrad industri, tersedia secara publik atau dikembangkan sendiri',
            'j3' => 'Tidak ada penggunaan teknik kriptografi'
        ]);
        Kategorise::create([
            'urut' => '5',
            'tanya' => 'Jumlah pengguna aplikasi',
            'j1' => 'Lebih dari 5000 pengguna',
            'j2' => '1000 s/d 5000 pengguna',
            'j3' => '< 1000 pengguna'
        ]);
        Kategorise::create([
            'urut' => '6',
            'tanya' => 'Data pribadi yang dikelola dalam aplikasi',
            'j1' => 'Data pribadi yang memiliki hubungan dengan data pribadi lainnya',
            'j2' => 'Data pribadi yang bersifat individeu dan/atau data pribadi yang terkait degnan kepemilikan badan usaha',
            'j3' => 'Tidak ada data pribadi'
        ]);
        Kategorise::create([
            'urut' => '7',
            'tanya' => 'Tingkat klasifikasi/kekritisan data yang ada dalam aplikasi, relatif terhadap ancaman upaya penyeragan atau penerobosan keamanan informasi',
            'j1' => 'Sangat Rahasia',
            'j2' => 'Rahasia dan/atau Terbatas',
            'j3' => 'Biasa'
        ]);
        Kategorise::create([
            'urut' => '8',
            'tanya' => 'Tingkat kekritisan proses yang ada dalam aplikasi, relatif terhadap ancaman upaya penyerangan atau penerobosan keamanan informasi',
            'j1' => 'Proses yang berisiko mengganggu hajat hidup orang banyak dan memberi dampak langsung pada layanan publik',
            'j2' => 'Proses yang beresiko mengganggu hajat hidup orang banyak dan memberi dampak tidak langsung',
            'j3' => 'Proses yang berdampak pada bisnis perusahaan'
        ]);
        Kategorise::create([
            'urut' => '9',
            'tanya' => 'Dampak dari kegagalan aplikasi',
            'j1' => 'Tidak tersediaya layanan publik berskala nasional atau membahayakan pertanahan keamanan negara',
            'j2' => 'Tidak tersedianya layanan publik dalam 1 provinsi atau lebih',
            'j3' => 'Tidak tersedianya layanan publik dalam 1 kabupaten/kota atau lebih'
        ]);
        Kategorise::create([
            'urut' => '10',
            'tanya' => 'Potensi kerugian atau dampak negatif dari insiden ditembusnya keamanan aplikasi (sabotase, terorisme)',
            'j1' => 'Menimbulkan korban jiwa',
            'j2' => 'Terbatas pada kerugian finansial',
            'j3' => 'Mengakibatkan ganggunan operasional sementara (tidak membahayakan dan mengakibatkan kurgian finansial)'
        ]);
    }
}
