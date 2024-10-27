<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dampakvital extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];

    public function itemdampakvital()
    {
        return $this->hasMany(Itemdampakvital::class, 'domain', 'id');
    }
}
