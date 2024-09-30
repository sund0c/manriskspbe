<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemklasifikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanya',
        'j1',
        'j2',
        'j3',
        'j4',
        'urut',
        'domain',
    ];

    public function klasifikasiRelation()
    {
        return $this->belongsTo(Klasifikasi::class, 'domain', 'id');
    }
}
