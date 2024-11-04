<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inherentrisiko extends Model
{
    use HasFactory;
    protected $fillable = [
        'kerawanan',
        'ancaman',
        'aspekrisiko',
        'uraiandampak',
    ];

}
