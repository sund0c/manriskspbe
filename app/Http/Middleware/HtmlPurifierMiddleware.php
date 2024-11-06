<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;
use HTMLPurifier;
use HTMLPurifier_Config;

class HtmlPurifierMiddleware
{
    public function handle($request, Closure $next) {
        // Mengatur konfigurasi HTML Purifier
        $config = HTMLPurifier_Config::createDefault();
        //$config->set('HTML.Allowed', 'p,b,a[href],i,strong');
        $config->set('HTML.Allowed', '');
        $purifier = new HTMLPurifier($config);
        // Daftar field yang ingin dibersihkan
        $fieldsToPurify = ['keterangan', 'jawab',]; // Tambahkan field lain jika perlu

        foreach ($fieldsToPurify as $field) {
            if ($request->has($field)) {
                // Membersihkan setiap item dalam array
                $cleanedValues = [];
                foreach ($request->$field as $key => $value) {
                    $cleanedValues[$key] = $purifier->purify($value);
                }
                // Menggunakan merge untuk memperbarui request
                $request->merge([$field => $cleanedValues]);
            }
        }

                // Field yang bukan array
        $fieldsToPurifySingle = ['jenis', 'url', 'ip', 'nama', 'user','opd_id','singkatan','kriteria','penjelasan','tujuan','item','urut','j1','j2','j3','j4','domain','klasifikasi','kategori','kerawanan','ancaman','aspekrisiko','uraiandampak','mitigasi'];

        foreach ($fieldsToPurifySingle as $field) {
            if ($request->has($field)) {
                // Membersihkan nilai dari field tunggal
                $cleanedValue = $purifier->purify($request->input($field));
                $request->merge([$field => $cleanedValue]);
            }
        }

        return $next($request);
    }
}
