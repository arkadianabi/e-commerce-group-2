@extends('layouts.front')

@section('title', $product->name)

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="bg-white rounded-2xl shadow-lg shadow-indigo-50/50 border border-slate-100 p-6 md:p-8 relative overflow-hidden">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12" 
             x-data="{ activeImage: '{{ asset('storage/' . $product->thumbnail) }}' }">
            
            <div class="space-y-4">
                <div class="bg-slate-50 rounded-xl border border-slate-100 overflow-hidden aspect-square flex items-center justify-center relative">
                    <img :src="activeImage" alt="{{ $product->name }}" 
                         class="max-w-[85%] max-h-[85%] object-contain transition-opacity duration-300 ease-in-out"
                         x-transition:enter="opacity-0"
                         x-transition:enter-end="opacity-100">
                </div>

                <div class="flex gap-3 overflow-x-auto hide-scroll py-1 justify-center md:justify-start">
                    <button @click="activeImage = '{{ asset('storage/' . $product->thumbnail) }}'" 
                            class="flex-shrink-0 w-20 h-20 rounded-lg border-2 overflow-hidden bg-slate-50 transition-colors duration-200"
                            :class="activeImage === '{{ asset('storage/' . $product->thumbnail) }}' 
                                ? 'border-primary ring-2 ring-primary/10' 
                                : 'border-slate-100 hover:border-slate-300'">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" class="w-full h-full object-cover p-1">
                    </button>

                    @foreach($product->images as $img)
                        @if($img->image !== $product->thumbnail) 
                            <button @click="activeImage = '{{ asset('storage/' . $img->image) }}'" 
                                    class="flex-shrink-0 w-20 h-20 rounded-lg border-2 overflow-hidden bg-slate-50 transition-colors duration-200"
                                    :class="activeImage === '{{ asset('storage/' . $img->image) }}' 
                                        ? 'border-primary ring-2 ring-primary/10' 
                                        : 'border-slate-100 hover:border-slate-300'">
                                <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover p-1">
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col h-full py-1">
                
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-bold text-primary uppercase tracking-widest mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                        {{ $product->category->name ?? 'Umum' }}
                    </div>
                    
                    <h1 class="text-2xl md:text-4xl font-extrabold text-slate-900 leading-tight mb-4">
                        {{ $product->name }}
                    </h1>
                    
                    <div class="flex items-center gap-3 border-b border-slate-100 pb-5">
                        <div class="bg-gradient-to-br from-primary to-purple-600 text-white w-9 h-9 rounded-lg flex items-center justify-center shadow-md shadow-primary/30">
                            <i class="fa-solid fa-bag-shopping text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Official Store</p>
                            <p class="text-sm font-bold text-slate-800">{{ $product->store->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Harga Spesial</p>
                    <div class="text-3xl md:text-4xl font-black text-primary">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 mb-6">
                    <div class="p-3 rounded-xl border border-slate-100 text-center bg-slate-50/50">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kondisi</p>
                        <p class="text-sm font-bold text-slate-900 capitalize">{{ $product->condition }}</p>
                    </div>
                    <div class="p-3 rounded-xl border border-slate-100 text-center bg-slate-50/50">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Berat</p>
                        <p class="text-sm font-bold text-slate-900">{{ $product->weight }} gr</p>
                    </div>
                    <div class="p-3 rounded-xl border border-slate-100 text-center bg-slate-50/50">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Stok</p>
                        <p class="text-sm font-bold text-slate-900">{{ $product->stock }}</p>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-base font-bold text-slate-900 mb-2">Deskripsi Produk</h3>
                    <div class="prose prose-slate prose-sm max-w-none text-slate-600 leading-relaxed text-sm">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                <div class="mt-auto grid grid-cols-2 gap-3">
                    @auth
                        <form action="#" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full px-5 py-3 rounded-xl font-bold text-slate-700 border-2 border-slate-200 hover:border-primary hover:text-primary bg-white transition-colors duration-200 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-cart-plus"></i> 
                                <span>Keranjang</span>
                            </button>
                        </form>
                        
                        <button class="px-5 py-3 rounded-xl font-bold text-white bg-primary hover:bg-primary-dark shadow-lg shadow-indigo-500/30 transition-colors duration-200 flex items-center justify-center gap-2">
                            <span>Beli Sekarang</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-3 rounded-xl font-bold text-slate-700 border-2 border-slate-200 hover:border-primary hover:text-primary bg-white transition-colors duration-200 flex items-center justify-center gap-2 text-center">
                            <i class="fa-solid fa-cart-plus"></i> 
                            <span>Keranjang</span>
                        </a>
                        
                        <a href="{{ route('login') }}" class="px-5 py-3 rounded-xl font-bold text-white bg-primary hover:bg-primary-dark shadow-lg shadow-indigo-500/30 transition-colors duration-200 flex items-center justify-center gap-2 text-center">
                            <span>Beli Sekarang</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-start">
        <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-slate-700 transition-colors bg-white border-2 border-slate-200 hover:border-primary hover:text-primary rounded-xl shadow-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> 
            Kembali ke Katalog
        </a>
    </div>

</div>

@endsection