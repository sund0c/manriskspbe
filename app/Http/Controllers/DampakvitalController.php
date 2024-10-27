<?php

namespace App\Http\Controllers;

use App\Models\Dampakvital;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DampakvitalController extends Controller
{
    public function tampil(){
        $dampakvital = Dampakvital::orderBy('id', 'ASC')->get();
        return view('dampakvital',compact('dampakvital'));
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
            $dampakvital = Dampakvital::findOrFail($id);
            $dampakvital->nama = $request->nama;
            $dampakvital->update();
            return redirect()->route('dampakvital.tampil')->with('success', 'Data berhasil diperbarui!');
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
            return redirect()->route('dampakvital.tampil')->with('validasi',$errorMessages);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('dampakvital.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('dampakvital.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
