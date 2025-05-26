<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'icon'
    ];

    // Relasi dengan kos (many-to-many)
    public function kos()
    {
        return $this->belongsToMany(Kos::class, 'kos_fasilitas');
    }
} 