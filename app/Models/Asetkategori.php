<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asetkategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanya',
        'jawab',
        'aset',
        'keterangan',
    ];

    public function asetRelation()
    {
        return $this->belongsTo(Aset::class, 'aset', 'id');
    }
    public function kategoriseRelation()
    {
        return $this->belongsTo(Kategorise::class, 'tanya', 'id');
    }
}
