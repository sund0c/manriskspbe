<?php

namespace App\Http\Controllers;

use App\Models\Layananspbe;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LayananspbeController extends Controller
{
    public function tampil(){
        $layananspbe = Layananspbe::get();
        return view('layananspbe',compact('layananspbe'));
    }

    public function hapus($id){
    try {
            $opd = Layananspbe::findOrFail($id);
            $opd->delete();
            return redirect()->route('layananspbe.tampil')->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('layananspbe.tampil')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('layananspbe.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function tambah(Request $request){
        try {
            $validatedData = $request->validate(
                [
                'nama' => ['required'],
                'jenis' => ['required'],
                ],
                [
                'nama.required' => 'tidak boleh kosong',
                'jenis.required' => 'tidak boleh kosong',
                ]
                );
            $opd = new Layananspbe();
            $opd->nama = strtoupper($request->nama);
            $opd->save();
            return redirect()->route('layananspbe.tampil')->with('success', 'Data baru berhasil disimpan!');
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
            //dd($errorMessages);
            return redirect()->route('layananspbe.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('layananspbe.tampil')->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('layananspbe.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate(
                [
                'nama' => ['required'],
                'jenis' => ['required'],
                ],
                [
                'nama.required' => 'tidak boleh kosong',
                'jenis.required' => 'tidak boleh kosong',
                ]
                );
            $opd = Layananspbe::findOrFail($id);
            $opd->nama = strtoupper($request->nama);
            $opd->update();
            return redirect()->route('layananspbe.tampil')->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('layananspbe.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('layananspbe.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('layananspbe.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
