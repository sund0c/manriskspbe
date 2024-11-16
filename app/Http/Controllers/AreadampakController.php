<?php

namespace App\Http\Controllers;

use App\Models\areadampak;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class AreadampakController extends Controller
{
    public function tampil(){
        $areadampak = Areadampak::get();
        return view('areadampak',compact('areadampak'));
    }

    public function hapus($id){
    try {
            $opd = Areadampak::findOrFail($id);
            $opd->delete();
            return redirect()->route('areadampak.tampil')->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('areadampak.tampil')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('areadampak.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate(
                [
                    'area' => ['required'],
                    'uraian' => ['required'],
                    'insignificant' => ['required'],
                    'low' => ['required'],
                    'medium' => ['required'],
                    'high' => ['required'],
                    'critical' => ['required'],
                    ],
                    [
                    'area.required' => 'tidak boleh kosong',
                    'uraian.required' => 'tidak boleh kosong',
                    'insignificant.required' => 'tidak boleh kosong',
                    'low.required' => 'tidak boleh kosong',
                    'medium.required' => 'tidak boleh kosong',
                    'high.required' => 'tidak boleh kosong',
                    'critical.required' => 'tidak boleh kosong',                                
                    ]
                );
            $opd = Areadampak::findOrFail($id);
            $opd->area = strtoupper($request->area);
            $opd->uraian = $request->uraian;
            $opd->insignificant = $request->insignificant;
            $opd->low = $request->low;
            $opd->medium = $request->medium;
            $opd->high = $request->high;
            $opd->critical = $request->critical;
            $opd->update();
            return redirect()->route('areadampak.tampil')->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('areadampak.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('areadampak.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('areadampak.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pdf(){
        $areadampak = Areadampak::get();
        $pdf = Pdf::loadView('pdf.areadampak', ['areadampak' => $areadampak])
                 ->setPaper('a4', 'landscape');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->getCanvas();
        $canvas->page_text(650, 550, "Hal {PAGE_NUM} dari {PAGE_COUNT} | TLP : AMBER+STRICT", null, 10, array(0,0,0));
        $tanggalSekarang = now()->format('dmyhms'); // Format tanggal: dd-mm-yyyy
        $namaFilePDF = 'areadampak_'. $tanggalSekarang . '.pdf';
        return $pdf->download($namaFilePDF);
    }

}
