<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'rating',
        'jarak',
        'gambar',
        'alamat',
        'deskripsi',
        'status'
    ];

    // Relasi dengan fasilitas (many-to-many)
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'kos_fasilitas');
    }

    // Relasi dengan reviews (one-to-many)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Scope untuk filter pencarian
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['harga'] ?? false, function($query, $harga) {
            return $query->where(function($query) use ($harga) {
                if($harga == '< Rp. 500.000') {
                    $query->where('harga', '<', 500000);
                } elseif($harga == 'Rp. 500.000 - Rp. 1.000.000') {
                    $query->whereBetween('harga', [500000, 1000000]);
                } elseif($harga == '> Rp. 1.000.000') {
                    $query->where('harga', '>', 1000000);
                }
            });
        });

        $query->when($filters['rating'] ?? false, function($query, $rating) {
            return $query->where('rating', $rating);
        });

        $query->when($filters['jarak'] ?? false, function($query, $jarak) {
            if($jarak == '< 1 km') {
                return $query->where('jarak', '<', 1);
            } elseif($jarak == '1 - 3 km') {
                return $query->whereBetween('jarak', [1, 3]);
            } elseif($jarak == '> 3 km') {
                return $query->where('jarak', '>', 3);
            }
        });
    }

    // Scope untuk mendapatkan kos terpopuler
    public function scopePopular($query)
    {
        return $query->orderBy('rating', 'desc')
                    ->orderBy('views', 'desc')
                    ->orderBy('created_at', 'desc');
    }
} 