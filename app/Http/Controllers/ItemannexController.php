<?php

namespace App\Http\Controllers;
use App\Models\Annex;
use App\Models\Itemannex;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemannexController extends Controller
{
    public function tampil($id){
        $itemannexes = Itemannex::where('domain', $id) // Filter berdasarkan domain
                           ->with('annexRelation') // Eager load annexRelation
                           ->get();
        $annexes = Annex::all();
        $idannex = Annex::where('id', $id)->get();
        return view('itemannex', compact('itemannexes', 'annexes','idannex'));
    }

    public function hapus($id,$domain){
        try {
                $user = Itemannex::findOrFail($id);
                $user->delete();
                return redirect()->route('itemannex.tampil',$domain)->with('success', 'Data berhasil dihapus! ');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('itemannex.tampil',$domain)->with('error', 'Gagal menghapus data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('itemannex.tampil',$domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
    }

    public function tambah(Request $request){
        try {
            $validatedData = $request->validate(
                [
                'nama' => ['required'],
                'domain' => ['required'],
                ],
                [
                'domain.required' => 'tidak boleh kosong',
                'nama.required' => 'tidak boleh kosong',
                ]
                );
            $item = Itemannex::create([
            'nama' => $request->nama,
            'domain' => $request->domain,
        ]);
            $item->save();
            return redirect()->route('itemannex.tampil',$request->domain)->with('success', 'Data baru berhasil disimpan!');
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
            return redirect()->route('itemannex.tampil',$request->domain)->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('itemannex.tampil',$request->domain)->with('error', 'Gagal menambah data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('itemannex.tampil',$request->domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

        public function update(Request $request,$id){
            try {
                $validatedData = $request->validate(
                    [
                    'nama' => ['required'],
                    'domain' => ['required'],
                    ],
                    [
                    'domain.required' => 'tidak boleh kosong',
                    'nama.required' => 'tidak boleh kosong',
                    ]
                    );

                $item = Itemannex::findOrFail($id);
                $item->nama = $request->nama;
                $item->domain = $request->domain;
                $item->update();
                return redirect()->route('itemannex.tampil',$request->domain)->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('itemannex.tampil',$request->domain)->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('itemannex.tampil',$request->domain)->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('itemannex.tampil',$request->domain)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
}
