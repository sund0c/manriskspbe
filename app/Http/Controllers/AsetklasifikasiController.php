<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Asetklasifikasi;
use App\Models\Itemklasifikasi;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;


class AsetklasifikasiController extends Controller
{
    public function tampil($id){
        $idaset = Aset::where('id', $id)->get();
        if (!is_null($idaset->first()) && $idaset->first()->jenis=='APLIKASI') {

        // $asetklasifikasis = Asetklasifikasi::where('aset', $id)
        //                    ->with('asetRelation')
        //                    ->get();

        $asetklasifikasis = Asetklasifikasi::where('aset', $id)
        ->with('klasifikasiRelation')
        ->join('itemklasifikasis', 'asetklasifikasis.tanya', '=', 'itemklasifikasis.id') // Join ke tabel kategorises
        ->orderBy('itemklasifikasis.urut', 'ASC') // Urutkan berdasarkan field urut
        ->select('asetklasifikasis.*') // Pilih kolom dari asetkategori
        ->get();


        if ($asetklasifikasis->isEmpty() && $idaset->first()->jenis=='APLIKASI') {
            $itemklasifikasi = Itemklasifikasi::all();
            //dd($itemklasifikasi);
            foreach ($itemklasifikasi as $item) {
                //print_r($item->id);
                Asetklasifikasi::create([
                    'aset' => $id,
                    'tanya' => $item->id,
                    'jawab' => 4,
                    'keterangan' => '-',
                ]);
            }
        // $asetklasifikasis = Asetklasifikasi::where('aset', $id)
        //                 ->with('asetRelation')
        //                 ->get();

        $asetklasifikasis = Asetklasifikasi::where('aset', $id)
        ->with('klasifikasiRelation')
        ->join('itemklasifikasis', 'asetklasifikasis.tanya', '=', 'itemklasifikasis.id') // Join ke tabel kategorises
        ->orderBy('itemklasifikasis.urut', 'ASC') // Urutkan berdasarkan field urut
        ->select('asetklasifikasis.*') // Pilih kolom dari asetkategori
        ->get();
        }

        $klasifikasi = Klasifikasi::all();
        $idaset = Aset::where('id', $id)->get();
        return view('asetklasifikasi', compact('asetklasifikasis','klasifikasi','idaset'));
        } else {
            abort(404);
        }
    }

    public function edit($id){
        $idaset = Aset::where('id', $id)->get();
        if (!is_null($idaset->first()) && $idaset->first()->jenis=='APLIKASI') {

        $asetklasifikasis = Asetklasifikasi::where('aset', $id)
                           ->with('asetRelation')
                           ->get();
        $klasifikasi = Klasifikasi::all();
        $idaset = Aset::where('id', $id)->get();
        return view('asetklasifikasiedit', compact('asetklasifikasis','klasifikasi','idaset'));
        } else {
            return back();
        }
    }

    public function pdf($id){
        // $asetklasifikasis = Asetklasifikasi::where('aset', $id)
        //                    ->with('asetRelation')
        //                    ->get();
        $asetklasifikasis = Asetklasifikasi::where('aset', $id)
        ->with('klasifikasiRelation')
        ->join('itemklasifikasis', 'asetklasifikasis.tanya', '=', 'itemklasifikasis.id') // Join ke tabel kategorises
        ->orderBy('itemklasifikasis.urut', 'ASC') // Urutkan berdasarkan field urut
        ->select('asetklasifikasis.*') // Pilih kolom dari asetkategori
        ->get();

        $idaset = Aset::where('id', $id)->get();

        $pdf = Pdf::loadView('pdf.asetklasifikasi', ['asetklasifikasis' => $asetklasifikasis,'idaset' => $idaset])
                 ->setPaper('a4', 'landscape');

// Menggunakan Event untuk menambahkan nomor halaman pada footer
$pdf->output();
$dom_pdf = $pdf->getDomPDF();
$canvas = $dom_pdf->getCanvas();
$canvas->page_text(650, 550, "Hal {PAGE_NUM} dari {PAGE_COUNT} | TLP : AMBER+STRICT", null, 10, array(0,0,0));

        $namaFile = preg_replace('/[^A-Za-z0-9]/', '', strtolower($idaset->first()->nama));
        $namaFile = substr($namaFile, 0, 10); // Mengambil 10 karakter pertama dari nama yang sudah dibersihkan
        $tanggalSekarang = now()->format('dmyhms'); // Format tanggal: dd-mm-yyyy
        $namaFilePDF = $namaFile .'_'. $tanggalSekarang . '_klasifikasi.pdf';
        return $pdf->download($namaFilePDF);

    }

        public function update(Request $request){
            try {
                $validatedData = $request->validate(
                    [
                    'aset' => ['required'],'jawab.*' => ['required'],'keterangan.*' => ['required'],'id.*' => ['required'],
                    ],
                    [
                    'id.required' => 'tidak boleh kosong',
                    'aset.required' => 'tidak boleh kosong',
                    'jawab.*.required' => 'tidak boleh kosong',
                    'keterangan.*.required' => 'tidak boleh kosong',
                    ]
                    );
                    foreach ($request->id as $key => $id) {
                        // Mencari item berdasarkan ID
                        $item = Asetklasifikasi::findOrFail($id);
                        $item->jawab = $request->jawab[$key];
                        $item->keterangan = $request->keterangan[$key];
                        $item->save();
                    }
                // Count the records where 'jawab' is 4
                $countR = Asetklasifikasi::where('aset', $item->aset)
                ->where('jawab', 4)
                ->count();

                // Count the records where 'jawab' is 3
                $countY = Asetklasifikasi::where('aset', $item->aset)
                ->where('jawab', 3)
                ->count();

                if ($countR >0) {
                    $klasifikasi = 'RAHASIA';
                } elseif ($countR <=0 && $countY >0) {
                    $klasifikasi = 'TERBATAS/INTERNAL';
                } else {
                    $klasifikasi = 'PUBLIK';
                }
                $aset = Aset::findOrFail($item->aset);
                $aset->klasifikasi = strip_tags($klasifikasi);
                $aset->update();
                return redirect()->route('asetklasifikasi.tampil',$request->aset)->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('asetklasifikasi.tampil',$request->aset)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('asetklasifikasi.tampil',$request->aset)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('asetklasifikasi.tampil',$request->aset)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
}
