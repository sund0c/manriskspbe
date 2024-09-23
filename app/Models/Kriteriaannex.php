<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteriaannex extends Model
{
    use HasFactory;
    protected $fillable = [
        'urut',
        'tanya',
        'penjelasan',
        'tujuan',
        'item',
    ];

    public function itemannexRelation()
    {
        return $this->belongsTo(Itemannex::class, 'item', 'id');
    }


}
