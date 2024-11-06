<?php

namespace App\Http\Controllers;

use App\Models\Mitigasirisiko;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomExport;

class MitigasirisikoController extends Controller
{
    public function tampil($idinherent,$idaset,$kerawanan){
        // Mendefinisikan jenis berdasarkan id
        $jenisList = [
            1 => 'APLIKASI',
            2 => 'INFRASTRUKTUR',
            3 => 'SDM',
            4 => 'DATA/INFORMASI'
        ];
        //$jenisid=$idaset;
        $jenis = $jenisList[$idaset] ?? null;
        if (!$jenis) {
            return redirect()->back()->with('error', 'Jenis tidak ditemukan.');
        }
        //dd($jenisaset);
         $mitigasirisiko = Mitigasirisiko::where('inherentrisiko', $idinherent)->orderBy('mitigasi', 'ASC')->get();
         return view('mitigasirisiko', compact('mitigasirisiko', 'idinherent','idaset','jenis','kerawanan'));
    }

    // public function csv($id){
    //     if ($id == 1) { //APLIKASI
    //         $mitigasirisiko = Mitigasirisiko::where('jenis', 'APLIKASI')
    //         ->orderBy('kerawanan', 'ASC')
    //         ->select('kerawanan')
    //         ->get()
    //         ->toArray();
    //     } elseif ($id == 2) { //INFRA
    //         $mitigasirisiko = Mitigasirisiko::where('jenis', 'INFRASTRUKTUR')
    //         ->orderBy('kerawanan', 'ASC')
    //         ->select('kerawanan')
    //         ->get()
    //         ->toArray();
    //     } elseif ($id == 3) { //SDM
    //         $mitigasirisiko = Mitigasirisiko::where('jenis', 'SDM')
    //         ->orderBy('kerawanan', 'ASC')
    //         ->select('kerawanan')
    //         ->get()
    //         ->toArray();
    //     } elseif ($id == 4) { //INFRA
    //         $mitigasirisiko = Mitigasirisiko::where('jenis', 'DATA/INFORMASI')
    //         ->orderBy('kerawanan', 'DATA/INFORMASI')
    //         ->select('kerawanan')
    //         ->get()
    //         ->toArray();
    //     } else {
    //         $mitigasirisiko = [];
    //     }

    //     // Tambahkan nomor urut
    //     foreach ($mitigasirisiko as $index => $item) {
    //         $mitigasirisiko[$index] = array_merge(['Nomor' => $index + 1], $item);
    //     }

    //     // Tambahkan heading "Nomor" di paling kiri
    //     $headings = ['Nomor', 'Jenis Kerawanan'];
    //     return Excel::download(new CustomExport($mitigasirisiko, $headings), 'itemmitigasirisiko.csv');
    // }

    public function hapus($id,$idinherent,$idaset,$kerawanan){
    try {
            $mitigasirisiko = Mitigasirisiko::findOrFail($id);
            $mitigasirisiko->delete();
            return redirect()->route('mitigasirisiko.tampil',[$idinherent, $idaset, $kerawanan])->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('mitigasirisiko.tampil',[$idinherent, $idaset, $kerawanan])->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('mitigasirisiko.tampil',[$idinherent, $idaset, $kerawanan])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambah(Request $request){
        try {
            $validatedData = $request->validate(
                [
                'mitigasi' => ['required'],
                'idinherent' => ['required'],
                'idaset' => ['required'],
                ],
                [
                'mitigasi.required' => 'Mitigasi risiko : tidak boleh kosong',
                'idinherent.required' => 'Id Inherit Risiko : tidak boleh kosong',
                'idaset.required' => 'Id aset : tidak boleh kosong',
                ]
                );
                $mitigasirisiko = new Mitigasirisiko();
                $mitigasirisiko->mitigasi = $request->mitigasi;
                $mitigasirisiko->inherentrisiko = $request->idinherent;
                $mitigasirisiko->save();
                return redirect()->route('mitigasirisiko.tampil',[$request->idinherent, $request->idaset, $request->kerawanan])->with('success', 'Data baru berhasil disimpan!');
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
            return redirect()->route('mitigasirisiko.tampil',[$request->idinherent, $request->idaset, $request->kerawanan])->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('mitigasirisiko.tampil',[$request->idinherent, $request->idaset, $request->kerawanan])->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('mitigasirisiko.tampil',[$request->idinherent, $request->idaset, $request->kerawanan])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate(
                [
                    'mitigasi' => ['required'],
                    'idinherent' => ['required'],
                    'idaset' => ['required'],
                ],
                [
                    'mitigasi.required' => 'Mitigasi risiko : tidak boleh kosong',
                    'idinherent.required' => 'Id Inherit Risiko : tidak boleh kosong',
                    'idaset.required' => 'Id aset : tidak boleh kosong',
                ]
            );
            $mitigasirisiko = Mitigasirisiko::findOrFail($id);
            $mitigasirisiko->mitigasi = $request->mitigasi;
            $mitigasirisiko->update();
            return redirect()->route('mitigasirisiko.tampil',[$request->idinherent, $request->idaset, $request->kerawanan])->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('mitigasirisiko.tampil',[$request->idinherent, $request->idaset, $request->kerawanan])->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('mitigasirisiko.tampil',[$request->idinherent, $request->idaset, $request->kerawanan])->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('mitigasirisiko.tampil',[$request->idinherent, $request->idaset, $request->kerawanan])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
