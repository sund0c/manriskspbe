<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $fillable = [
        'singkatan',
        'nama',
    ];

    // Relasi ke tabel users
    public function users()
    {
        return $this->hasMany(User::class, 'opd', 'id');
    }
}
