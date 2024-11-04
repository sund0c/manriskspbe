<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemrisiko extends Model
{
    use HasFactory;
    protected $fillable = [
        'kerawanan',
        'ancaman',
        'aspekrisiko',
        'uraiandampak',
        'pemilikrisiko',
        'inherentkemungkinan',
        'inherentdampak',
        'inherentrisiko',
    ];

}
