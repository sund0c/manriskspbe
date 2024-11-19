<?php

namespace App\Http\Controllers;
use App\Models\Aset;
use App\Models\Layananspbe;
use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomExport;


class AsetrController extends Controller
{
    public function tampil(){
        $aset = Aset::with(['layananRelation', 'opdRelation'])
            ->orderBy('skorkategori', 'DESC')
            ->orderBy('user', 'ASC')
            ->get();

        $asetk = Aset::with(['layananRelation', 'opdRelation'])
            ->orderBy('skorklasifikasi', 'DESC')
            ->orderBy('user', 'ASC')
            ->get();

        $layananspbe = Layananspbe::orderBy('jenis', 'ASC')->orderBy('nama', 'ASC')->get();
        // $users = User::with(['roles', 'opdRelation'])->get();
        $users = Opd::all();
        return view('asetr',compact('aset','asetk','users','layananspbe'));
    }
}
