<?php

namespace Database\Seeders;

use App\Models\Itemdampakvital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemdampakvitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Itemdampakvital::create([
            'urut' => '1',
            'tanya' => 'Tingkat penurunan kemampuan dalam menjalankan fungsi utama atau layanan akibat kegagalan, gangguan, kerusakan dan/atau kehancuran pada Sistem Elektronik',
            'j1' => '(MINOR) Menimbulkan gangguan kecil atau minor pada keberlangsungan fungsi utama atau layanan yang masih dapat ditangani secara operasional.',
            'j2' => '(TERBATAS) Menimbulkan gangguan menengah pada keberlangsungan fungsi utama atau layanan yang memerlukan peninjauan atau perubahan operasional proses bisnis dari kondisi normal.',
            'j3' => '(SIGNIFIKAN) Menimbulkan gangguan signifikan pada keberlangsungan fungsi utama dan/atau terhentinya sebagian layanan (parsial), dan berpengaruh pada satu sektor.',
            'j4' => '(SERIUS) Menimbulkan kehancuran, kegagalan,  dan/atau kehilangan kendali terhadap fungsi utama,  dan/atau terhentinya sebagian besar layanan, dan menyebabkan gangguan lebih dari satu sektor, dan berpotensi berdampak pada level nasional.',
            'domain' => '1'
        ]);
        Itemdampakvital::create([
            'urut' => '2',
            'tanya' => 'Lama penundaan (down time) 8 (delapan) jam dan pemulihan proses bisnis akibat kegagalan, gangguan, kerusakan dan/atau kehancuran pada Sistem Elektronik.',
            'j1' => '(MINOR) Menimbulkan gangguan kecil atau minor pada keberlangsungan fungsi utama, atau layanan yang masih dapat ditangani secara operasional.',
            'j2' => '(TERBATAS) Menimbulkan gangguan menengah pada keberlangsungan fungsi utama, atau layanan yang memerlukan peninjauan, atau perubahan operasional proses bisnis dari kondisi normal.',
            'j3' => '(SIGNIFIKAN) Menimbulkan gangguan signifikan pada keberlangsungan fungsi utama, dan/atau terhentinya sebagian layanan (parsial), berpengaruh pada satu sektor.',
            'j4' => '(SERIUS) Menimbulkan kehancuran, kegagalan,  dan/atau kehilangan kendali terhadap fungsi utama,  dan/atau terhentinya sebagian besar layanan dan menyebabkan gangguan lebih dari satu sektor, dan berpotensi berdampak pada level nasional.',
            'domain' => '1'
        ]);
        Itemdampakvital::create([
            'urut' => '3',
            'tanya' => 'Cakupan wilayah ketersediaan layanan akibat kegagalan, gangguan, kerusakan dan/atau kehancuran pada Sistem Elektronik',
            'j1' => '(MINOR) Tidak tersedianya layanan bersifat lokal dan terbatas pada suatu instansi atau institusi.',
            'j2' => '(TERBATAS) Tidak tersedianya layanan bersifat lokal dan luas dalam lingkup instansi atau institusi atau parsial pada beberapa sektor, wilayah tertentu.',
            'j3' => '(SIGNIFIKAN) Tidak tersedianya layanan, menyeluruh pada satu sektor, atau  wilayah tertentu.',
            'j4' => '(SERIUS) Tidak tersedianya layanan berskala nasional, menyeluruh pada seluruh sektor, dan berpotensi berdampak pada level nasional.',
            'domain' => '1'
        ]);
        Itemdampakvital::create([
            'urut' => '4',
            'tanya' => 'Gangguan Rantai Pasok akibat kegagalan, gangguan dan/atau kerusakan pada Sistem Elektronik',
            'j1' => '(MINOR) Menimbulkan gangguan minor pada keberlangsungan fungsi utama, atau layanan yang masih dapat ditangani secara operasional.',
            'j2' => '(TERBATAS) Menimbulkan gangguan menengah pada keberlangsungan fungsi utama, atau layanan, yang memerlukan peninjauan, atau perubahan operasional proses bisnis dari kondisi normal.',
            'j3' => '(SIGNIFIKAN) Menimbulkan gangguan signifikan pada keberlangsungan fungsi utama, dan/atau terhentinya sebagian layanan (parsial) pada suatu sektor.',
            'j4' => '(SERIUS) Menimbulkan kehancuran, kegagalan,  dan/atau kehilangan kendali terhadap fungsi utama, dan/atau terhentinya sebagian besar layanan dan menyebabkan gangguan lebih dari satu sektor, dan berpotensi berdampak pada level nasional.',
            'domain' => '1'
        ]);
        Itemdampakvital::create([
            'urut' => '5',
            'tanya' => 'Tingkat Dampak akibat kegagalan, gangguan dan/atau kerusakan data dan/atau informasi yang dikelola oleh Sistem Elektronik pada Aspek Kerahasiaan',
            'j1' => '(MINOR) Pengungkapan informasi yang terkait dengan aset baik berupa data, informasi, infrastruktur, perangkat, proses yang menyimpan dan/atau mengelola data atau informasi, dapat mengakibatkan kerugian yang bersifat terbatas pada institusi atau instansi.',
            'j2' => '(TERBATAS) Pengungkapan informasi yang terkait dengan aset baik berupa data, informasi infrastruktur, perangkat, proses yang menyimpan dan/atau mengelola data atau informasi, dapat mengakibatkan kerugian  pada lebih dari satu instansi atau institusi dalam satu sektor.',
            'j3' => '(SIGNIFIKAN) Pengungkapan informasi yang terkait dengan aset baik berupa data, informasi, infrastruktur, perangkat, proses yang menyimpan dan/atau mengelola data atau informasi, dapat mengakibatkan kerugian  pada instansi atau institusi lebih dari satu sektor.',
            'j4' => '(SERIUS) Pengungkapan Informasi yang terkait dengan aset baik berupa data, informasi, infrastruktur, perangkat, proses yang menyimpan dan/atau mengelola data atau informasi secara tidak sah dapat mengakibatkan dampak yang serius dan luas pada tingkat nasional.',
            'domain' => '2'
        ]);
        Itemdampakvital::create([
            'urut' => '6',
            'tanya' => 'Tingkat Dampak akibat modifikasi dan/atau kerusakan data dan/atau informasi yang dikelola oleh Sistem Elektronik pada Aspek Integritas',
            'j1' => '(MINOR) Modifikasi atau kerusakan pada aset baik berupa data, informasi, infrastruktur, perangkat, proses yang menyimpan dan/atau mengelola data atau informasi, dapat mengakibatkan kerugian yang bersifat terbatas pada institusi atau instansi.',
            'j2' => '(TERBATAS) Modifikasi atau kerusakan pada aset baik berupa data, informasi infrastruktur, perangkat, proses yang menyimpan dan/atau mengelola data, atau informasi, dapat mengakibatkan kerugian  pada lebih dari satu instansi atau institusi dalam satu sektor.',
            'j3' => '(SIGNIFIKAN) Modifikasi atau kerusakan pada aset baik berupa data, informasi, infrastruktur, perangkat, proses yang menyimpan dan/atau mengelola data atau informasi, dapat mengakibatkan kerugian  pada instansi atau institusi lebih dari satu sektor.',
            'j4' => '(SERIUS) Modifikasi atau kerusakan pada baik berupa data, informasi, infrastruktur, perangkat, proses yang menyimpan dan/atau mengelola data atau informasi secara tidak sah dapat mengakibatkan dampak yang serius dan luas pada tingkat nasional.',
            'domain' => '2'
        ]);
        Itemdampakvital::create([
            'urut' => '7',
            'tanya' => 'Tingkat Dampak akibat gangguan akses data dan/atau informasi yang dikelola oleh Sistem Elektronik pada Aspek Ketersediaan',
            'j1' => '(MINOR) Gangguan atau kegagalan terhadap akses sistem elektronik, yang menyimpan dan/atau mengelola data atau informasi dapat  mengakibatkan kerugian, yang bersifat terbatas pada instansi atau institusi.',
            'j2' => '(TERBATAS) Gangguan atau kegagalan terhadap akses sistem elektronik yang menyimpan dan/atau mengelola data, atau informasi, dapat mengakibatkan kerugian  pada lebih dari satu instansi atau institusi dalam satu sektor.',
            'j3' => '(SIGNIFIKAN) Gangguan atau kegagalan terhadap akses sistem elektronik yang menyimpan dan/atau mengelola data, atau informasi, dapat mengakibatkan kerugian  pada instansi atau institusi lebih dari satu sektor.',
            'j4' => '(SERIUS) Gangguan atau kegagalan terhadap akses Sistem Elektronik, yang menyimpan dan/atau mengelola data, atau informasi mengakibatkan, dampak yang serius dan luas pada tingkat nasional.',
            'domain' => '2'
        ]);
        Itemdampakvital::create([
            'urut' => '8',
            'tanya' => 'Lama penundaan pendapatan dalam kurun waktu tertentu akibat hilang, bocor, dan/atau rusaknya data/informasi dan/atau Sistem Elektronik dan berdampak pada arus kas',
            'j1' => '(MINOR) Mengakibatkan kerugian finansial antara 0.01% s.d. 0,05% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j2' => '(TERBATAS) Mengakibatkan kerugian finansial antara 0.05% s.d. 2% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j3' => '(SIGNIFIKAN) Mengakibatkan kerugian finansial antara 2% s.d. 5% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j4' => '(SERIUS) Mengakibatkan kerugian finansial diatas 5% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'domain' => '3'
        ]);
        Itemdampakvital::create([
            'urut' => '9',
            'tanya' => 'Tingkat kehilangan pendapatan akibat kegagalan, gangguan dan/atau kerusakan Sistem Elektronik (revenue)',
            'j1' => '(MINOR) Mengakibatkan kehilangan pendapatan, antara 0.01% s.d. 0,05% dari arus kas, atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j2' => '(TERBATAS) Mengakibatkan kehilangan pendapatan, antara 0.05% s.d. 2% dari arus kas, atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j3' => '(SIGNIFIKAN) Mengakibatkan kehilangan pendapatan, antara 2% s.d. 5% dari arus kas, atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j4' => '(SERIUS) Mengakibatkan kehilangan pendapatan, diatas 5% dari arus kas, atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'domain' => '3'
        ]);
        Itemdampakvital::create([
            'urut' => '10',
            'tanya' => 'Persentase biaya pemulihan akibat Kegagalan, gangguan dan/atau kerusakan pada Sistem Elektronik',
            'j1' => '(MINOR) Membutuhkan biaya pemulihan, antara 0.01% s.d. 0,05% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j2' => '(TERBATAS) Membutuhkan biaya pemulihan, antara 0.05% s.d. 2% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j3' => '(SIGNIFIKAN) Membutuhkan biaya pemulihan, antara 2% s.d. 5% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j4' => '(SERIUS) Membutuhkan biaya pemulihan, diatas 5% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'domain' => '3'
        ]);
        Itemdampakvital::create([
            'urut' => '11',
            'tanya' => 'Persentase biaya denda/penalti/sanksi yang dikeluarkan akibat kegagalan, gangguan dan/atau kerusakan pada Sistem Elektronik',
            'j1' => '(MINOR) Mengeluarkan biaya denda, penalti atau sanksi, antara 0.01% s.d. 0,05% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j2' => '(TERBATAS) Mengeluarkan biaya denda, penalti atau sanksi, antara 0.05% s.d. 2% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j3' => '(SIGNIFIKAN) Mengeluarkan biaya denda, penalti atau sanksi, antara 2% s.d. 5% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j4' => '(SERIUS) Mengeluarkan biaya denda, penalti atau sanksi, diatas 5% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'domain' => '3'
        ]);
        Itemdampakvital::create([
            'urut' => '12',
            'tanya' => 'Persentase kerugian akibat kehilangan atau kerusakan aset akibat kegagalan, gangguan dan/atau kerusakan pada Sistem Elektronik',
            'j1' => '(MINOR) Mengakibatkan kerugian finansial antara 0.01% s.d. 0,05% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j2' => '(TERBATAS) Mengakibatkan kerugian finansial antara 0.05% s.d. 2% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j3' => '(SIGNIFIKAN) Mengakibatkan kerugian finansial antara 2% s.d. 5% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'j4' => '(SERIUS) Mengakibatkan kerugian finansial diatas 5% dari arus kas atau total anggaran belanja instansi atau institusi dalam satu tahun.',
            'domain' => '3'
        ]);
        Itemdampakvital::create([
            'urut' => '13',
            'tanya' => 'Tingkat dampak pada kepentingan Umum akibat kegagalan, gangguan, kerusakan dan/atau kehancuran pada Sistem Elektronik.',
            'j1' => '(MINOR) Berdampak minor atau menimbulkan gangguan kecil yang dapat ditoleransi, dan ditangani secara operasional, pada kepentingan sebagian besar lapisan masyarakat seperti kesehatan, keselamatan, dan layanan lainnya baik yang diberikan oleh pemerintah maupun swasta.',
            'j2' => '(TERBATAS) Berdampak menengah pada kepentingan sebagian besar lapisan masyarakat seperti kesehatan, keselamatan, dan layanan lainnya, baik yang diberikan oleh pemerintah maupun swasta, yang memerlukan peninjauan atau perubahan operasional proses bisnis dari kondisi normal.',
            'j3' => '(SIGNIFIKAN) Berdampak signifikan pada kepentingan sebagian besar lapisan masyarakat seperti kesehatan, keselamatan dan layanan lainnya baik yang diberikan oleh pemerintah maupun pemerintah.',
            'j4' => '(SERIUS) Berdampak serius pada kepentingan sebagian besar lapisan masyarakat seperti kesehatan, keselamatan, dan layanan lainnya baik yang diberikan oleh pemerintah maupun swasta.',
            'domain' => '4'
        ]);
        Itemdampakvital::create([
            'urut' => '14',
            'tanya' => 'Tingkat dampak pada pelayanan publik akibat kegagalan, gangguan, kerusakan dan/atau kehancuran pada Sistem Elektronik',
            'j1' => '(MINOR) Gangguan pada Sistem Elektronik menyebabkan beberapa pelayanan publik tertentu mengalami keterlambatan atau penundaan, namun masih dapat diatasi dengan cepat tanpa menyebabkan gangguan yang serius dalam fungsi negara; atau  keterlambatan pelayanan publik hanya mempengaruhi sejumlah kecil warga negara, tidak melebihi 0.1% dari total populasi.',
            'j2' => '(TERBATAS) Gangguan pada Sistem Elektronik mempengaruhi lebih dari satu pelayanan publik penting dan menyebabkan keterlambatan yang lebih serius, mengakibatkan ketidakpuasan masyarakat terhadap pemerintah dan meningkatnya kebutuhan untuk pemulihan; atau  keterlambatan pelayanan publik mempengaruhi sejumlah signifikan warga negara, sekitar 0.1% hingga 1% dari total populasi.',
            'j3' => '(SIGNIFIKAN) Kegagalan Sistem Elektronik mengganggu beberapa pelayanan publik penting, dan menyebabkan krisis pada tingkat sektoral; atau  keterlambatan atau tidak berfungsinya pelayanan publik mempengaruhi sejumlah besar warga negara, sekitar 1% hingga 10% dari total populasi. Diperlukan respons dari pemerintah untuk mengatasi situasi ini.',
            'j4' => '(SERIUS) Kerusakan atau kegagalan Sistem Elektronik berdampak luas pada hampir semua sektor pelayanan publik utama, mengakibatkan krisis nasional yang melibatkan stabilitas sosial, keamanan, dan ekonomi.  keterlambatan atau tidak berfungsinya pelayanan publik berdampak pada mayoritas warga negara, melebihi 10% dari total populasi. Negara memerlukan upaya yang komprehensif untuk pemulihan.',
            'domain' => '4'
        ]);
        Itemdampakvital::create([
            'urut' => '15',
            'tanya' => 'Tingkat dampak pada pertahanan dan keamanan negara akibat kegagalan, gangguan, kerusakan dan/atau kehancuran pada Sistem Elektronik.',
            'j1' => '(MINOR) Gangguan pada Sistem Elektronik menyebabkan gangguan terbatas pada sistem komunikasi dan kendali pertahanan dan keamanan negara, tetapi tidak menyebabkan kerentanan serius terhadap ancaman eksternal.',
            'j2' => '(TERBATAS) Gangguan pada Sistem Elektronik mempengaruhi beberapa aspek vital dalam sistem pertahanan, menyebabkan keterbatasan kemampuan pertahanan dan keamanan negara untuk merespons ancaman eksternal, dan memerlukan peninjauan atau perubahan operasional proses bisnis dari kondisi normal.',
            'j3' => '(SIGNIFIKAN) Kegagalan Sistem Elektronik menyebabkan sejumlah besar komponen utama dalam sistem pertahanan menjadi tidak berfungsi, mengakibatkan kerentanan yang signifikan terhadap ancaman eksternal.',
            'j4' =>'(SERIUS) Kerusakan atau kegagalan pada Sistem Elektronik mengakibatkan kegagalan hampir seluruh sistem komunikasi atau kendali pertahanan dan keamanan negara, menyebabkan ancaman serius terhadap integritas dan keamanan negara.',
            'domain' => '4'
        ]);
        Itemdampakvital::create([
            'urut' => '16',
            'tanya' => 'Tingkat dampak pada perekonomian nasional akibat kegagalan, gangguan, kerusakan dan/atau kehancuran pada Sistem Elektronik.',
            'j1' => '(MINOR) Berdampak minor pada sektor-sektor ekonomi tertentu dan cenderung bersifat sementara. instansi atau institusi mengalami sedikit kendala operasional, tetapi masih dapat beroperasi secara umum.',
            'j2' => '(TERBATAS) Berdampak menengah pada beberapa sektor utama ekonomi. Beberapa instansi atau institusi mengalami penurunan produktivitas pada sektor tertentu dan memerlukan upaya pemulihan yang lebih serius.',
            'j3' => '(SIGNIFIKAN) Berdampak signifikan pada perekonomian nasional, menyebabkan beberapa sektor ekonomi terdampak. perusahaan lebih dari satu sektor, menghadapi hambatan besar dalam operasional dan kesulitan pemulihan yang kompleks.',
            'j4' => '(SERIUS) Berdampak serius pada perekonomian nasional, yang mengakibatkan hampir seluruh sektor ekonomi mengalami gangguan serius, dan mengancam keberlangsungan perekonomian nasional.',
            'domain' => '4'
        ]);
        Itemdampakvital::create([
            'urut' => '17',
            'tanya' => 'Dampak terhadap keselamatan dan/atau menimbulkan korban jiwa akibat kegagalan, gangguan dan/atau kerusakan pada Sistem Elektronik.',
            'j1' => '(MINOR) Berdampak minor terhadap keselamatan, potensi korban jiwa < 10.',
            'j2' => '(TERBATAS) Berdampak menengah terhadap keselamatan, potensi korban jiwa 10 s/d 50.',
            'j3' => '(SIGNIFIKAN)Berdampak signifikan terhadap keselamatan, potensi korban jiwa 50 s/d 150.',
            'j4' => '(SERIUS) Berdampak serius terhadap keselamatan, potensi korban jiwa > 150.',
            'domain' => '4'
        ]);
        Itemdampakvital::create([
            'urut' => '18',
            'tanya' => 'Dampak saling ketergantungan rantai pasok antar sektor: dampak terhadap suatu sektor dan pengaruhnya terhadap sektor lain, yang ditimbulkan jika terjadi kegagalan, gangguan dan/atau kerusakan pada rantai pasok layanan yang ditunjang Sistem Elektronik.',
            'j1' => '(MINOR) Berdampak minor atau menimbulkan gangguan kecil dalam satu sektor atau sektor IIV lain yang masih dapat ditangani atau di bawah batas gangguan yang dapat ditoleransi.',
            'j2' => '(TERBATAS) menimbulkan gangguan menengah terhadap keberlangsungan layanan sektor IIV lain atau mencapai ambang batas gangguan yang dapat ditoleransi.',
            'j3' => '(SIGNIFIKAN) menimbulkan gangguan besar terhadap keberlangsungan layanan sektor IIV lain atau di atas ambang batas gangguan yang dapat ditoleransi,  menimbulkan terhentinya layanan suatu sektor atau sektor lain di atas ambang batas downtime yang dapat ditoleransi.',
            'j4' => '(SERIUS) menimbulkan gangguan serius terhadap keberlangsungan layanan sektor IIV lain atau di atas ambang batas gangguan yang dapat ditoleransi dan menimbulkan terhentinya atau kehilangan kontrol atas suatu layanan pada lebih dari satu sektor.',
            'domain' => '5'
        ]);
        Itemdampakvital::create([
            'urut' => '19',
            'tanya' => 'Dampak saling ketergantungan Sistem Elektronik: Tingkat gangguan atau kegagalan pada suatu Sistem Elektronik dapat berdampak pada Sistem Elektronik lain yang terhubung dan/atau saling bergantung satu sama lain.',
            'j1' => '(MINOR) Gangguan pada saling ketergantungan antar layanan sistem elektronik hanya mempengaruhi sebagian kecil dari total sistem, dan dampaknya hanya bersifat sementara. Kondisi ini dapat diatasi dengan cepat dan tidak menimbulkan dampak yang serius pada operasional negara.',
            'j2' => '(TERBATAS) Gangguan pada saling ketergantungan antar layanan Sistem Elektronik mempengaruhi beberapa sektor vital, dan beberapa entitas, instansi atau institusi terkena dampak, tetapi dampaknya masih terkendali.',
            'j3' => '(SIGNIFIKAN) Kegagalan Sistem Elektronik menyebabkan mayoritas layanan Sistem Elektronik mengalami gangguan yang signifikan. Tingkat kompleksitas pemulihan yang tinggi dan mengakibatkan gangguan yang luas pada operasional negara, berpengaruh pada seluruh sektor secara parsial.',
            'j4' => '(SERIUS) Kerusakan atau kegagalan pada Sistem Elektronik menyebabkan terhenti atau kehilangan kontrol pada sebagian besar atau bahkan seluruh layanan Sistem Elektronik, menciptakan efek domino dalam interdependensi dan mengganggu operasional negara. Berpengaruh pada seluruh sektor secara menyeluruh.',
            'domain' => '5'
        ]);


    }
}
