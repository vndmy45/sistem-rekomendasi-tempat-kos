<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Review;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function show($id)
    {
        $kos = Kos::with(['fasilitas', 'reviews.user'])->findOrFail($id);
        
        // Increment view count
        $kos->increment('views');
        
        $reviews = $kos->reviews()->with('user')->latest()->get();
        
        return view('kos.detail', [
            'kos' => $kos,
            'reviews' => $reviews
        ]);
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:10'
        ]);

        $kos = Kos::findOrFail($id);

        $review = new Review([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        $kos->reviews()->save($review);

        // Update kos rating
        $averageRating = $kos->reviews()->avg('rating');
        $kos->update(['rating' => round($averageRating)]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan');
    }
}
