@extends('layouts.app.app')
@section('content')
<div class="detail-page">
    <!-- Breadcrumb -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pencarian.index') }}">Pencarian</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $kos->nama }}</li>
            </ol>
        </nav>
    </div>

    <!-- Detail Section -->
    <div class="container mt-3">
        <div class="row">
            <!-- Image Gallery -->
            <div class="col-md-8">
                <div class="detail-images mb-4">
                    <div class="row g-2">
                        <div class="col-12">
                            <img src="{{ asset('storage/' . $kos->gambar) }}" class="img-fluid main-image rounded" alt="{{ $kos->nama }}">
                        </div>
                        @if($kos->additional_images)
                            @foreach(json_decode($kos->additional_images) as $image)
                            <div class="col-4">
                                <img src="{{ asset('storage/' . $image) }}" class="img-fluid thumbnail rounded" alt="Additional Image">
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Info Panel -->
            <div class="col-md-4">
                <div class="card info-panel">
                    <div class="card-body">
                        <h2 class="card-title mb-3">{{ $kos->nama }}</h2>
                        
                        <div class="d-flex align-items-center mb-3">
                            <div class="rating me-2">
                                @for($i = 0; $i < $kos->rating; $i++)
                                    ⭐
                                @endfor
                            </div>
                            <span class="text-muted">({{ $kos->reviews_count ?? 0 }} reviews)</span>
                        </div>

                        <div class="info-item mb-3">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <span>Jarak: {{ $kos->jarak }} Km</span>
                        </div>

                        <h3 class="price mb-4">Rp. {{ number_format($kos->harga, 0, ',', '.') }}</h3>

                        <div class="facilities mb-4">
                            <h5>Fasilitas:</h5>
                            <div class="row g-2">
                                @foreach($kos->fasilitas as $fasilitas)
                                <div class="col-6">
                                    <div class="facility-item">
                                        <i class="fas fa-check text-success"></i>
                                        {{ $fasilitas->nama }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="contact-info mb-4">
                            <h5>Hubungi Pemilik:</h5>
                            <div class="d-grid gap-2">
                                <a href="tel:{{ $kos->phone }}" class="btn btn-primary">
                                    <i class="fas fa-phone"></i> {{ $kos->phone }}
                                </a>
                                <a href="https://wa.me/{{ $kos->phone }}" class="btn btn-success" target="_blank">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4>Deskripsi</h4>
                        <p>{{ $kos->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4>Ulasan Pengguna</h4>
                        @forelse($reviews as $review)
                        <div class="review-item mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset('assets/img/default-avatar.png') }}" class="rounded-circle me-2" width="40" height="40" alt="User Avatar">
                                <div>
                                    <h6 class="mb-0">{{ $review->user->name }}</h6>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="rating mb-2">
                                @for($i = 0; $i < $review->rating; $i++)
                                    ⭐
                                @endfor
                            </div>
                            <p class="mb-0">{{ $review->review }}</p>
                        </div>
                        @empty
                        <p class="text-muted">Belum ada ulasan.</p>
                        @endforelse

                        @auth
                        <div class="add-review mt-4">
                            <h5>Tambah Ulasan</h5>
                            <form action="{{ route('reviews.store', $kos->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <select name="rating" class="form-select" required>
                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                        <option value="4">⭐⭐⭐⭐</option>
                                        <option value="3">⭐⭐⭐</option>
                                        <option value="2">⭐⭐</option>
                                        <option value="1">⭐</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ulasan</label>
                                    <textarea name="review" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                            </form>
                        </div>
                        @else
                        <p class="mt-4">
                            <a href="{{ route('login') }}">Login</a> untuk memberikan ulasan.
                        </p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.detail-page {
    padding-bottom: 60px;
}

.main-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.thumbnail {
    width: 100%;
    height: 150px;
    object-fit: cover;
    cursor: pointer;
    transition: opacity 0.3s;
}

.thumbnail:hover {
    opacity: 0.8;
}

.info-panel {
    position: sticky;
    top: 20px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.facility-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px;
    background-color: #f8f9fa;
    border-radius: 6px;
    font-size: 0.9rem;
}

.price {
    color: var(--pr-color);
    font-weight: bold;
}

.review-item:last-child {
    border-bottom: none !important;
}
</style>
@endpush
@endsection 