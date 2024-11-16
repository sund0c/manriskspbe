<?php

namespace App\Http\Controllers;

use App\Models\kriteriakemungkinan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class KriteriakemungkinanController extends Controller
{
    public function tampil(){
        $kriteriakemungkinan = Kriteriakemungkinan::get();
        return view('kriteriakemungkinan',compact('kriteriakemungkinan'));
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate(
                [
                    'rare' => ['required'],
                    'unlikely' => ['required'],
                    'possible' => ['required'],
                    'likely' => ['required'],
                    'almost' => ['required'],
                    ],
                    [
                    'rare.required' => 'tidak boleh kosong',
                    'unlikely.required' => 'tidak boleh kosong',
                    'possible.required' => 'tidak boleh kosong',
                    'likely.required' => 'tidak boleh kosong',
                    'almost.required' => 'tidak boleh kosong',                         
                    ]
                );
            $opd = Kriteriakemungkinan::findOrFail($id);
            $opd->rare = $request->rare;
            $opd->unlikely = $request->unlikely;
            $opd->possible = $request->possible;
            $opd->likely = $request->likely;
            $opd->almost = $request->almost;         
            $opd->update();
            return redirect()->route('kriteriakemungkinan.tampil')->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('kriteriakemungkinan.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('kriteriakemungkinan.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('kriteriakemungkinan.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pdf(){
        $kriteriakemungkinan = Kriteriakemungkinan::get();
        $pdf = Pdf::loadView('pdf.kriteriakemungkinan', ['kriteriakemungkinan' => $kriteriakemungkinan])
                 ->setPaper('a4', 'landscape');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->getCanvas();
        $canvas->page_text(650, 550, "Hal {PAGE_NUM} dari {PAGE_COUNT} | TLP : AMBER+STRICT", null, 10, array(0,0,0));
        $tanggalSekarang = now()->format('dmyhms'); // Format tanggal: dd-mm-yyyy
        $namaFilePDF = 'kriteriadampak_'. $tanggalSekarang . '.pdf';
        return $pdf->download($namaFilePDF);
    }

}
