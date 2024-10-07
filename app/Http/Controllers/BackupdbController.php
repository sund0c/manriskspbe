<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class BackupdbController extends Controller
{
    public function backup()
    {
        // Lakukan backup database menggunakan perintah artisan
        try {
            Artisan::call('backup:run', [
                '--only-db' => true, // Hanya backup database, tidak termasuk file
                '--disable-notifications' => true, // Menonaktifkan pemberitahuan
            ]);

            return redirect()->back()->with('success', 'Database berhasil dibackup.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan backup database: ' . $e->getMessage());
        }
    }
}
