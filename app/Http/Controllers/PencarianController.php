<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        
        $kos = Kos::with('fasilitas')
            ->filter(request(['harga', 'rating', 'jarak']))
            ->when(request('fasilitas'), function($query) {
                return $query->whereHas('fasilitas', function($query) {
                    $query->where('fasilitas.id', request('fasilitas'));
                });
            })
            ->latest()
            ->paginate(9);

        return view('pencarian', [
            'kos_list' => $kos,
            'fasilitas' => $fasilitas
        ]);
    }

    public function filter(Request $request)
    {
        $kos = Kos::with('fasilitas')
            ->filter($request->only(['harga', 'rating', 'jarak']))
            ->when($request->fasilitas, function($query) use ($request) {
                return $query->whereHas('fasilitas', function($query) use ($request) {
                    $query->where('fasilitas.id', $request->fasilitas);
                });
            })
            ->latest()
            ->paginate(9);

        return response()->json([
            'status' => 'success',
            'data' => $kos
        ]);
    }
} 