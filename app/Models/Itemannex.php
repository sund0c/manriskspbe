<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemannex extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'domain',
    ];

    public function annexRelation()
    {
        return $this->belongsTo(Annex::class, 'domain', 'id');
    }


}
