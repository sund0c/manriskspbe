<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class OpdController extends Controller
{
    public function tampil(){
        $opd = Opd::get();
        return view('opd',compact('opd'));
    }

    public function hapus($id){
    try {
            $opd = Opd::findOrFail($id);
            $opd->delete();
            return redirect()->route('opd.tampil')->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('opd.tampil')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('opd.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function tambah(Request $request){
        try {
            $validatedData = $request->validate(
                [
                'singkatan' => ['required', 'min:3'],
                'nama' => ['required','min:5'],
                ],
                [
                'singkatan.required' => 'tidak boleh kosong',
                'singkatan.min' => 'minimal 3 karakter',
                'nama.required' => 'tidak boleh kosong',
                'nama.min' => 'minimal 5 karakter',
                ]
                );
            $opd = new Opd();
            $opd->singkatan = strtoupper($request->singkatan);
            $opd->nama = $request->nama;
            $opd->save();
            return redirect()->route('opd.tampil')->with('success', 'Data baru berhasil disimpan!');
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
            return redirect()->route('opd.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('opd.tampil')->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('opd.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate(
                [
                'singkatan' => ['required','min:3'],
                'nama' => ['required','min:5'],
                ],
                [
                'singkatan.required' => 'tidak boleh kosong',
                'singkatan.min' => 'minimal 3 karakter',
                'nama.required' => 'tidak boleh kosong',
                'nama.min' => 'minimal 5 karakter',
                ]
                );
            $opd = Opd::findOrFail($id);
            $opd->singkatan = strtoupper($request->singkatan);
            $opd->nama = $request->nama;
            $opd->update();
            return redirect()->route('opd.tampil')->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('opd.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('opd.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('opd.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
