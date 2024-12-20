<?php

namespace App\Http\Controllers;
use App\Models\Aset;
use App\Models\Layananspbe;
use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomExport;


class AsetController extends Controller
{
    public function tampil(){
//        $aset = Aset::with(['layananRelation','opdRelation'])->get();
        $aset = Aset::with(['layananRelation', 'opdRelation'])
            ->orderBy('skorkategori', 'DESC')
            ->orderBy('user', 'ASC')
            ->get();

        $asetk = Aset::with(['layananRelation', 'opdRelation'])
            ->orderBy('skorklasifikasi', 'DESC')
            ->orderBy('user', 'ASC')
            ->get();

        $layananspbe = Layananspbe::orderBy('jenis', 'ASC')->orderBy('nama', 'ASC')->get();
        // $users = User::with(['roles', 'opdRelation'])->get();
        $users = Opd::all();
        return view('aset',compact('aset','asetk','users','layananspbe'));
    }


    public function csv($id){
        if ($id == 1) { //kategori
            $j='kategori';
            $aset = Aset::with(['layananRelation', 'opdRelation'])
            ->orderBy('skorkategori', 'DESC')
            ->orderBy('user', 'ASC')
            ->get();
        } elseif ($id == 2) { //klasifikasi
            $j='klasifikasi';
            $aset = Aset::with(['layananRelation', 'opdRelation'])
            ->orderBy('user', 'ASC')
            ->orderBy('jenis', 'DESC')
            ->get();
        }else{
                $aset = Aset::with(['layananRelation', 'opdRelation'])
                ->select('jenis','nama','url','user')
                ->orderBy('user', 'ASC')
                ->orderBy('jenis', 'DESC')
                ->get()
                ->map(function($item) {
                    return [
                        'jenis' => $item->jenis,
                        'nama' => $item->nama,
                        'url' => $item->url,
                        'singkatan' => $item->opdRelation ? $item->opdRelation->singkatan : '',
                    ];
                });

        }
        $headings = ['Jenis', 'Aset', 'URL', 'OPD'];
        return Excel::download(new CustomExport($aset, $headings), 'aset.csv');
    }

    public function pdf($id){
        //$idaset = Aset::where('id', $id)->with('layananRelation')->get();
        if ($id == 1) {
            $j='kategori';
            $aset = Aset::with(['layananRelation', 'opdRelation'])
            ->orderBy('skorkategori', 'DESC')
            ->orderBy('user', 'ASC')
            ->get();
        } elseif ($id == 2) {
            $j='klasifikasi';
            $aset = Aset::with(['layananRelation', 'opdRelation'])
            ->orderBy('skorklasifikasi', 'DESC')
            ->orderBy('user', 'ASC')
            ->get();
        } elseif ($id == 3) {
            $j='dampakvital';
            $aset = Aset::with(['layananRelation', 'opdRelation'])
            ->orderBy('skorvital', 'DESC')
            ->orderBy('user', 'ASC')
            ->get();
        }
        $pdf = Pdf::loadView('pdf.aset', ['aset' => $aset,'id'=>$id])
                 ->setPaper('a4', 'landscape');
   // Menggunakan Event untuk menambahkan nomor halaman pada footer
   $pdf->output();
   $dom_pdf = $pdf->getDomPDF();
   $canvas = $dom_pdf->getCanvas();
   $canvas->page_text(650, 550, "Hal {PAGE_NUM} dari {PAGE_COUNT} | TLP : AMBER", null, 10, array(0,0,0));
        $tanggalSekarang = now()->format('dmyhms'); // Format tanggal: dd-mm-yyyy
        $namaFilePDF = $j.'_'. $tanggalSekarang . '.pdf';
        return $pdf->download($namaFilePDF);
    }

    public function hapus($id){
    try {
            $aset = Aset::findOrFail($id);
            $aset->delete();
            return redirect()->route('aset.tampil')->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('aset.tampil')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('aset.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambah(Request $request){
        try {
            $validatedData = $request->validate(
                [
                'nama' => ['required'],
                'jenis' => ['required'],
                'user' => ['required'],
                'ip' => ['nullable', 'ip'],
                'url' => ['nullable', 'regex:/^[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\/[^\s]*)?$/'],
            ],
                [
                'nama.required' => 'Nama: tidak boleh kosong',
                'jenis.required' => 'tidak boleh kosong',
                'user.required' => 'tidak boleh kosong',
                'ip.ip' => 'IP: tidak valid',
                'url.regex' => 'URL: tidak valid',
                ]
                );
            $aset = new Aset();
            $aset->jenis = $request->jenis;
            // Memeriksa apakah jenisnya bukan APLIKASI atau INFRASTRUKTUR
            if ($aset->jenis !== 'APLIKASI' && $aset->jenis !== 'INFRASTRUKTUR') {
                $aset->url = ''; // Mengosongkan URL
                $aset->ip = '';  // Mengosongkan IP
                $aset->skorkategori = 0;
                $aset->skorklasifikasi = 1;
            } else {
                // Jika jenisnya APLIKASI atau INFRASTRUKTUR, atur URL dan IP sesuai input atau default '-'
                $aset->url = strtolower($request->url) ?: '';
                $aset->ip = $request->ip ?: '';
                $aset->skorkategori = 50;
                $aset->skorklasifikasi = 5;
            }
            $aset->user = $request->user;
            $aset->keterangan = $request->penjelasan;
            $aset->layanan = $request->layanan;
            $aset->nama = $request->nama;
            $aset->save();
            return redirect()->route('aset.tampil')->with('success', 'Data baru berhasil disimpan!');
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessages = "<p style='text-align: left;'>";
            foreach ($errors as $field => $messages) {
                //$errorMessages .= "Field ".ucfirst($field) . ": ";
                foreach ($messages as $message) {
                    $errorMessages .= "$message";
                }
                $errorMessages .= "<br>";
            }
            $errorMessages .= "</p>";
            //dd($errorMessages);
            return redirect()->route('aset.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('aset.tampil')->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('aset.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate(
                [
                'nama' => ['required'],
                'jenis' => ['required'],
                'user' => ['required'],
                'ip' => ['nullable', 'ip'],
                'url' => ['nullable', 'regex:/^[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\/[^\s]*)?$/'],
            ],
                [
                'nama.required' => 'Nama: tidak boleh kosong',
                'jenis.required' => 'tidak boleh kosong',
                'user.required' => 'tidak boleh kosong',
                'ip.ip' => 'IP: tidak valid',
                'url.regex' => 'URL: tidak valid',
                ]
                );
            $aset = Aset::findOrFail($id);
            $aset->jenis = $request->jenis;
            // Memeriksa apakah jenisnya bukan APLIKASI atau INFRASTRUKTUR
            if ($aset->jenis !== 'APLIKASI' && $aset->jenis !== 'INFRASTRUKTUR') {
                $aset->url = ''; // Mengosongkan URL
                $aset->ip = '';  // Mengosongkan IP
            } else {
                // Jika jenisnya APLIKASI atau INFRASTRUKTUR, atur URL dan IP sesuai input atau default '-'
                $aset->url = strtolower($request->url) ?: '';
                $aset->ip = $request->ip ?: '';
            }
            $aset->keterangan = $request->penjelasan;
            $aset->layanan = $request->layanan;
            $aset->user = $request->user;
            $aset->nama = $request->nama;
            $aset->update();
            return redirect()->route('aset.tampil')->with('success', 'Data berhasil diperbarui!');
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessages = "<p style='text-align: left;'>";
            foreach ($errors as $field => $messages) {
                //$errorMessages .= "Field ".ucfirst($field) . ": ";
                foreach ($messages as $message) {
                    $errorMessages .= "$message";
                }
                $errorMessages .= "<br>";
            }
            $errorMessages .= "</p>";
            return redirect()->route('aset.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('aset.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('aset.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
