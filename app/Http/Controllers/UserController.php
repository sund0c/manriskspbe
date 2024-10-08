<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class UserController extends Controller
{
    public function tampil(){
        $users = User::with(['roles', 'opdRelation'])->get();
        $opd = Opd::all();
        return view('user', compact('users', 'opd'));

    }

    public function hapus($id){
        try {
                $user = User::findOrFail($id);
                $user->delete();
                return redirect()->route('user.tampil')->with('success', 'Data berhasil dihapus! ');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('user.tampil')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('user.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }


        public function tambah(Request $request){
            try {
                $validatedData = $request->validate(
                    [
                    'nama' => ['required','min:5'],
                    'opd_id' => ['required'],
                    'email' => ['required','email','unique:users,email'],
                    'password' => ['required', 'string', 'min:8', function ($attribute, $value, $fail) {
                        if (!preg_match('/[0-9]/', $value) || !preg_match('/[a-zA-Z]/', $value) || !preg_match('/[~!@#$%^&*()_+{}\[\]:;<>,.?\/-]/', $value)) {
                            $fail('Password kurang kuat, harus berisi kombinasi huruf, angka, dan simbol.');
                        }
                    }],
                    ],
                    [

                    'opd_id.required' => 'tidak boleh kosong',
                    'password.min' => 'minimal 8 karakter',
                    'nama.required' => 'tidak boleh kosong',
                    'email.required' => 'tidak boleh kosong',
                    'email.email' => 'format email tidak valid',
                    'email.unique' => 'email sudah terdaftar',
                    'nama.min' => 'minimal 5 karakter',
                    ]
                    );

                $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'opd' => $request->opd_id,
            ]);
                $user->assignRole($request->role);

                $user->save();
                return redirect()->route('user.tampil')->with('success', 'Data baru berhasil disimpan!');
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
                return redirect()->route('user.tampil')->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('user.tampil')->with('error', 'Gagal menambah data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('user.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }

        public function update(Request $request,$id){
            try {
                $validatedData = $request->validate(
                    [
                    'nama' => ['required','min:5'],
                    'email' => ['required','email','unique:users,email'],
                    ],
                    [
                    'nama.required' => 'tidak boleh kosong',
                    'email.required' => 'tidak boleh kosong',
                    'email.email' => 'format email tidak valid',
                    'email.unique' => 'email sudah terdaftar',
                    'nama.min' => 'minimal 5 karakter',
                    ]
                    );
                $user = User::findOrFail($id);
                $user->nama = $request->nama;
                $user->email = $request->email;
                $user->update();
                return redirect()->route('user.tampil')->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('user.tampil')->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('user.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('user.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }

        public function pupdate(Request $request,$id){
            try {
                $validatedData = $request->validate(
                    [
                    'oldpassword' => ['required'],
                    'passwordNew' => ['required', 'string', 'min:8', function ($attribute, $value, $fail) {
                        if (!preg_match('/[0-9]/', $value) || !preg_match('/[a-zA-Z]/', $value) || !preg_match('/[~!@#$%^&*()_+{}\[\]:;<>,.?\/-]/', $value)) {
                            $fail('Password kurang kuat, harus berisi kombinasi huruf, angka, dan simbol.');
                        }
                    }],
                    ],
                    [
                    'oldpassword.required' => 'tidak boleh kosong',
                    'passwordNew.required' => 'tidak boleh kosong',
                    'passwordNew.min' => 'minimal 8 karakter',
                    ]
                    );

                $user = User::findOrFail($id);
                    // Cek apakah password lama benar
                    if (!Hash::check($request->oldpassword, $user->password)) {
                        //return back()->withErrors(['current_password' => 'Password lama tidak benar.']);
                        return redirect()->route('user.tampil')->with('validasi','Password lama tidak benar');
                    }

                    // Ganti password
                    $user->password = Hash::make($request->passwordNew);
                    $user->save();
                    Auth::logout();
                return redirect()->route('user.tampil')->with('success', 'Data berhasil diperbarui!');
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
                return redirect()->route('user.tampil')->with('validasi',$errorMessages);
            } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->route('user.tampil')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
            } catch (\Exception $e) {
                return redirect()->route('user.tampil')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }


}
