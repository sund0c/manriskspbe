<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Asetinheren;
use App\Models\Inherentrisiko;
use App\Models\Kriteriakemungkinan;
use App\Models\Areadampak;
use App\Models\Inherenimpact;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;


class AsetinherenController extends Controller
{
    public function tampil($id){
        $idaset = Aset::where('id', $id)->with('layananRelation')->get();
        
        if (!is_null($idaset->first())) {
            
            $asetinherens = Asetinheren::where('aset', $id)
                ->with('inherentRelation')
                ->join('inherentrisikos', 'asetinherens.inheren', '=', 'inherentrisikos.id')
                //->orderBy('a.urut', 'ASC')
                ->select('asetinherens.*','inherentrisikos.kerawanan','inherentrisikos.ancaman')
                ->get();
            //dd($asetinherens);
                          
        if ($asetinherens->isEmpty()) {
            $asetinherenss = Inherentrisiko::where('jenis', $idaset->first()->jenis)->get();
            $areadampakss = Areadampak::all();
              //dd($areadampakss);
            foreach ($asetinherenss as $asetinheren) {
                //dd($asetinheren->id);
                $newAsetinheren = Asetinheren::create([
                    'aset' => $id,
                    'inheren' => $asetinheren->id,
                    'nilaidampak' => 5,
                    'nilaikemungkinan' => 5,
                ]);
                //truncate `inherenimpacts`; truncate asetinherens;
                foreach ($areadampakss as $areadampak) {
                    $newInhenimpact =Inherenimpact::create([
                        'inheren' => $newAsetinheren->id,
                        'impact' => $areadampak->id,
                        'nilaiimpact' => 5,
                    ]);
                    
                }
            }
           // dd($newInhenimpact);
            $asetinherens = Asetinheren::where('aset', $id)
            ->with('inherentRelation')
            ->join('inherentrisikos', 'asetinherens.inheren', '=', 'inherentrisikos.id')
            //->orderBy('a.urut', 'ASC')
            ->select('asetinherens.*','inherentrisikos.kerawanan','inherentrisikos.ancaman')
            ->get();
            
        }

        $inherens = Inherentrisiko::where('jenis', $idaset->first()->jenis);
        $mungkin = Kriteriakemungkinan::all();
        $idaset = Aset::where('id', $id)->with('layananRelation')->get();
        return view('asetinheren', compact('asetinherens','inherens','idaset','mungkin'));
        } else {
            abort(404);
        }
    }

    public function getInherenImpactData($id)
    {
        $data = Inherenimpact::where('inheren', $id)->get(); // Ambil semua data terkait ID
       
    if ($data->isEmpty()) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    
        // Struktur respons dengan koleksi data
        $response = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'inheren' => $item->inheren,
                'area' => $item->impactRelation->area,
                'impact' => $item->impact,
                'nilaiimpact' => $item->nilaiimpact,
                'n1' => $item->impactRelation->insignificant,
                'n2' => $item->impactRelation->low,
                'n3' => $item->impactRelation->medium,
                'n4' => $item->impactRelation->high,
                'n5' => $item->impactRelation->critical,
            ];
        });
        return response()->json($response); 
    }
    
    


    // public function edit($id){
    //     $idaset = Aset::where('id', $id)->get();
    //     if (!is_null($idaset->first()) && $idaset->first()->jenis=='APLIKASI') {

    //     $asetkategoris = Asetkategori::where('aset', $id)
    //                        ->with('asetRelation')
    //                        ->get();
    //     $kategorise = Kategorise::all();
    //     $idaset = Aset::where('id', $id)->get();
    //     return view('asetkategoriedit', compact('asetkategoris','kategorise','idaset'));
    //     } else {
    //         return back();
    //     }
    // }

    public function pdf($id){
        
        $idaset = Aset::where('id', $id)->with('layananRelation')->get();
        $asetinherens = Asetinheren::where('aset', $id)
                ->with('inherentRelation')
                ->get();
        $kriteriakemungkinan = Kriteriakemungkinan::all();
        $pdf = Pdf::loadView('pdf.asetinheren', ['idaset' => $idaset,'asetinherens' => $asetinherens,'kriteriakemungkinan' => $kriteriakemungkinan])
                 ->setPaper('a4', 'landscape');

   // Menggunakan Event untuk menambahkan nomor halaman pada footer
   $pdf->output();
   $dom_pdf = $pdf->getDomPDF();
   $canvas = $dom_pdf->getCanvas();
   $canvas->page_text(650, 550, "Hal {PAGE_NUM} dari {PAGE_COUNT} | TLP : AMBER+STRICT", null, 10, array(0,0,0));




        $namaFile = preg_replace('/[^A-Za-z0-9]/', '', strtolower($idaset->first()->nama));
        $namaFile = substr($namaFile, 0, 10); // Mengambil 10 karakter pertama dari nama yang sudah dibersihkan
        $tanggalSekarang = now()->format('dmyhms'); // Format tanggal: dd-mm-yyyy
        $namaFilePDF = $namaFile .'_'. $tanggalSekarang . '_inherent.pdf';
        return $pdf->download($namaFilePDF);
    }

        public function update(Request $request,$id){
            try {
                $validatedData = $request->validate(
                    [
                    'kemungkinan' => ['required'],                   
                    ],
                    [
                    'kemungkinan.required' => 'tidak boleh kosong',
                    ]
                    );
                    $asetinh = Asetinheren::findOrFail($id);
                    $asetinh->nilaikemungkinan = $request->kemungkinan;
                    $asetinh->update();
                return redirect()->route('asetinheren.tampil',$request->idaset)->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('asetinheren.tampil',$request->idaset)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('asetinheren.tampil',$request->idaset)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('asetinheren.tampil',$request->idaset)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }


        public function updatedampak(Request $request){
            try {
              // Ambil semua input yang dikirimkan dari form, kecuali 'idaset'
              $inherenInputs = $request->except(['idaset', 'inheren']); 
    // Menyimpan total nilai dan jumlah data untuk rata-rata
    $total = 0;
    $count = 0;
            foreach ($inherenInputs as $key => $value) {        
        // Ambil ID item dari nama input
            $itemId = str_replace('inherenInput-', '', $key); // Mengambil ID dari nama input seperti 'inherenInput-41'
        
        // Temukan data terkait berdasarkan item ID
            $item = Inherenimpact::find($itemId);
        
            if ($item) {
                // Update nilaiimpact berdasarkan input yang diterima
                $item->nilaiimpact = $value;  // Update nilaiimpact sesuai dengan nilai dari form
                $item->save();  // Simpan perubahan ke database
                $total += $value;
                $count++;
            }
             }
               // Hitung rata-rata dan bulatkan ke atas
    if ($count > 0) {
        $average = ceil($total / $count);  // Membulatkan rata-rata ke atas
    } else {
        $average = 0; // Jika tidak ada data
    }

    // Simpan rata-rata ke Asetinheren
    $aset = Asetinheren::findOrFail($request->inheren);  // Temukan Asetinheren berdasarkan ID aset
    $aset->nilaidampak = $average;  // Simpan nilai rata-rata
    $aset->save();  // Simpan perubahan
//dd($aset);

                return redirect()->route('asetinheren.tampil',$request->idaset)->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('asetinheren.tampil',$request->idaset)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('asetinheren.tampil',$request->idaset)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('asetinheren.tampil',$request->idaset)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }



}
