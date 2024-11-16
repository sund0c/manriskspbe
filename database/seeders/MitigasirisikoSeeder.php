<?php

namespace Database\Seeders;

use App\Models\Mitigasirisiko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitigasirisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
        ['inherentrisiko' => '1','poc' => 'Akses API yang sensitif dengan tanpa melalui otentikasi','mitigasi' => 'Menerapkan endpoint API senisitif hanya dapat diakses setelah autentikasi dan otorisasi. Menerapkan batasan akses API dengan aturan seperti rate limiting, serta validasi token autentikasi yang kuat'],
        ['inherentrisiko' => '1','poc' => 'Akses (bypass) aturan kontrol akses di halaman tertentu','mitigasi' => 'Menerapkan kebijakan keamanan yang konsisten di seluruh aplikasi. Menggunakan Security Policy Rules (role-based, hanya admin bisa melakukan apa) atau Access Control Lists (mengatur lebih detil pengguna/grup bisa melakukan apa saja) yang terdefinisi dengan baik di seluruh endpoint dan modul aplikasi'],
        ['inherentrisiko' => '1','poc' => 'Akses fungsi yang memerlukan autentikasi tanpa login','mitigasi' => 'Menerapkan kontrol autentikasi di semua fungsi yang memerlukan akses terbatas'],
        ['inherentrisiko' => '1','poc' => 'Cari apakah ada log yang memadai untuk melakukan deteksi akses yang tidak sah','mitigasi' => 'Menerapkan logging dan monitoring aktif terhadap semua akses ke data atau fungsi sensitif'],
        ['inherentrisiko' => '1','poc' => 'Akses parameter ID untuk melihat atau memodifikasi data milik pengguna lain','mitigasi' => 'Menerapkan teknik Object-Level Access Control dengan validasi parameter ID pada server untuk memastikan bahwa setiap permintaan hanya mengakses data milik pengguna yang sah'],
        ['inherentrisiko' => '1','poc' => 'Masukkan ID numerik increment untuk melihat atau memodifikasi data milik pengguna lain','mitigasi' => 'Menggunakan UUID sebagai pengenal unik untuk data sensitif'],
        ['inherentrisiko' => '1','poc' => 'Akses menu/path admin menggunakan akun bukan admin','mitigasi' => 'Memisahkan fungsi administratif dari fungsi umum dalam URL atau subdomain yang berbeda dan batasi akses hanya pada peran administratif'],

        ['inherentrisiko' => '2','poc' => 'Cek ke databasenya apakah dapat melihat password pengguna dalam format yang dapat dibaca','mitigasi' => 'Menggunakan algoritma hashing yang kuat seperti bcrypt, scrypt, atau Argon2 untuk menyimpan password'],
        ['inherentrisiko' => '2','poc' => 'Lakukan dekripsi database','mitigasi' => 'Penerapan algoritma yang update dengan algoritma yang lebih aman seperti AES (Advanced Encryption Standard) dengan panjang kunci minimal 256-bit'],
        ['inherentrisiko' => '2','poc' => 'Cek apakah aplikasi masih menggunakan kunci enkripsi yang terlalu pendek, misalnya, menggunakan AES-128 ketika AES-256 lebih disarankan','mitigasi' => 'Menggunakan panjang kunci yang lebih aman, minimal AES-256 untuk enkripsi data'],
        ['inherentrisiko' => '2','poc' => 'Cek apakah dapat menemukan dan mengakses lokasi penyimpanan kunci dan gunakan untuk mendekripsi data','mitigasi' => 'Menggunakan Hardware Security Modules (HSM) atau key management systems untuk penyimpanan kunci'],
        ['inherentrisiko' => '2','poc' => 'Lakukan serangan man-in-the-middle dalam jaringan yang sama  dan akses data yang tidak terenkripsi','mitigasi' => 'Menggunakan HTTPS (SSL/TLS) untuk mengenkripsi data yang dikirim antara klien dan server. Menggunakan protokol TLS dengan versi terbaru untuk semua'],
        ['inherentrisiko' => '2','poc' => 'Cek informasi di URL atau header untuk mendapatkan akses ke data yang terenkripsi','mitigasi' => 'Tidak mengirimkan kunci atau data sensitif dalam URL atau header. Menggunakan secure cookie atau request body untuk mengirimkan informasi sensitif, pastikan terenkripsi dan hanya bisa diakses oleh pengguna yang sah'],

        ['inherentrisiko' => '7','poc' => 'Coba masukkan password yang lemah, bisa dengan brute-force','mitigasi' => 'Menerapkan kebijakan Password yang kuat yang mengharuskan pengguna membuat password minimal 8 karakter dan mengandung kombinasi huruf besar, huruf kecil, angka, dan karakter khusus'],
        ['inherentrisiko' => '7','poc' => 'Tebak dan masuk menggunakan default credential ke dalam aplikasi tanpa otentikasi lebih lanjut','mitigasi' => 'Pastikan untuk mengharuskan pengguna mengganti password default pada saat pertama kali login. Password tidak boleh sama dengan 3 password sebelumnya atau default'],
        ['inherentrisiko' => '7','poc' => 'Coba cek apakah aplikasi hanya mengandalkan username dan password untuk autentikasi tanpa lapisan keamanan tambahan','mitigasi' => 'Menerapkan 2FA'],
        ['inherentrisiko' => '7','poc' => 'Coba akses fisik ke perangkat pengguna yang sesi yang belum kedaluwarsa untuk mendapatkan akses tanpa autentikasi','mitigasi' => 'Menerapkan pengaturan waktu kedaluwarsa sesi 15–30 menit. Menggunakan secure cookie dan HttpOnly'],
        ['inherentrisiko' => '7','poc' => 'Coba login dengan berbagai kombinasi password tanpa batasan','mitigasi' => 'Menerapkan batasan percakapan login dengan penggunaan mekanisme seperti captcha atau penundaan antara percakapan login setelah beberapa kali gagal'],
        ['inherentrisiko' => '7','poc' => 'Cek database apakah password disimpan dalam plaintext tanpa menggunakan algoritma hashing','mitigasi' => 'Hash password dengan algoritma yang kuat seperti bcrypt, scrypt, atau Argon2'],
        ['inherentrisiko' => '7','poc' => 'Gunakan ID sesi yang valid pengguna lain untuk mendapatkan akses ke aplikasi setelah login','mitigasi' => 'Menerapkan regenerasi ID sesi saat login atau setelah otentikasi'],
        ['inherentrisiko' => '7','poc' => 'Coba curi dan gunakan token autentikasi (misalnya, JWT) untuk masuk tanpa perlu login','mitigasi' => 'Menggunakan JWT dengan waktu kedaluwarsa yang pendek dan rotasi token secara berkala'],
    ];

    foreach ($data as $item) {
        // Cari apakah ada entri dengan 'kerawanan' yang sama
        $existingRecord = Mitigasirisiko::where('mitigasi', $item['mitigasi'])->first();

        if (!$existingRecord) {
            // Hanya buat entri baru jika tidak ada entri dengan 'kerawanan' yang sama
            Mitigasirisiko::create($item);
        }
    }


}
}
