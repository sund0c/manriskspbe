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

        $asetklasifikasis = Asetklasifikasi::where('aset', $id)
                           ->with('asetRelation')
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
        $asetklasifikasis = Asetklasifikasi::where('aset', $id)
                        ->with('asetRelation')
                        ->get();
        }

        $klasifikasi = Klasifikasi::all();
        $idaset = Aset::where('id', $id)->get();
        return view('asetklasifikasi', compact('asetklasifikasis','klasifikasi','idaset'));
        } else {
            return back();
        }
    }

    public function pdf($id){
        $asetklasifikasis = Asetklasifikasi::where('aset', $id)
                           ->with('asetRelation')
                           ->get();

        $idaset = Aset::where('id', $id)->get();

        $pdf = Pdf::loadView('pdf.asetklasifikasi', ['asetklasifikasis' => $asetklasifikasis,'idaset' => $idaset])
                 ->setPaper('a4', 'landscape');
        return $pdf->download('klasifikasi.pdf');

    }

        public function update(Request $request,$id){
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
                $item = Asetklasifikasi::findOrFail($id);
                $item->jawab = strip_tags($request->jawab);
                //$item->tanya = strip_tags($request->tanya);
                $item->keterangan = strip_tags($request->keterangan);
                $item->aset = strip_tags($request->aset);
                $item->update();

                // Count the records where 'jawab' is 4
                $countR = Asetklasifikasi::where('aset', $item->aset)
                ->where('jawab', 4)
                ->count();

                // Count the records where 'jawab' is 3
                $countY = Asetklasifikasi::where('aset', $item->aset)
                ->where('jawab', 3)
                ->count();

                if ($countR >0) {
                    $kategori = 'RAHASIA';
                } elseif ($countR <=0 && $countY >0) {
                    $kategori = 'TINGGI';
                } else {
                    $kategori = 'TERBATAS/INTERNAL';
                }
                $aset = Aset::findOrFail($item->aset);
                $aset->klasifikasi = strip_tags($kategori);
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
                return redirect()->route('asetkategori.tampil',$request->domain)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('asetkategori.tampil',$request->domain)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('asetkategori.tampil',$request->domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
}
