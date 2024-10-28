<?php
use App\Http\Controllers\BackupdbController;
use App\Http\Controllers\LayananspbeController;
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



    Route::get('asetkategori/{id}', [AsetkategoriController::class, 'tampil'])->name('asetkategori.tampil');
    Route::get('asetkategori/edit/{id}', [AsetkategoriController::class, 'edit'])->name('asetkategori.edit');
    Route::put('asetkategori/update', [AsetkategoriController::class, 'update'])->name('asetkategori.update');
    Route::get('asetkategori/pdf/{id}', [AsetkategoriController::class, 'pdf'])->name('asetkategori.pdf');

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
