@extends('layouts.front')

@section('title', 'Beranda')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    
    <div class="relative mb-10 group" x-data="{ activeSlide: 0 }">
        
        <div class="flex overflow-x-auto snap-x-mandatory hide-scroll rounded-3xl shadow-xl space-x-0 bg-white border border-slate-100"
             x-ref="slider"
             @scroll.debounce.10ms="activeSlide = Math.round($el.scrollLeft / $el.clientWidth)">
            
            <div class="min-w-full snap-center bg-gradient-to-r from-primary to-indigo-600 h-[320px] flex items-center p-8 md:p-12 text-white relative overflow-hidden">
                <div class="relative z-10 max-w-lg space-y-4">
                    <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold border border-white/30">👋 Selamat Datang</span>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">Jual Beli Barang <br> Kebutuhan Kuliah</h1>
                    <p class="text-indigo-100">Platform transaksi aman antar mahasiswa kampus.</p>
                </div>
                <div class="absolute right-0 top-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-10 -mt-10"></div>
            </div>

            <div class="min-w-full snap-center bg-gradient-to-r from-orange-500 to-amber-500 h-[320px] flex items-center p-8 md:p-12 text-white relative overflow-hidden">
                <div class="relative z-10 max-w-lg space-y-4">
                    <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold border border-white/30">⚡ Promo Kilat</span>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">Buku Bekas <br> Harga Pas</h1>
                    <p class="text-orange-100">Cari buku semester lalu dengan harga miring di sini.</p>
                </div>
            </div>

            <div class="min-w-full snap-center bg-gradient-to-r from-emerald-500 to-teal-500 h-[320px] flex items-center p-8 md:p-12 text-white relative overflow-hidden">
                <div class="relative z-10 max-w-lg space-y-4">
                    <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold border border-white/30">🛠️ Jasa Mahasiswa</span>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">Servis Laptop <br> & Jasa Print</h1>
                    <p class="text-emerald-100">Dukung usaha teman sendiri, harga lebih bersahabat.</p>
                </div>
            </div>

        </div>
        
        <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-2 z-10">
            <button class="h-2 rounded-full transition-all duration-300 shadow-sm"
                    :class="activeSlide === 0 ? 'w-8 bg-white' : 'w-2 bg-white/60 hover:bg-white'"
                    @click="$refs.slider.scrollTo({ left: 0, behavior: 'smooth' })">
            </button>
            
            <button class="h-2 rounded-full transition-all duration-300 shadow-sm"
                    :class="activeSlide === 1 ? 'w-8 bg-white' : 'w-2 bg-white/60 hover:bg-white'"
                    @click="$refs.slider.scrollTo({ left: $refs.slider.clientWidth, behavior: 'smooth' })">
            </button>
            
            <button class="h-2 rounded-full transition-all duration-300 shadow-sm"
                    :class="activeSlide === 2 ? 'w-8 bg-white' : 'w-2 bg-white/60 hover:bg-white'"
                    @click="$refs.slider.scrollTo({ left: $refs.slider.clientWidth * 2, behavior: 'smooth' })">
            </button>
        </div>
    </div>

    <div id="katalog" class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 md:p-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <h2 class="text-2xl font-bold text-slate-800">Katalog Terbaru</h2>
            
            <div class="flex gap-2 overflow-x-auto hide-scroll pb-2">
                <a href="{{ route('home') }}" 
                   class="whitespace-nowrap px-5 py-2 rounded-full font-bold text-sm border transition-colors duration-200
                   {{ !request('category') 
                      ? 'bg-primary text-white border-primary shadow-md hover:bg-primary-dark' 
                      : 'bg-white text-slate-600 border-slate-200 hover:border-primary hover:text-primary hover:bg-slate-50' }}">
                   Semua
                </a>
                
                @foreach($categories as $cat)
                    <a href="{{ route('home', ['category' => $cat->slug]) }}" 
                       class="whitespace-nowrap px-5 py-2 rounded-full font-bold text-sm border transition-colors duration-200
                       {{ request('category') == $cat->slug 
                          ? 'bg-primary text-white border-primary shadow-md hover:bg-primary-dark' 
                          : 'bg-white text-slate-600 border-slate-200 hover:border-primary hover:text-primary hover:bg-slate-50' }}">
                       {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <a href="{{ route('product.detail', $product->slug) }}" class="group block h-full">
                    <div class="bg-white border border-slate-100 rounded-2xl p-3 h-full transition-all duration-300 hover:shadow-xl hover:shadow-slate-200/50 hover:border-primary/50 flex flex-col">
                        
                        <div class="bg-slate-50 rounded-xl overflow-hidden aspect-square mb-3 relative flex items-center justify-center">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            
                            <div class="absolute bottom-2 left-2 bg-white/95 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold text-slate-700 shadow-sm flex items-center gap-1">
                                <i class="fa-solid fa-store text-primary"></i> {{ $product->store->name ?? 'Official' }}
                            </div>
                        </div>

                        <div class="px-1 flex flex-col flex-grow">
                            <div class="text-xs font-bold text-primary uppercase tracking-wider mb-1">{{ $product->productCategory->name }}</div>
                            <h3 class="font-bold text-slate-800 leading-snug mb-1 line-clamp-2 group-hover:text-primary transition-colors">
                                {{ $product->name }}
                            </h3>
                            <div class="mt-auto pt-2 flex items-center justify-between">
                                <span class="text-lg font-extrabold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-primary group-hover:text-white transition-colors">
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-16 text-center">
                    <div class="inline-flex bg-slate-50 p-4 rounded-full mb-4">
                        <i class="fa-solid fa-box-open text-4xl text-slate-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-700">Belum ada produk</h3>
                    <p class="text-slate-500">Silakan cek kategori lain.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>

@endsection