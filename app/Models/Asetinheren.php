<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asetinheren extends Model
{
    use HasFactory;
    protected $fillable = [
        'aset',
        'inheren',
        'nilaidampak',
        'nilaikemungkinan',
    ];

    public function asetRelation()
    {
        return $this->belongsTo(Aset::class, 'aset', 'id');
    }
    public function inherentRelation()
    {
        return $this->belongsTo(Inherentrisiko::class, 'inheren', 'id');
    }


    // public function inherentRelation()
    // {
    //     return $this->belongsTo(Inherentrisiko::class, 'inheren', 'id');
    // }    
}
