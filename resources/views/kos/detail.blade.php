@extends('layouts.app.app')
@section('content')
<div class="detail-page">
    <div class="container" style="margin-top: 100px;">
        <!-- Header Section -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="text-primary mb-0"><i class="fas fa-home me-2"></i>Detail Kos</h1>
            <div class="search-icon">
                <i class="fas fa-search fa-lg text-primary"></i>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Kos Name -->
                <h2 class="mb-4 text-center">{{ $kos->nama }}</h2>

                <!-- Image Gallery -->
                <div class="image-gallery mb-5">
                    <div class="main-image-container mb-3">
                        <img src="{{ asset('storage/' . $kos->gambar) }}" class="img-fluid main-image rounded" alt="{{ $kos->nama }}">
                    </div>
                    @if($kos->additional_images)
                        <div class="thumbnails-container">
                            <div class="row g-2">
                                @foreach(json_decode($kos->additional_images) as $image)
                                <div class="col-4">
                                    <div class="thumbnail-wrapper">
                                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid thumbnail rounded" alt="Additional Image">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Info Section -->
                <div class="info-section mb-5">
                    <!-- Rating & Price -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="rating-container">
                            <div class="rating mb-1">
                                @for($i = 0; $i < $kos->rating; $i++)
                                    ⭐
                                @endfor
                            </div>
                            <span class="text-muted">({{ $kos->reviews_count ?? 0 }} reviews)</span>
                        </div>
                        <div class="price-container">
                            <h3 class="text-primary mb-0">Rp. {{ number_format($kos->harga, 0, ',', '.') }}</h3>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="location-container mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span>Jarak: {{ $kos->jarak }} Km</span>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="facilities-container">
                        <h4 class="section-title mb-3">Fasilitas:</h4>
                        <div class="row g-3">
                            @foreach($kos->fasilitas as $fasilitas)
                            <div class="col-6">
                                <div class="facility-item">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <span>{{ $fasilitas->nama }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="contact-section mb-5">
                    <h4 class="section-title mb-3">Hubungi Pemilik:</h4>
                    <div class="contact-buttons">
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="tel:{{ $kos->phone }}" class="btn btn-primary w-100">
                                    <i class="fas fa-phone me-2"></i> {{ $kos->phone }}
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="https://wa.me/{{ $kos->phone }}" class="btn btn-success w-100" target="_blank">
                                    <i class="fab fa-whatsapp me-2"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="description-section mb-5">
                    <h4 class="section-title mb-3">Deskripsi</h4>
                    <div class="card description-card">
                        <div class="card-body" style="max-height: 120px; overflow-y: auto;">
                            <p class="mb-0" style="font-size: 0.9rem; line-height: 1.5;">{{ $kos->deskripsi }}</p>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="reviews-section mb-5">
                    <h4 class="section-title mb-3">Ulasan Pengguna</h4>
                    
                    <!-- Reviews List -->
                    <div class="reviews-list mb-4" style="max-height: 300px; overflow-y: auto;">
                        @forelse($reviews as $review)
                        <div class="card review-card mb-2">
                            <div class="card-body py-2">
                                <div class="d-flex align-items-center mb-1">
                                    <img src="{{ asset('assets/img/default-avatar.png') }}" class="rounded-circle me-2" width="32" height="32" alt="User Avatar">
                                    <div>
                                        <h6 class="mb-0" style="font-size: 0.85rem;">{{ $review->user->name }}</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $review->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <div class="rating mb-1" style="font-size: 0.8rem;">
                                    @for($i = 0; $i < $review->rating; $i++)
                                        ⭐
                                    @endfor
                                </div>
                                <p class="mb-0" style="font-size: 0.85rem;">{{ $review->review }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-muted">Belum ada ulasan.</div>
                        @endforelse
                    </div>

                    <!-- Add Review Form -->
                    @auth
                    <div class="add-review">
                        <div class="card">
                            <div class="card-body py-3">
                                <h5 class="card-title mb-2" style="font-size: 0.95rem;">Tambah Ulasan</h5>
                                <form action="{{ route('reviews.store', $kos->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <label class="form-label small">Rating</label>
                                        <select name="rating" class="form-select form-select-sm" style="height: 32px;" required>
                                            <option value="5">⭐⭐⭐⭐⭐</option>
                                            <option value="4">⭐⭐⭐⭐</option>
                                            <option value="3">⭐⭐⭐</option>
                                            <option value="2">⭐⭐</option>
                                            <option value="1">⭐</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small">Ulasan</label>
                                        <textarea name="review" class="form-control form-control-sm" style="height: 60px;" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm py-1">Kirim Ulasan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info py-2 small">
                        <a href="{{ route('login') }}" class="alert-link">Login</a> untuk memberikan ulasan.
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.detail-page {
    padding-bottom: 100px;
    background-color: #f8f9fa;
}

.container {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.main-image-container {
    width: 100%;
    height: 400px;
    overflow: hidden;
    border-radius: 10px;
}

.main-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumbnail-wrapper {
    aspect-ratio: 16/9;
    overflow: hidden;
    border-radius: 8px;
}

.thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.thumbnail:hover {
    transform: scale(1.05);
}

.section-title {
    color: var(--pr-color);
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.facility-item {
    background-color: #f8f9fa;
    padding: 12px 15px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

.facility-item i {
    font-size: 1rem;
    min-width: 20px;
}

.description-card {
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.description-card .card-body::-webkit-scrollbar,
.reviews-list::-webkit-scrollbar {
    width: 4px;
}

.description-card .card-body::-webkit-scrollbar-thumb,
.reviews-list::-webkit-scrollbar-thumb {
    background-color: rgba(113, 180, 243, 0.5);
    border-radius: 4px;
}

.description-card .card-body::-webkit-scrollbar-track,
.reviews-list::-webkit-scrollbar-track {
    background-color: #f8f9fa;
}

.review-card {
    border: none;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.review-card .card-body {
    padding: 0.75rem 1rem;
}

.form-select-sm {
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}

.btn-sm {
    font-size: 0.85rem;
}

@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    .main-image-container {
        height: 300px;
    }
    
    .col-6 {
        width: 100%;
    }

    .description-card .card-body {
        max-height: 150px;
    }
    
    .reviews-list {
        max-height: 350px;
    }
}
</style>
@endpush
@endsection 