<?php

namespace App\Http\Controllers;
use App\Models\Annex;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnnexController extends Controller
{
    public function tampil(){
        $annex = Annex::get();
        return view('annex',compact('annex'));
    }

    // public function hapus($id){
    // try {
    //         $annex = Annex::findOrFail($id);
    //         $annex->delete();
    //         return redirect()->route('annex.tampil')->with('success', 'Data berhasil dihapus!');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         return redirect()->route('annex.tampil')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
    //     } catch (\Exception $e) {
    //         return redirect()->route('annex.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }


    // public function tambah(Request $request){
    //     try {
    //         $validatedData = $request->validate(
    //             [
    //             'nama' => ['required'],
    //             ],
    //             [
    //             'nama.required' => 'tidak boleh kosong',
    //             ]
    //             );
    //         $annex = new Annex();
    //         $annex->nama = $request->nama;
    //         $annex->save();
    //         return redirect()->route('annex.tampil')->with('success', 'Data baru berhasil disimpan!');
    //     } catch (ValidationException $e) {
    //         $errors = $e->errors();
    //         $errorMessages = "<p style='text-align: left;'>";
    //         foreach ($errors as $field => $messages) {
    //             $errorMessages .= "Field ".ucfirst($field) . ": ";
    //             foreach ($messages as $message) {
    //                 $errorMessages .= "$message";
    //             }
    //             $errorMessages .= "<br>";
    //         }
    //         $errorMessages .= "</p>";
    //         //dd($errorMessages);
    //         return redirect()->route('annex.tampil')->with('validasi',$errorMessages);
    //     } catch (\Illuminate\Database\QueryException $e) {
    //             return redirect()->route('annex.tampil')->with('error', 'Gagal menambah data: ' . $e->getMessage());
    //     } catch (\Exception $e) {
    //         return redirect()->route('annex.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }

    public function update(Request $request,$id){
        try {
                $validatedData = $request->validate(
                    [
                    'nama' => ['required'],
                    ],
                    [
                    'nama.required' => 'tidak boleh kosong',
                    ]);
            $annex = Annex::findOrFail($id);
            $annex->nama = $request->nama;
            $annex->update();
            return redirect()->route('annex.tampil')->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('annex.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('annex.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('annex.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
