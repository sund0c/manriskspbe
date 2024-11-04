<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InherentrisikoController extends Controller
{
    public function tampil(){
        return view('inherentrisiko');
    }
}
