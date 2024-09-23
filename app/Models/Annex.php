<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annex extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];

    //relasi ke tabel itemannexes
    public function itemannexes()
    {
        return $this->hasMany(Itemannex::class, 'domain', 'id');
    }

}
