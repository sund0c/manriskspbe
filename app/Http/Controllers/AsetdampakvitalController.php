<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Asetdampakvital;
use App\Models\Itemdampakvital;
use App\Models\Dampakvital;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;


class AsetdampakvitalController extends Controller
{
    public function tampil($id){
        $idaset = Aset::where('id', $id)->get();
        if (!is_null($idaset->first()) && $idaset->first()->jenis=='APLIKASI') {

        $asetdampakvitals = Asetdampakvital::where('aset', $id)
        ->with('dampakvitalRelation')
        ->join('itemdampakvitals', 'asetdampakvitals.tanya', '=', 'itemdampakvitals.id') // Join ke tabel kategorises
        ->orderBy('itemdampakvitals.urut', 'ASC') // Urutkan berdasarkan field urut
        ->select('asetdampakvitals.*') // Pilih kolom dari asetkategori
        ->get();


        if ($asetdampakvitals->isEmpty() && $idaset->first()->jenis=='APLIKASI') {
            $itemdampakvital = Itemdampakvital::all();
            //dd($itemdampakvital);
            foreach ($itemdampakvital as $item) {
                //print_r($item->id);
                Asetdampakvital::create([
                    'aset' => $id,
                    'tanya' => $item->id,
                    'jawab' => 4,
                    'keterangan' => '-',
                ]);
            }
        // $asetdampakvitals = Asetdampakvital::where('aset', $id)
        //                 ->with('asetRelation')
        //                 ->get();

        $asetdampakvitals = Asetdampakvital::where('aset', $id)
        ->with('dampakvitalRelation')
        ->join('itemdampakvitals', 'asetdampakvitals.tanya', '=', 'itemdampakvitals.id') // Join ke tabel kategorises
        ->orderBy('itemdampakvitals.urut', 'ASC') // Urutkan berdasarkan field urut
        ->select('asetdampakvitals.*') // Pilih kolom dari asetkategori
        ->get();
        }

        $dampakvital = Dampakvital::all();
        $idaset = Aset::where('id', $id)->get();
        return view('asetdampakvital', compact('asetdampakvitals','dampakvital','idaset'));
        } else {
            abort(404);
        }
    }

    public function edit($id){
        $idaset = Aset::where('id', $id)->get();
        if (!is_null($idaset->first()) && $idaset->first()->jenis=='APLIKASI') {

        $asetdampakvitals = Asetdampakvital::where('aset', $id)
                           ->with('asetRelation')
                           ->get();
        $dampakvital = Dampakvital::all();
        $idaset = Aset::where('id', $id)->get();
        return view('asetdampakvitaledit', compact('asetdampakvitals','dampakvital','idaset'));
        } else {
            return back();
        }
    }

    public function pdf($id){
        // $asetdampakvitals = Asetdampakvital::where('aset', $id)
        //                    ->with('asetRelation')
        //                    ->get();
        $asetdampakvitals = Asetdampakvital::where('aset', $id)
        ->with('dampakvitalRelation')
        ->join('itemdampakvitals', 'asetdampakvitals.tanya', '=', 'itemdampakvitals.id') // Join ke tabel kategorises
        ->orderBy('itemdampakvitals.urut', 'ASC') // Urutkan berdasarkan field urut
        ->select('asetdampakvitals.*') // Pilih kolom dari asetkategori
        ->get();

        $idaset = Aset::where('id', $id)->get();

        $pdf = Pdf::loadView('pdf.asetdampakvital', ['asetdampakvitals' => $asetdampakvitals,'idaset' => $idaset])
                 ->setPaper('a4', 'landscape');

// Menggunakan Event untuk menambahkan nomor halaman pada footer
$pdf->output();
$dom_pdf = $pdf->getDomPDF();
$canvas = $dom_pdf->getCanvas();
$canvas->page_text(650, 550, "Hal {PAGE_NUM} dari {PAGE_COUNT} | TLP : AMBER+STRICT", null, 10, array(0,0,0));

        $namaFile = preg_replace('/[^A-Za-z0-9]/', '', strtolower($idaset->first()->nama));
        $namaFile = substr($namaFile, 0, 10); // Mengambil 10 karakter pertama dari nama yang sudah dibersihkan
        $tanggalSekarang = now()->format('dmyhms'); // Format tanggal: dd-mm-yyyy
        $namaFilePDF = $namaFile .'_'. $tanggalSekarang . '_vital.pdf';
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
                        $item = Asetdampakvital::findOrFail($id);
                        $item->jawab = $request->jawab[$key];
                        $item->keterangan = $request->keterangan[$key];
                        $item->save();
                    }
                        $maxJawab = Asetdampakvital::where('aset', $item->aset)->max('jawab');
                        if ($maxJawab == 4) {
                            $k = 'SERIUS';
                        } elseif ($maxJawab == 3) {
                            $k = 'SIGNIFIKAN';
                        } elseif ($maxJawab == 2) {
                            $k = 'TERBATAS';
                        } else {
                            $k = 'MINOR';
                        }

                $aset = Aset::findOrFail($item->aset);
                $aset->dampakvital = strip_tags($k);
                $aset->skorvital = $maxJawab;
                $aset->update();
                return redirect()->route('asetdampakvital.tampil',$request->aset)->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('asetdampakvital.tampil',$request->aset)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('asetdampakvital.tampil',$request->aset)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('asetdampakvital.tampil',$request->aset)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
}
