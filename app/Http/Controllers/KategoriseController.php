<?php

namespace App\Http\Controllers;

use App\Models\Kategorise;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KategoriseController extends Controller
{
    public function tampil(){
        // $kategorise = Kategorise::get();
        $kategorise = Kategorise::orderBy('urut', 'ASC')->get();
        return view('kategorise',compact('kategorise'));
    }

    public function hapus($id){
    try {
            $kategorise = Kategorise::findOrFail($id);
            $kategorise->delete();
            return redirect()->route('kategorise.tampil')->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kategorise.tampil')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('kategorise.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambah(Request $request){
        try {
            $validatedData = $request->validate(
                [
                'kriteria' => ['required'],'j1' => ['required'],'j2' => ['required'],'j3' => ['required'],
                ],
                [
                'kriteria.required' => 'Kriteria : tidak boleh kosong',
                'j1.required' => 'Indikator #1 : tidak boleh kosong',
                'j2.required' => 'Indikator #2 : tidak boleh kosong',
                'j3.required' => 'Indikator #3 : tidak boleh kosong',
                ]
                );
            $kategorise = new Kategorise();
            $kategorise->tanya = $request->kriteria;
            $kategorise->j1 = $request->j1;
            $kategorise->j2 = $request->j2;
            $kategorise->j3 = $request->j3;
            $kategorise->save();
            return redirect()->route('kategorise.tampil')->with('success', 'Data baru berhasil disimpan!');
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
            return redirect()->route('kategorise.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('kategorise.tampil')->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('kategorise.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate(
                [
                'kriteria' => ['required'],'j1' => ['required'],'j2' => ['required'],'j3' => ['required'],
                ],
                [
                'kriteria.required' => 'Kriteria : tidak boleh kosong',
                'j1.required' => 'Indikator #1 : tidak boleh kosong',
                'j2.required' => 'Indikator #2 : tidak boleh kosong',
                'j3.required' => 'Indikator #3 : tidak boleh kosong',
                ]
                );
            $kategorise = Kategorise::findOrFail($id);
            $kategorise->tanya = $request->kriteria;
            $kategorise->j1 = $request->j1;
            $kategorise->j2 = $request->j2;
            $kategorise->j3 = $request->j3;
            $kategorise->update();
            return redirect()->route('kategorise.tampil')->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('kategorise.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('kategorise.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('kategorise.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
