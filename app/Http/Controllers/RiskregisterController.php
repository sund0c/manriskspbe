<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiskregisterController extends Controller
{
    public function index(){
        $data_layout = [
            'title' => 'RESIKO KEAMANAN ASET SPBE PEMPROV BALI',
            'card_title' => 'Risk Register',
        ];
        view()->share($data_layout);
        return view('riskregister');
    }
}
