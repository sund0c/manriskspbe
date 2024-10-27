<?php

namespace App\Http\Controllers;

use App\Models\Itemdampakvital;
use App\Models\Dampakvital;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemdampakvitalController extends Controller
{
    public function tampil($id){
        $itemdampakvitals = Itemdampakvital::where('domain', $id) // Filter berdasarkan domain
                           ->with('dampakvitalRelation') // Eager load annexRelation
                           ->orderBy('urut', 'ASC')
                           ->get();
        //$annexes = Dampakvital::all();
        $iddampakvital = Dampakvital::where('id', $id)->get();
        return view('itemdampakvital', compact('itemdampakvitals','iddampakvital'));
    }

    public function hapus($id,$domain){
        try {
                $user = Itemdampakvital::findOrFail($id);
                $user->delete();
                return redirect()->route('itemdampakvital.tampil',$domain)->with('success', 'Data berhasil dihapus! ');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('itemdampakvital.tampil',$domain)->with('error', 'Gagal menghapus data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('itemdampakvital.tampil',$domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
                'j4.required' => 'Indikator #4 : tidak boleh kosong',
                'domain.required' => 'tidak boleh kosong',
                ]
                );
            $item = Itemdampakvital::create([
            'tanya' => $request->kriteria,
            'j1' => $request->j1,
            'j2' => $request->j2,
            'j3' => $request->j3,
            'j4' => $request->j4,
            'domain' => $request->domain,
        ]);
            $item->save();
            return redirect()->route('itemdampakvital.tampil',$request->domain)->with('success', 'Data baru berhasil disimpan!');
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
            return redirect()->route('itemdampakvital.tampil',$request->domain)->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('itemdampakvital.tampil',$request->domain)->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('itemdampakvital.tampil',$request->domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

        public function update(Request $request,$id){
            try {
                $validatedData = $request->validate(
                    [
                    'kriteria' => ['required'],'j1' => ['required'],'j2' => ['required'],'j3' => ['required'],'j4' => ['required'],'domain' => ['required']
                    ],
                    [
                    'kriteria.required' => 'Kriteria : tidak boleh kosong',
                    'j1.required' => 'Indikator #1 : tidak boleh kosong',
                    'j2.required' => 'Indikator #2 : tidak boleh kosong',
                    'j3.required' => 'Indikator #3 : tidak boleh kosong',
                    'j4.required' => 'Indikator #4 : tidak boleh kosong',
                    'domain.required' => 'tidak boleh kosong',
                    ]
                    );

                $item = Itemdampakvital::findOrFail($id);
                $item->tanya = $request->kriteria;
                $item->j1 = $request->j1;
                $item->j2 = $request->j2;
                $item->j3 = $request->j3;
                $item->j4 = $request->j4;
                $item->domain = $request->domain;
                $item->update();
                return redirect()->route('itemdampakvital.tampil',$request->domain)->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('itemdampakvital.tampil',$request->domain)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('itemdampakvital.tampil',$request->domain)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('itemdampakvital.tampil',$request->domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
}
