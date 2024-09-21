<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RiskregisterController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','verified','role:admin')->group(function () {
    Route::get('user', [UserController::class, 'tampil'])->name('user.tampil');
    Route::delete('user/hapus/{id}', [userController::class, 'hapus'])->name('user.hapus');
    Route::post('user/tambah', [userController::class, 'tambah'])->name('user.tambah');
    Route::put('user/update/{id}', [userController::class, 'update'])->name('user.update');
    Route::get('opd', [OpdController::class, 'tampil'])->name('opd.tampil');
    Route::delete('opd/hapus/{id}', [OpdController::class, 'hapus'])->name('opd.hapus');
    Route::post('opd/tambah', [OpdController::class, 'tambah'])->name('opd.tambah');
    Route::put('opd/update/{id}', [OpdController::class, 'update'])->name('opd.update');




    Route::get('riskregister', [RiskregisterController::class, 'index'])->name('riskregister.index');


});

Route::middleware('auth','verified','role:admin|opd')->group(function () {
    Route::get('riskregister', [RiskregisterController::class, 'index'])->name('riskregister.index');
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
