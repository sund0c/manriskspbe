<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteriakemungkinan extends Model
{
    use HasFactory;
    protected $fillable = [
        'rare',
        'unlikely',
        'possible',
        'likely',
        'almost',
    ];
}