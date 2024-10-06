<?php

namespace App\Http\Controllers;

use App\Models\Itemklasifikasi;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemklasifikasiController extends Controller
{
    public function tampil($id){
        $itemklasifikasis = Itemklasifikasi::where('domain', $id) // Filter berdasarkan domain
                           ->with('klasifikasiRelation') // Eager load annexRelation
                           ->orderBy('urut', 'ASC')
                           ->get();
        //$annexes = Klasifikasi::all();
        $idklasifikasi = Klasifikasi::where('id', $id)->get();
        return view('itemklasifikasi', compact('itemklasifikasis','idklasifikasi'));
    }

    public function hapus($id,$domain){
        try {
                $user = ItemKlasifikasi::findOrFail($id);
                $user->delete();
                return redirect()->route('itemklasifikasi.tampil',$domain)->with('success', 'Data berhasil dihapus! ');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('itemklasifikasi.tampil',$domain)->with('error', 'Gagal menghapus data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('itemklasifikasi.tampil',$domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
    }

    public function tambah(Request $request){
        try {
            $validatedData = $request->validate(
                [
                'kriteria' => ['required'],'j1' => ['required'],'j2' => ['required'],'j3' => ['required'],'domain' => ['required']
                ],
                [
                'kriteria.required' => 'Kriteria : tidak boleh kosong',
                'j1.required' => 'Indikator #1 : tidak boleh kosong',
                'j2.required' => 'Indikator #2 : tidak boleh kosong',
                'j3.required' => 'Indikator #3 : tidak boleh kosong',
                'domain.required' => 'tidak boleh kosong',
                ]
                );
            $item = ItemKlasifikasi::create([
            'tanya' => $request->kriteria,
            'j1' => $request->j1,
            'j2' => $request->j2,
            'j3' => $request->j3,
            'domain' => $request->domain,
        ]);
            $item->save();
            return redirect()->route('itemklasifikasi.tampil',$request->domain)->with('success', 'Data baru berhasil disimpan!');
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
            return redirect()->route('itemklasifikasi.tampil',$request->domain)->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('itemklasifikasi.tampil',$request->domain)->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('itemklasifikasi.tampil',$request->domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

        public function update(Request $request,$id){
            try {
                $validatedData = $request->validate(
                    [
                    'kriteria' => ['required'],'j1' => ['required'],'j2' => ['required'],'j3' => ['required'],'domain' => ['required']
                    ],
                    [
                    'kriteria.required' => 'Kriteria : tidak boleh kosong',
                    'j1.required' => 'Indikator #1 : tidak boleh kosong',
                    'j2.required' => 'Indikator #2 : tidak boleh kosong',
                    'j3.required' => 'Indikator #3 : tidak boleh kosong',
                    'domain.required' => 'tidak boleh kosong',
                    ]
                    );

                $item = ItemKlasifikasi::findOrFail($id);
                $item->tanya = $request->kriteria;
                $item->j1 = $request->j1;
                $item->j2 = $request->j2;
                $item->j3 = $request->j3;
                $item->domain = $request->domain;
                $item->update();
                return redirect()->route('itemklasifikasi.tampil',$request->domain)->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('itemklasifikasi.tampil',$request->domain)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('itemklasifikasi.tampil',$request->domain)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('itemklasifikasi.tampil',$request->domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
}
