<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NoCache
{
    public function handle($request, Closure $next)
    {
        // Jika pengguna tidak terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login'); // Ganti dengan rute login Anda
        }

        // Menonaktifkan cache
        $response = $next($request);
        $response->headers->add([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0', // Mengatur ke 0 untuk memastikan tidak ada caching
        ]);

        return $response;
    }
}

