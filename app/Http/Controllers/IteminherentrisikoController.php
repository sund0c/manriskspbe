<?php

namespace App\Http\Controllers;

use App\Models\Inherentrisiko;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomExport;

class IteminherentrisikoController extends Controller
{
    public function tampil($id) {
        // Mendefinisikan jenis berdasarkan id
        $jenisList = [
            1 => 'APLIKASI',
            2 => 'INFRASTRUKTUR',
            3 => 'SDM',
            4 => 'DATA/INFORMASI'
        ];
        $jenisid=$id;
        $jenis = $jenisList[$id] ?? null;
        if (!$jenis) {
            return redirect()->back()->with('error', 'Jenis tidak ditemukan.');
        }
        $inherentrisiko = Inherentrisiko::where('jenis', $jenis)->orderBy('id', 'ASC')->get();
        return view('iteminherentrisiko', compact('inherentrisiko', 'id','jenis','jenisid'));
    }

    public function csv($id){
        if ($id == 1) { //APLIKASI
            $inherentrisiko = Inherentrisiko::where('jenis', 'APLIKASI')
            ->orderBy('kerawanan', 'ASC')
            ->select('kerawanan')
            ->get()
            ->toArray();
        } elseif ($id == 2) { //INFRA
            $inherentrisiko = Inherentrisiko::where('jenis', 'INFRASTRUKTUR')
            ->orderBy('kerawanan', 'ASC')
            ->select('kerawanan')
            ->get()
            ->toArray();
        } elseif ($id == 3) { //SDM
            $inherentrisiko = Inherentrisiko::where('jenis', 'SDM')
            ->orderBy('kerawanan', 'ASC')
            ->select('kerawanan')
            ->get()
            ->toArray();
        } elseif ($id == 4) { //INFRA
            $inherentrisiko = Inherentrisiko::where('jenis', 'DATA/INFORMASI')
            ->orderBy('kerawanan', 'DATA/INFORMASI')
            ->select('kerawanan')
            ->get()
            ->toArray();
        } else {
            $inherentrisiko = [];
        }

        // Tambahkan nomor urut
        foreach ($inherentrisiko as $index => $item) {
            $inherentrisiko[$index] = array_merge(['Nomor' => $index + 1], $item);
        }

        // Tambahkan heading "Nomor" di paling kiri
        $headings = ['Nomor', 'Jenis Kerawanan'];
        return Excel::download(new CustomExport($inherentrisiko, $headings), 'iteminherentrisiko.csv');
    }

    public function hapus($id,$jenisid){
    try {
            $inherentrisiko = Inherentrisiko::findOrFail($id);
            $inherentrisiko->delete();
            return redirect()->route('iteminherentrisiko.tampil',$jenisid)->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('iteminherentrisiko.tampil',$jenisid)->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('iteminherentrisiko.tampil',$jenisid)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambah(Request $request){
        try {
            $validatedData = $request->validate(
                [
                'kerawanan' => ['required'],'ancaman' => ['required'],'aspekrisiko' => ['required'],'uraiandampak' => ['required'],
                ],
                [
                'kerawanan.required' => 'Kerawanan : tidak boleh kosong',
                'ancaman.required' => 'Ancaman : tidak boleh kosong',
                'aspekrisiko.required' => 'Aspek Risiko : tidak boleh kosong',
                'uraiandampak.required' => 'Uraian Dampak : tidak boleh kosong',
                ]
                );
            $inherentrisiko = new inherentrisiko();
            $inherentrisiko->kerawanan = $request->kerawanan;
            $inherentrisiko->ancaman = $request->ancaman;
            $inherentrisiko->aspekrisiko = $request->aspekrisiko;
            $inherentrisiko->uraiandampak = $request->uraiandampak;
            $inherentrisiko->jenis = $request->jenisid;
            $inherentrisiko->save();
            return redirect()->route('iteminherentrisiko.tampil',$request->jenisid)->with('success', 'Data baru berhasil disimpan!');
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
            return redirect()->route('iteminherentrisiko.tampil',$request->jenisid)->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('iteminherentrisiko.tampil',$request->jenisid)->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('iteminherentrisiko.tampil',$request->jenisid)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate(
                [
                    'kerawanan' => ['required'],'ancaman' => ['required'],'aspekrisiko' => ['required'],'uraiandampak' => ['required'],
                ],
                [
                    'kerawanan.required' => 'Kerawanan : tidak boleh kosong',
                    'ancaman.required' => 'Ancaman : tidak boleh kosong',
                    'aspekrisiko.required' => 'Aspek Risiko : tidak boleh kosong',
                    'uraiandampak.required' => 'uraian Dampak : tidak boleh kosong',
                ]
                );
            $inherentrisiko = Inherentrisiko::findOrFail($id);
            $inherentrisiko->kerawanan = $request->kerawanan;
            $inherentrisiko->ancaman = $request->ancaman;
            $inherentrisiko->aspekrisiko = $request->aspekrisiko;
            $inherentrisiko->uraiandampak = $request->uraiandampak;
            $inherentrisiko->update();
            return redirect()->route('iteminherentrisiko.tampil',$request->jenisid)->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('iteminherentrisiko.tampil',$request->jenisid)->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('iteminherentrisiko.tampil',$request->jenisid)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('iteminherentrisiko.tampil',$request->jenisid)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
