<?php
use App\Http\Controllers\MitigasirisikoController;
use App\Http\Controllers\InherentrisikoController;
use App\Http\Controllers\IteminherentrisikoController;
use App\Http\Controllers\BackupdbController;
use App\Http\Controllers\LayananspbeController;
use App\Http\Controllers\AreadampakController;
use App\Http\Controllers\KriteriakemungkinanController;
use App\Http\Controllers\AsetkategoriController;
use App\Http\Controllers\AsetklasifikasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\DampakvitalController;
use App\Http\Controllers\AsetdampakvitalController;
use App\Http\Controllers\ItemdampakvitalController;
use App\Http\Controllers\ItemklasifikasiController;
use App\Http\Controllers\KategoriseController;
use App\Http\Controllers\KriteriaannexController;
use App\Http\Controllers\ItemannexController;
use App\Http\Controllers\AnnexController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\AsetinherenController;
use App\Http\Controllers\AsetrController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    return view('dashboard');})->middleware(['auth', 'verified','no.cache'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth','html.purifier','no.cache','verified','role:admin')->group(function () {
    Route::get('user', [UserController::class, 'tampil'])->name('user.tampil');
    Route::delete('user/hapus/{id}', [userController::class, 'hapus'])->name('user.hapus');
    Route::post('user/tambah', [userController::class, 'tambah'])->name('user.tambah');
    Route::put('user/update/{id}', [userController::class, 'update'])->name('user.update');

    Route::get('opd', [OpdController::class, 'tampil'])->name('opd.tampil');
    Route::delete('opd/hapus/{id}', [OpdController::class, 'hapus'])->name('opd.hapus');
    Route::post('opd/tambah', [OpdController::class, 'tambah'])->name('opd.tambah');
    Route::put('opd/update/{id}', [OpdController::class, 'update'])->name('opd.update');

    Route::get('inherentrisiko', [InherentrisikoController::class, 'tampil'])->name('inherentrisiko.tampil');

    Route::get('iteminherentrisiko/{id}', [IteminherentrisikoController::class, 'tampil'])->name('iteminherentrisiko.tampil');
    Route::delete('iteminherentrisiko/hapus/{id}/{jenis}', [IteminherentrisikoController::class, 'hapus'])->name('iteminherentrisiko.hapus');
    Route::post('iteminherentrisiko/tambah', [IteminherentrisikoController::class, 'tambah'])->name('iteminherentrisiko.tambah');
    Route::put('iteminherentrisiko/update/{id}', [IteminherentrisikoController::class, 'update'])->name('iteminherentrisiko.update');
    Route::get('iteminherentrisiko/csv/{id}', [IteminherentrisikoController::class, 'csv'])->name('iteminherentrisiko.csv');

    Route::delete('mitigasirisiko/hapus/{id}/{idinherent}/{idaset}/{kerawanan}', [MitigasirisikoController::class, 'hapus'])->name('mitigasirisiko.hapus');
    Route::get('mitigasirisiko/{idinherent}/{idaset}/{kerawanan}', [MitigasirisikoController::class, 'tampil'])->name('mitigasirisiko.tampil');
    Route::post('mitigasirisiko/tambah', [MitigasirisikoController::class, 'tambah'])->name('mitigasirisiko.tambah');
    Route::put('mitigasirisiko/update/{id}', [MitigasirisikoController::class, 'update'])->name('mitigasirisiko.update');

    Route::get('areadampak', [AreadampakController::class, 'tampil'])->name('areadampak.tampil');
    Route::put('areadampak/update/{id}', [AreadampakController::class, 'update'])->name('areadampak.update');
    Route::get('areadampak/pdf', [AreadampakController::class, 'pdf'])->name('areadampak.pdf');
    Route::get('kriteriakemungkinan', [KriteriakemungkinanController::class, 'tampil'])->name('kriteriakemungkinan.tampil');
    Route::put('kriteriakemungkinan/update/{id}', [KriteriakemungkinanController::class, 'update'])->name('kriteriakemungkinan.update');
    Route::get('kriteriakemungkinan/pdf', [KriteriakemungkinanController::class, 'pdf'])->name('kriteriakemungkinan.pdf');

    Route::get('layananspbe', [LayananspbeController::class, 'tampil'])->name('layananspbe.tampil');
    Route::delete('layananspbe/hapus/{id}', [LayananspbeController::class, 'hapus'])->name('layananspbe.hapus');
    Route::post('layananspbe/tambah', [LayananspbeController::class, 'tambah'])->name('layananspbe.tambah');
    Route::put('layananspbe/update/{id}', [LayananspbeController::class, 'update'])->name('layananspbe.update');
    Route::get('annex', [AnnexController::class, 'tampil'])->name('annex.tampil');
    Route::put('annex/update/{id}', [AnnexController::class, 'update'])->name('annex.update');
    Route::delete('itemannex/hapus/{id}/{domain}', [ItemannexController::class, 'hapus'])->name('itemannex.hapus');
    Route::get('itemannex/{id}', [ItemannexController::class, 'tampil'])->name('itemannex.tampil');
    Route::post('itemannex/tambah', [ItemannexController::class, 'tambah'])->name('itemannex.tambah');
    Route::put('itemannex/update/{id}/{domain}', [ItemannexController::class, 'update'])->name('itemannex.update');
    Route::get('kriteriaannex/{id}', [KriteriaannexController::class, 'tampil'])->name('kriteriaannex.tampil');
    Route::delete('kriteriaannex/hapus/{id}/{item}', [KriteriaannexController::class, 'hapus'])->name('kriteriaannex.hapus');
    Route::post('kriteriaannex/tambah', [KriteriaannexController::class, 'tambah'])->name('kriteriaannex.tambah');
    Route::put('kriteriaannex/update/{id}/{item}', [KriteriaannexController::class, 'update'])->name('kriteriaannex.update');
    Route::get('kategorise', [KategoriseController::class, 'tampil'])->name('kategorise.tampil');
    //Route::post('kategorise/tambah', [KategoriseController::class, 'tambah'])->name('kategorise.tambah');
    Route::put('kategorise/update/{id}', [KategoriseController::class, 'update'])->name('kategorise.update');
    //Route::delete('kategorise/hapus/{id}', [KategoriseController::class, 'hapus'])->name('kategorise.hapus');

    Route::get('klasifikasi', [KlasifikasiController::class, 'tampil'])->name('klasifikasi.tampil');
    Route::put('klasifikasi/update/{id}', [KlasifikasiController::class, 'update'])->name('klasifikasi.update');
    //Route::delete('itemklasifikasi/hapus/{id}/{domain}', [ItemklasifikasiController::class, 'hapus'])->name('itemklasifikasi.hapus');
    Route::get('itemklasifikasi/{id}', [ItemklasifikasiController::class, 'tampil'])->name('itemklasifikasi.tampil');
    //Route::post('itemklasifikasi/tambah', [ItemklasifikasiController::class, 'tambah'])->name('itemklasifikasi.tambah');
    Route::put('itemklasifikasi/update/{id}/{domain}', [ItemklasifikasiController::class, 'update'])->name('itemklasifikasi.update');
    Route::get('dampakvital', [DampakvitalController::class, 'tampil'])->name('dampakvital.tampil');
    Route::put('dampakvital/update/{id}', [DampakvitalController::class, 'update'])->name('dampakvital.update');
    Route::get('itemdampakvital/{id}', [ItemDampakvitalController::class, 'tampil'])->name('itemdampakvital.tampil');
    Route::put('itemdampakvital/update/{id}/{domain}', [ItemDampakvitalController::class, 'update'])->name('itemdampakvital.update');




});

Route::middleware('auth','html.purifier','verified','no.cache','role:admin|persandian')->group(function () {

    Route::get('aset', [AsetController::class, 'tampil'])->name('aset.tampil');
    Route::delete('aset/hapus/{id}', [AsetController::class, 'hapus'])->name('aset.hapus');
    Route::post('aset/tambah', [AsetController::class, 'tambah'])->name('aset.tambah');
    Route::put('aset/update/{id}', [AsetController::class, 'update'])->name('aset.update');
    Route::get('aset/pdf/{id}', [AsetController::class, 'pdf'])->name('aset.pdf');
    Route::get('aset/csv/{id}', [AsetController::class, 'csv'])->name('aset.csv');

    Route::get('asetr', [AsetrController::class, 'tampil'])->name('asetr.tampil');

    Route::get('asetkategori/{id}', [AsetkategoriController::class, 'tampil'])->name('asetkategori.tampil');
    Route::get('asetkategori/edit/{id}', [AsetkategoriController::class, 'edit'])->name('asetkategori.edit');
    Route::put('asetkategori/update', [AsetkategoriController::class, 'update'])->name('asetkategori.update');
    Route::get('asetkategori/pdf/{id}', [AsetkategoriController::class, 'pdf'])->name('asetkategori.pdf');

    Route::get('asetinheren/{id}', [AsetinherenController::class, 'tampil'])->name('asetinheren.tampil');
    Route::put('asetinheren/update/{id}', [AsetinherenController::class, 'update'])->name('asetinheren.update');
    Route::get('impact-data/{id}', [AsetinherenController::class, 'getInherenImpactData'])->name('inherenimpact.data');
    Route::put('asetinheren/updatedampak', [AsetinherenController::class, 'updatedampak'])->name('asetinheren.updatedampak');
    Route::get('asetinheren/pdf/{id}', [AsetinherenController::class, 'pdf'])->name('asetinheren.pdf');


    Route::get('asetklasifikasi/{id}', [AsetklasifikasiController::class, 'tampil'])->name('asetklasifikasi.tampil');
    Route::get('asetklasifikasi/edit/{id}', [AsetklasifikasiController::class, 'edit'])->name('asetklasifikasi.edit');
    Route::put('asetklasifikasi/update', [AsetklasifikasiController::class, 'update'])->name('asetklasifikasi.update');
    // Route::put('asetklasifikasi/update/{id}/{domain}', [AsetklasifikasiController::class, 'update'])->name('asetklasifikasi.update');
    Route::get('asetklasifikasi/pdf/{id}', [AsetklasifikasiController::class, 'pdf'])->name('asetklasifikasi.pdf');

    Route::get('asetdampakvital/{id}', [AsetdampakvitalController::class, 'tampil'])->name('asetdampakvital.tampil');
    Route::get('asetdampakvital/edit/{id}', [AsetdampakvitalController::class, 'edit'])->name('asetdampakvital.edit');
    Route::put('asetdampakvital/update', [AsetdampakvitalController::class, 'update'])->name('asetdampakvital.update');
    // Route::put('asetdampakvital/update/{id}/{domain}', [AsetdampakvitalController::class, 'update'])->name('asetdampakvital.update');
    Route::get('asetdampakvital/pdf/{id}', [AsetdampakvitalController::class, 'pdf'])->name('asetdampakvital.pdf');


    Route::put('user/pupdate/{id}', [userController::class, 'pupdate'])->name('userp.update');

    Route::get('/bup-db', [BackupdbController::class, 'backup'])->name('bup-db');




});



// Route::get('admin',function(){
//      return '<h1>ADMIN !</h1';
//  })->middleware((['auth','verified','role:admin']));

// Route::get('persandian',function(){
//     return '<h1>PERSANDIAN</h1';
// })->middleware((['auth','verified','role:persandian|admin']));

// Route::get('opd',function(){
//     return '<h1>OPD</h1';
// })->middleware((['auth','verified','role:opd|persandian|admin']));

//  Route::get('user',function(){
//      return view('user');
//  })->middleware((['auth','verified','role:admin']));


require __DIR__.'/auth.php';
