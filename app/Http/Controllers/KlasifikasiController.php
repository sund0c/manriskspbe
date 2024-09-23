<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KlasifikasiController extends Controller
{
    public function tampil(){
        $klasifikasi = Klasifikasi::get();
        return view('klasifikasi',compact('klasifikasi'));
    }

    public function update(Request $request,$id){
        try {
                $validatedData = $request->validate(
                    [
                    'nama' => ['required'],
                    ],
                    [
                    'nama.required' => 'tidak boleh kosong',
                    ]);
            $klasifikasi = Klasifikasi::findOrFail($id);
            $klasifikasi->nama = strip_tags($request->nama);
            $klasifikasi->update();
            return redirect()->route('klasifikasi.tampil')->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('klasifikasi.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('klasifikasi.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('klasifikasi.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
