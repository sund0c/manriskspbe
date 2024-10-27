<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemdampakvital extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanya',
        'j1',
        'j2',
        'j3',
        'j4',
        'urut',
        'domain',
    ];

    public function dampakvitalRelation()
    {
        return $this->belongsTo(Dampakvital::class, 'domain', 'id');
    }
}
