<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areadampak extends Model
{
    use HasFactory;
    protected $fillable = [
        'area',
        'uraian',
        'insignificant',
        'low',
        'medium',
        'high',
        'critical'
    ];
}