<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inherenimpact extends Model
{
    use HasFactory;
    protected $fillable = [
        'impact',
        'inheren',
        'nilaiimpact',
    ];

    // public function asetRelation()
    // {
    //     return $this->belongsTo(Aset::class, 'aset', 'id');
    // }
    // public function inherentRelation()
    // {
    //     return $this->belongsTo(Inherentrisiko::class, 'inheren', 'id');
    // }
    public function impactRelation()
    {
        return $this->belongsTo(Areadampak::class, 'impact', 'id');
    }    
}
