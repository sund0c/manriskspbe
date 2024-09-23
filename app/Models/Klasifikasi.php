<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];

    //relasi ke tabel itemklasifikasi
    public function itemklasifikasi()
    {
        return $this->hasMany(Itemklasifikasi::class, 'domain', 'id');
    }
}
