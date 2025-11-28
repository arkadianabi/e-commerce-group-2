@extends('layouts.front')

@section('title', $product->name)

@section('content')

<style>
    :root {
        --primary-color: #4f46e5;      
        --primary-hover: #4338ca;       
        --primary-subtle: #e0e7ff;     
        --text-dark: #0f172a;
        --text-gray: #64748b;
    }

    body, h1, h2, h3, h4, p, div, span, button, a {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    .main-canvas {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05); 
        padding: 2.5rem;
        margin-top: 1.5rem;
        margin-bottom: 2rem;
    }

    .img-display-area {
        background: #f8fafc;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 420px;
        border: 1px solid #f1f5f9;
        position: relative;
        overflow: hidden;
    }

    .img-display-area img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    
    .img-display-area:hover img {
        transform: scale(1.05);
    }

    .thumb-scroll {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding: 4px;
        scrollbar-width: none;
    }
    .thumb-scroll::-webkit-scrollbar { display: none; }

    .thumb-item {
        width: 72px;
        height: 72px;
        border-radius: 14px;
        cursor: pointer;
        border: 2px solid transparent;
        background: #f1f5f9;
        object-fit: cover;
        opacity: 0.6;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .thumb-item:hover {
        border-color: var(--primary-color);
        opacity: 1;
        transform: translateY(-3px);
    }

    .thumb-item.active {
        border-color: var(--primary-color);
        opacity: 1;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .cat-badge {
        background: var(--primary-subtle);
        color: var(--primary-color);
        font-weight: 700;
        font-size: 0.75rem;
        padding: 6px 14px;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        margin-bottom: 12px;
    }

    .prod-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.25;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
    }

    .price-big {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--primary-color);
        letter-spacing: -1px;
        margin-bottom: 1.5rem;
    }

    .specs-box {
        display: flex;
        gap: 0; 
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .spec-item {
        flex: 1;
        text-align: center;
        padding: 1rem;
        border-right: 1px solid #e2e8f0;
        background: #f8fafc;
    }
    .spec-item:last-child { border-right: none; }

    .spec-item small {
        display: block;
        color: var(--text-gray);
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .spec-item span {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 1rem;
    }

    .btn-action-wrapper {
        display: flex;
        gap: 16px;
        margin-top: 2rem;
    }

    .btn-action {
        flex: 1;
        padding: 14px 0;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); 
        position: relative;
    }

    .btn-outline-custom {
        background: white;
        border: 2px solid #e2e8f0;
        color: var(--text-dark);
    }

    .btn-outline-custom:hover {
        background-color: var(--primary-subtle); 
        border-color: var(--primary-color);
        color: var(--primary-color) !important; 
        transform: translateY(-3px); 
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15); 
    }

    .btn-primary-custom {
        background: var(--primary-color);
        border: 2px solid var(--primary-color);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .btn-primary-custom:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        color: white !important; 
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4); 
    }

    .desc-box p {
        color: var(--text-gray);
        line-height: 1.7;
        font-size: 0.95rem;
    }
</style>

<div class="container-xl">
    <div class="main-canvas">
        <div class="row g-5">
            
            <div class="col-lg-6">
                <div class="img-display-area">
                    <img id="mainViewer" src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                </div>
                
                <div class="thumb-scroll">
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" 
                         class="thumb-item active" 
                         onclick="switchImage(this.src, this)">

                    @foreach($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image) }}" 
                             class="thumb-item" 
                             onclick="switchImage(this.src, this)">
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ps-lg-3">
                    <span class="cat-badge">{{ $product->productCategory->name }}</span>
                    
                    <h1 class="prod-title">{{ $product->name }}</h1>
                    
                    <div class="price-big">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <div class="specs-box">
                        <div class="spec-item">
                            <small>Kondisi</small>
                            <span class="text-capitalize">{{ $product->condition }}</span>
                        </div>
                        <div class="spec-item">
                            <small>Berat</small>
                            <span>{{ $product->weight }} gr</span>
                        </div>
                        <div class="spec-item">
                            <small>Stok</small>
                            <span>{{ $product->stock }}</span>
                        </div>
                    </div>

                    <div class="desc-box">
                        <h5 class="fw-bold mb-3 text-dark">Deskripsi Produk</h5>
                        <p class="text-justify">
                            {{ $product->description }}
                        </p>
                    </div>

                    <form action="#" method="POST">
                        @csrf
                        <div class="btn-action-wrapper">
                            <button type="submit" class="btn btn-outline-custom btn-action">
                                <i class="bi bi-cart-plus"></i> Keranjang
                            </button>
                            
                            <button type="button" class="btn btn-primary-custom btn-action">
                                Beli Sekarang
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchImage(src, element) {
        // Ganti gambar utama
        document.getElementById('mainViewer').src = src;
        
        // Hapus active dari semua thumbnail
        document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
        
        // Tambah active ke yang diklik
        element.classList.add('active');
    }
</script>

@endsection