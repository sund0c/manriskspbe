<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Asetkategori;
use App\Models\Kategorise;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;


class AsetkategoriController extends Controller
{
    public function tampil($id){
        $idaset = Aset::where('id', $id)->with('layananRelation')->get();
        if (!is_null($idaset->first()) && $idaset->first()->jenis=='APLIKASI') {

        // $asetkategoris = Asetkategori::where('aset', $id)
        //                    ->with('asetRelation')
        //                    ->get();
        $asetkategoris = Asetkategori::where('aset', $id)
                ->with('kategoriseRelation')
                ->join('kategorises', 'asetkategoris.tanya', '=', 'kategorises.id')
                ->orderBy('kategorises.urut', 'ASC')
                ->select('asetkategoris.*')
                ->get();
        if ($asetkategoris->isEmpty() && $idaset->first()->jenis=='APLIKASI') {
            $kategorise = Kategorise::all();
            foreach ($kategorise as $kategori) {
                Asetkategori::create([
                    'aset' => $id,
                    'tanya' => $kategori->id,
                    'jawab' => 5,
                    'keterangan' => '-',
                ]);
            }
        $asetkategoris = Asetkategori::where('aset', $id)
        ->with('kategoriseRelation') // Memuat relasi ke Kategorise
        ->join('kategorises', 'asetkategoris.tanya', '=', 'kategorises.id') // Join ke tabel kategorises
        ->orderBy('kategorises.urut', 'ASC') // Urutkan berdasarkan field urut
        ->select('asetkategoris.*') // Pilih kolom dari asetkategori
        ->get();
        }

        $kategorise = Kategorise::all();
        $idaset = Aset::where('id', $id)->with('layananRelation')->get();
        return view('asetkategori', compact('asetkategoris','kategorise','idaset'));
        } else {
            abort(404);
        }
    }

    public function edit($id){
        $idaset = Aset::where('id', $id)->get();
        if (!is_null($idaset->first()) && $idaset->first()->jenis=='APLIKASI') {

        $asetkategoris = Asetkategori::where('aset', $id)
                           ->with('asetRelation')
                           ->get();
        $kategorise = Kategorise::all();
        $idaset = Aset::where('id', $id)->get();
        return view('asetkategoriedit', compact('asetkategoris','kategorise','idaset'));
        } else {
            return back();
        }
    }

    public function pdf($id){
        $asetkategoris = Asetkategori::where('aset', $id)
        ->with('kategoriseRelation') // Memuat relasi ke Kategorise
        ->join('kategorises', 'asetkategoris.tanya', '=', 'kategorises.id') // Join ke tabel kategorises
        ->orderBy('kategorises.urut', 'ASC') // Urutkan berdasarkan field urut
        ->select('asetkategoris.*') // Pilih kolom dari asetkategori
        ->get();

        $idaset = Aset::where('id', $id)->with('layananRelation')->get();
        $sumJawab = Asetkategori::where('aset', $id)->sum('jawab');

        $pdf = Pdf::loadView('pdf.asetkategori', ['asetkategoris' => $asetkategoris,'idaset' => $idaset,'sumJawab' => $sumJawab])
                 ->setPaper('a4', 'landscape');
        $namaFile = preg_replace('/[^A-Za-z0-9]/', '', strtolower($idaset->first()->nama));
        $namaFile = substr($namaFile, 0, 10); // Mengambil 10 karakter pertama dari nama yang sudah dibersihkan
        $tanggalSekarang = now()->format('dmyhms'); // Format tanggal: dd-mm-yyyy
        $namaFilePDF = $namaFile .'_'. $tanggalSekarang . '_kategori.pdf';
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
                    $item = Asetkategori::findOrFail($id);
                    $item->jawab = $request->jawab[$key];
                    $item->keterangan = $request->keterangan[$key];
                    $item->save();
                }


                $sumJawab = Asetkategori::where('aset', $item->aset)->sum('jawab');
                //dd($item->aset);
                if ($sumJawab >= 10 && $sumJawab <= 15) {
                    $kategori = 'RENDAH';
                } elseif ($sumJawab >= 16 && $sumJawab <= 34) {
                    $kategori = 'TINGGI';
                } elseif ($sumJawab >= 35 && $sumJawab <= 50) {
                    $kategori = 'STRATEGIS';
                } else {
                    $kategori = 'TIDAK TERDEFINISI';
                }
                $aset = Aset::findOrFail($item->aset);
                $aset->kategorise = $kategori;
                $aset->update();
                return redirect()->route('asetkategori.tampil',$request->aset)->with('success', 'Data berhasil diperbarui!');
            } catch (ValidationException $e) {
                $errors = $e->errors();
                $errorMessages = "<p style='text-align: left;'>";
                foreach ($errors as $field => $messages) {
                    $errorMessages .= "Field ".ucfirst($field) . ": ";
                    foreach ($messages as $message) {
                        $errorMessages .= "$message";
                    }
                    $errorMessages .= "<br>";
                }
                $errorMessages .= "</p>";
                return redirect()->route('asetkategori.tampil',$request->aset)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('asetkategori.tampil',$request->aset)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('asetkategori.tampil',$request->aset)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }



        public function ngupdate(Request $request,$id){
            try {
                $validatedData = $request->validate(
                    [
                    'aset' => ['required'],'jawab' => ['required'],
                    ],
                    [
                    'aset.required' => 'Aset: tidak boleh kosong',
                    'jawab.required' => 'Jawaban: tidak boleh kosong',
                    ]
                    );
                $item = Asetkategori::findOrFail($id);
                $item->jawab = strip_tags($request->jawab);
                //$item->tanya = strip_tags($request->tanya);
                $item->keterangan = strip_tags($request->keterangan);
                $item->aset = strip_tags($request->aset);
                $item->update();
                $sumJawab = Asetkategori::where('aset', $item->aset)->sum('jawab');
                //dd($item->aset);
                if ($sumJawab >= 10 && $sumJawab <= 15) {
                    $kategori = 'RENDAH';
                } elseif ($sumJawab >= 16 && $sumJawab <= 34) {
                    $kategori = 'TINGGI';
                } elseif ($sumJawab >= 35 && $sumJawab <= 50) {
                    $kategori = 'STRATEGIS';
                } else {
                    $kategori = 'TIDAK TERDEFINISI';
                }
                $aset = Aset::findOrFail($item->aset);
                $aset->kategorise = strip_tags($kategori);
                $aset->update();
                return redirect()->route('asetkategori.tampil',$request->aset)->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('asetkategori.tampil',$request->domain)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('asetkategori.tampil',$request->domain)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('asetkategori.tampil',$request->domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }


}
