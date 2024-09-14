<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data_layout = [
            'title' => 'Daftar Pengguna',
            'card_title' => 'Pengguna',
        ];
        view()->share($data_layout);
        return view('user');
    }
    //
}
