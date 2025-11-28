@extends('layouts.front')

@section('title', 'Beranda')

@section('content')

<style>
    :root {
        --primary-color: #4f46e5;       /
        --primary-hover: #4338ca;      
        --primary-subtle: #e0e7ff;      
        --text-dark: #0f172a;
        --text-gray: #64748b;
    }

    .main-canvas {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        padding: 1.5rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .hero-carousel {
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .carousel-item {
        height: 320px;
    }

    .carousel-content-wrapper {
        height: 100%;
        display: flex;
        align-items: center;
    }

    .bg-slide-1 { background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%); }
    .bg-slide-2 { background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); }
    .bg-slide-3 { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); }

    .carousel-control-prev, .carousel-control-next { width: 5%; }
    .carousel-control-prev-icon, .carousel-control-next-icon {
        background-color: rgba(0,0,0,0.1);
        border-radius: 50%;
        padding: 15px;
        background-size: 50%;
    }

    .category-scroll {
        display: flex;
        gap: 12px; 
        overflow-x: auto;
        padding: 5px; 
        scrollbar-width: none;
    }
    .category-scroll::-webkit-scrollbar { display: none; }

    .btn-cat {
        white-space: nowrap;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        cursor: pointer;
        
        background: white;
        border: 2px solid #e2e8f0;
        color: var(--text-dark);
    }

    .btn-cat:hover {
        background-color: var(--primary-subtle); 
        border-color: var(--primary-color);      
        color: var(--primary-color);              
        transform: translateY(-3px);            
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }

    .btn-cat.active {
        background: var(--primary-color);      
        border-color: var(--primary-color);
        color: white;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
    }
    
    .btn-cat.active:hover {
        background: var(--primary-hover);      
        border-color: var(--primary-hover);
        transform: translateY(-3px);
    }

    .product-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        padding: 10px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-color);
    }

    .card-img-wrapper {
        border-radius: 12px;
        overflow: hidden;
        background: #f8fafc;
        aspect-ratio: 1/1;
        margin-bottom: 10px;
        position: relative;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .card-img-wrapper img { transform: scale(1.05); }

    .product-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 4px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .price-text {
        color: var(--primary-color);
        font-weight: 800;
        font-size: 1rem;
    }
    
    .store-badge {
        font-size: 0.75rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 4px;
    }
</style>

<div class="container-xl py-3">
    <div class="main-canvas">
        
        <div id="heroBannerCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroBannerCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroBannerCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroBannerCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active bg-slide-1">
                    <div class="carousel-content-wrapper">
                        <div class="row w-100 m-0 align-items-center">
                            <div class="col-md-7 ps-md-5">
                                <span class="badge bg-white text-primary mb-2 px-3 py-1 rounded-pill shadow-sm fw-bold">👋 Selamat Datang</span>
                                <h2 class="fw-bold text-dark mb-2">Belanja Kebutuhan Kuliah?</h2>
                                <p class="text-secondary mb-3">Temukan barang berkualitas dari sesama mahasiswa.</p>
                                <button class="btn btn-primary rounded-pill px-4 py-2 btn-sm fw-bold shadow-sm">Lihat Katalog</button>
                            </div>
                            <div class="col-md-5 d-none d-md-block text-center">
                                 <i class="bi bi-cart4 text-primary" style="font-size: 6rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item bg-slide-2">
                    <div class="carousel-content-wrapper">
                        <div class="row w-100 m-0 align-items-center">
                            <div class="col-md-7 ps-md-5">
                                <span class="badge bg-warning text-dark mb-2 px-3 py-1 rounded-pill shadow-sm fw-bold">⚡ Promo Kilat</span>
                                <h2 class="fw-bold text-dark mb-2">Buku Bekas Murah!</h2>
                                <p class="text-secondary mb-3">Diskon spesial untuk buku semester ganjil.</p>
                                <button class="btn btn-warning text-white fw-bold rounded-pill px-4 py-2 btn-sm shadow-sm">Cek Sekarang</button>
                            </div>
                            <div class="col-md-5 d-none d-md-block text-center">
                                <i class="bi bi-book text-warning" style="font-size: 6rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="carousel-item bg-slide-3">
                    <div class="carousel-content-wrapper">
                        <div class="row w-100 m-0 align-items-center">
                            <div class="col-md-7 ps-md-5">
                                <span class="badge bg-success text-white mb-2 px-3 py-1 rounded-pill shadow-sm fw-bold">🛠️ Jasa Mahasiswa</span>
                                <h2 class="fw-bold text-dark mb-2">Butuh Servis Laptop?</h2>
                                <p class="text-secondary mb-3">Cari teman yang jago servis di sini.</p>
                                <button class="btn btn-success rounded-pill px-4 py-2 btn-sm fw-bold shadow-sm">Cari Jasa</button>
                            </div>
                            <div class="col-md-5 d-none d-md-block text-center">
                                <i class="bi bi-laptop text-success" style="font-size: 6rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroBannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroBannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="mb-4">
            <div class="d-flex align-items-center mb-3">
                <h5 class="fw-bold m-0 text-dark">Kategori Pilihan</h5>
            </div>
            
            <div class="category-scroll" id="categoryWrapper">
                <button class="btn-cat active" onclick="setActive(this)">Semua</button>
                
                @foreach($categories as $cat)
                    <button class="btn-cat" onclick="setActive(this)">{{ $cat->name }}</button>
                @endforeach
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            @forelse($products as $product)
                <div class="col">
                    <div class="product-card">
                        
                        <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                            <div class="card-img-wrapper">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                            </div>
                        </a>

                        <div class="d-flex flex-column h-100">
                            <div class="store-badge mb-1">
                                <i class="bi bi-shop"></i> {{ $product->store->name ?? 'Official' }}
                            </div>
                            
                            <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                                <h6 class="product-title">{{ $product->name }}</h6>
                            </a>

                            <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
                                <div class="price-text">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png" alt="Kosong" style="width: 150px; opacity: 0.5;">
                    <p class="text-muted mt-3 fw-bold">Belum ada produk saat ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>

<script>
    function setActive(button) {
        const buttons = document.querySelectorAll('.btn-cat');
        buttons.forEach(btn => btn.classList.remove('active'));

        button.classList.add('active');
    }
</script>

@endsection