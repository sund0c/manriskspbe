<?php

namespace App\Http\Controllers;

use App\Models\Itemannex;
use App\Models\Kriteriaannex;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KriteriaannexController extends Controller
{
    public function tampil($id){
        $kriteriaannexes = Kriteriaannex::where('item', $id) // Filter berdasarkan domain
                           ->with('itemannexRelation') // Eager load annexRelation
                           ->orderBy('urut', 'asc')
                           ->get();
        $iditemannex = Itemannex::where('id', $id)->get();
        return view('kriteriaannex', compact('kriteriaannexes','iditemannex'));
    }

    public function hapus($id,$item){
        try {
                $user = Kriteriaannex::findOrFail($id);
                $user->delete();
                return redirect()->route('kriteriaannex.tampil',$item)->with('success', 'Data berhasil dihapus! ');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('kriteriaannex.tampil',$item)->with('error', 'Gagal menghapus data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('kriteriaannex.tampil',$item)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
    }

    public function tambah(Request $request){
        try {
            $validatedData = $request->validate(
                [
                'kriteria' => ['required'],
                'urut' => ['numeric'],
                'penjelasan' => ['required'],
                'tujuan' => ['required'],
                'item' => ['required'],
                ],
                [
                'urut.numeric' => 'hanya angka',
                'item.required' => 'tidak boleh kosong',
                'kriteria.required' => 'tidak boleh kosong',
                'penjelasan.required' => 'tidak boleh kosong',
                'tujuan.required' => 'tidak boleh kosong',
                ]
                );
            $item = Kriteriaannex::create([
            'tanya' => strip_tags($request->kriteria),
            'penjelasan' => strip_tags($request->penjelasan),
            'tujuan' => strip_tags($request->tujuan),
            'item' => strip_tags($request->item),
            'urut' => strip_tags($request->urut),
        ]);
        //dd($request);
            $item->save();
            return redirect()->route('kriteriaannex.tampil',$request->item)->with('success', 'Data baru berhasil disimpan!');
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
            return redirect()->route('kriteriaannex.tampil',$request->item)->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('kriteriaannex.tampil',$request->item)->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('kriteriaannex.tampil',$request->item)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate(
                [
                'kriteria' => ['required'],
                'urut' => ['numeric'],
                'penjelasan' => ['required'],
                'tujuan' => ['required'],
                'item' => ['required'],
                ],
                [
                'urut.numeric' => 'hanya angka',
                'item.required' => 'tidak boleh kosong',
                'kriteria.required' => 'tidak boleh kosong',
                'penjelasan.required' => 'tidak boleh kosong',
                'tujuan.required' => 'tidak boleh kosong',
                ]
                );
                $item = Kriteriaannex::findOrFail($id);
                $item->tanya = strip_tags($request->kriteria);
                $item->penjelasan = strip_tags($request->penjelasan);
                $item->tujuan = strip_tags($request->tujuan);
                $item->item = strip_tags($request->item);
                $item->urut = strip_tags($request->urut);
                $item->update();
            return redirect()->route('kriteriaannex.tampil',$request->item)->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('kriteriaannex.tampil',$request->item)->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('kriteriaannex.tampil',$request->item)->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('kriteriaannex.tampil',$request->item)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
