@extends('layouts.front')

@section('title', $product->name)

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 md:p-10 relative overflow-hidden">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16" 
             x-data="{ activeImage: '{{ asset('storage/' . $product->thumbnail) }}' }">
            
            <div class="space-y-4">
                <div class="bg-slate-50 rounded-2xl border border-slate-100 overflow-hidden aspect-[4/3] flex items-center justify-center relative">
                    <img :src="activeImage" alt="{{ $product->name }}" 
                         class="max-w-full max-h-full object-contain transition-opacity duration-300 ease-in-out"
                         x-transition:enter="opacity-0"
                         x-transition:enter-end="opacity-100">
                </div>

                <div class="flex gap-3 overflow-x-auto hide-scroll py-2">
                    <button @click="activeImage = '{{ asset('storage/' . $product->thumbnail) }}'" 
                            class="flex-shrink-0 w-20 h-20 rounded-xl border-2 overflow-hidden bg-slate-50 transition-colors duration-200"
                            :class="activeImage === '{{ asset('storage/' . $product->thumbnail) }}' 
                                ? 'border-primary ring-1 ring-primary/20' 
                                : 'border-transparent hover:border-slate-300'">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" class="w-full h-full object-cover">
                    </button>

                    @foreach($product->images as $img)
                        <button @click="activeImage = '{{ asset('storage/' . $img->image) }}'" 
                                class="flex-shrink-0 w-20 h-20 rounded-xl border-2 overflow-hidden bg-slate-50 transition-colors duration-200"
                                :class="activeImage === '{{ asset('storage/' . $img->image) }}' 
                                    ? 'border-primary ring-1 ring-primary/20' 
                                    : 'border-transparent hover:border-slate-300'">
                            <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col h-full">
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-50 text-primary rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                        <i class="fa-solid fa-tag"></i> {{ $product->category->name ?? 'Umum' }}
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight mb-3">
                        {{ $product->name }}
                    </h1>
                    
                    <div class="flex items-center gap-3 pb-6 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-bold uppercase tracking-wide">Dijual oleh</p>
                            <p class="text-slate-800 font-bold text-sm">{{ $product->store->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <span class="block text-sm text-slate-500 font-medium mb-1">Harga Terbaik</span>
                    <div class="text-4xl font-extrabold text-primary flex items-baseline gap-1">
                        <span class="text-2xl">Rp</span>{{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 mb-8">
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-center transition-colors hover:border-primary/30 hover:bg-indigo-50/30">
                        <div class="text-xs text-slate-500 uppercase font-bold mb-1">Kondisi</div>
                        <div class="text-slate-800 font-extrabold capitalize">{{ $product->condition }}</div>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-center transition-colors hover:border-primary/30 hover:bg-indigo-50/30">
                        <div class="text-xs text-slate-500 uppercase font-bold mb-1">Berat</div>
                        <div class="text-slate-800 font-extrabold">{{ $product->weight }} <span class="text-xs font-normal text-slate-500">gr</span></div>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-center transition-colors hover:border-primary/30 hover:bg-indigo-50/30">
                        <div class="text-xs text-slate-500 uppercase font-bold mb-1">Stok</div>
                        <div class="text-slate-800 font-extrabold">{{ $product->stock }}</div>
                    </div>
                </div>

                <div class="mb-10">
                    <h3 class="text-lg font-bold text-slate-900 mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-align-left text-primary"></i> Deskripsi Produk
                    </h3>
                    <div class="prose prose-slate prose-sm max-w-none text-slate-600 leading-relaxed bg-slate-50 p-5 rounded-2xl border border-slate-100">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                <div class="mt-auto grid grid-cols-2 gap-4 pt-6 border-t border-slate-100">
                    @auth
                        <form action="#" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full px-6 py-4 rounded-full font-bold text-slate-700 border border-slate-200 hover:border-primary hover:text-primary hover:bg-indigo-50 transition-all duration-200 flex items-center justify-center gap-2 group">
                                <i class="fa-solid fa-cart-plus text-slate-400 group-hover:text-primary transition-colors"></i> 
                                <span>Keranjang</span>
                            </button>
                        </form>
                        
                        <button class="px-6 py-4 rounded-full font-bold text-white bg-primary hover:bg-primary-dark shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2">
                            <span>Beli Sekarang</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-4 rounded-full font-bold text-slate-700 border border-slate-200 hover:border-primary hover:text-primary hover:bg-indigo-50 transition-all duration-200 flex items-center justify-center gap-2 group text-center">
                            <i class="fa-solid fa-cart-plus text-slate-400 group-hover:text-primary transition-colors"></i> 
                            <span>Keranjang</span>
                        </a>
                        
                        <a href="{{ route('login') }}" class="px-6 py-4 rounded-full font-bold text-white bg-primary hover:bg-primary-dark shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2 text-center">
                            <span>Beli Sekarang</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-slate-600 transition-all bg-white border border-slate-200 rounded-full shadow-sm hover:bg-white hover:text-primary hover:border-primary hover:shadow-md group">
            <i class="fa-solid fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> 
            Kembali ke Katalog
        </a>
    </div>

</div>

@endsection