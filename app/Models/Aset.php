<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'url',
        'ip',
        'keterangan',
        'jenis',
        'user',
        'layanan',
    ];

    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
    public function layananRelation()
    {
        return $this->belongsTo(Layananspbe::class, 'layanan', 'id');
    }

}
