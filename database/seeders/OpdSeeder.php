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
        Opd::create(['nama' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia','singkatan' => 'BKPSDM']);
        Opd::create(['nama' => 'UPTD Penilaian Kompetensi Pegawai','singkatan' => 'UPT PKP']);
        Opd::create(['nama' => 'UPTD. Balai Sertifikasi Mutu dan Keamanan Pangan Provinsi Bali','singkatan' => 'UPT BSMKP']);
        Opd::create(['nama' => 'Dinas PUPRKIM Provinsi Bali','singkatan' => 'PUPR']);
        Opd::create(['nama' => 'DINAS PEMAJUAN MASYARAKAT ADAT PROVINSI BALI','singkatan' => 'PMA']);
        Opd::create(['nama' => 'Inspektorat Daerah Provinsi Bali','singkatan' => 'INSPEKTORAT']);
        Opd::create(['nama' => 'Dinas Pariwisata Provinsi Bali','singkatan' => 'DISPAR']);
        Opd::create(['nama' => 'Badan Kesatuan Bangsa dan Politik Provinsi Bali','singkatan' => 'KESBANGPOL']);
        Opd::create(['nama' => 'Dinas Pemberdayaan Masyarakat, Desa, Kependudukan dan Pencatatan Sipil Provinsi Bali','singkatan' => 'PMDDUKCAPIL']);
        Opd::create(['nama' => 'Dinas Kelautan dan Perikanan Provinsi Bali (UPTD. Pengujian dan Penerapan Mutu Hasil Perikanan)','singkatan' => 'DISKELKAN']);
        Opd::create(['nama' => 'Badan Pendapatan Daerah Provinsi Bali','singkatan' => 'BAPENDA']);
        Opd::create(['nama' => 'Dinas Pendidikan Kepemudaan dan Olahraga Provinsi Bali','singkatan' => 'DISDIKPORA']);
        Opd::create(['nama' => 'Rumah Sakit Jiwa Provinsi Bali','singkatan' => 'RSJ']);
        Opd::create(['nama' => 'BPBD Provinsi Bali','singkatan' => 'BPBD']);
        Opd::create(['nama' => 'Badan Pengelola Keuangan dan Aset Daerah Provinsi Bali','singkatan' => 'BPKAD']);
        Opd::create(['nama' => 'UPTD. Balai Pengembangan Teknologi Pendidikan','singkatan' => 'UPT BPTP']);
        Opd::create(['nama' => 'Dinas Ketenagakerjaan dan Energi Sumber Daya Mineral Provinsi Bali','singkatan' => 'DISNAKERESDM']);
        Opd::create(['nama' => 'Dinas Kesehatan Provinsi Bali','singkatan' => 'DINKES']);
        Opd::create(['nama' => 'Dinas Kebudayaan Provinsi Bali','singkatan' => 'DISBUD']);
        Opd::create(['nama' => 'Dinas Perindustrian dan Perdagangan Provinsi Bali','singkatan' => 'DISPERINDAG']);
        Opd::create(['nama' => 'Sekretariat DPRD Provinsi Bali','singkatan' => 'SEKWAN']);
        Opd::create(['nama' => 'Dinas Komunikasi, Informatika dan Statistik','singkatan' => 'DISKOMINFOS']);
        Opd::create(['nama' => 'RS Bali Mandara','singkatan' => 'RSBM']);
        Opd::create(['nama' => 'RS Mata Bali Mandara','singkatan' => 'RSMATA']);
        Opd::create(['nama' => 'Badan Perencanaan Daerah','singkatan' => 'BAPEDA']);
        Opd::create(['nama' => 'Biro Hukum','singkatan' => 'BIROHUKUM']);
        Opd::create(['nama' => 'Biro Organisasi','singkatan' => 'BIRORG']);
        Opd::create(['nama' => 'Biro Pemerintahan','singkatan' => 'BIROPEM']);
        Opd::create(['nama' => 'Biro Umum','singkatan' => 'BIROUMUM']);
    }
}



