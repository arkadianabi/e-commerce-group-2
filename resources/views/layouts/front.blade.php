<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Online') - Tech Store</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        'primary-dark': '#4338ca',
                        'primary-light': '#e0e7ff',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        html { scroll-behavior: smooth; } 
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        .snap-x-mandatory { scroll-snap-type: x mandatory; }
        .snap-center { scroll-snap-align: center; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen">

    <nav x-data="{ mobileMenuOpen: false }" class="bg-white/90 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="font-extrabold text-xl tracking-tight text-slate-900">
                        Tech<span class="text-primary">Store.</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-semibold {{ request()->routeIs('home') && !request()->has('category') ? 'text-primary' : 'text-slate-600 hover:text-primary' }} transition-colors">Beranda</a>
                    
                    <a href="{{ route('home') }}#katalog" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">Katalog</a>
                    
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-2 text-sm font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-full transition-colors">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>

                            <div x-show="open" 
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-1" 
                                 style="display: none;">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-primary hover:bg-primary-light/50 px-4 py-2 rounded-full border border-slate-200 hover:border-primary transition-colors">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-primary hover:bg-primary-dark px-5 py-2 rounded-full shadow-md hover:shadow-lg transition-colors">
                                Daftar
                            </a>
                        </div>
                    @endauth
                </div>

                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-600 hover:text-primary p-2">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" class="md:hidden bg-white border-t border-slate-100 p-4 space-y-3 shadow-lg" style="display: none;">
            <a href="{{ route('home') }}" class="block font-semibold text-primary">Beranda</a>
            <a href="{{ route('home') }}#katalog" class="block font-semibold text-slate-600">Katalog</a>
            @auth
                <div class="pt-3 border-t border-slate-100">
                    <div class="font-bold text-slate-800 mb-2">{{ Auth::user()->name }}</div>
                    <a href="{{ route('dashboard') }}" class="block py-2 text-sm text-slate-600">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="block py-2 text-sm text-red-600 font-bold">Logout</button>
                    </form>
                </div>
            @else
                <div class="pt-3 flex flex-col gap-2">
                    <a href="{{ route('login') }}" class="w-full text-center py-2 rounded-lg border border-slate-200 font-bold text-slate-700 hover:bg-slate-50">Masuk</a>
                    <a href="{{ route('register') }}" class="w-full text-center py-2 rounded-lg bg-primary text-white font-bold hover:bg-primary-dark">Daftar</a>
                </div>
            @endauth
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-8 mt-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-500 text-sm font-medium">
                &copy; {{ date('Y') }} <span class="text-primary font-bold">Tech Store</span>.
            </p>
        </div>
    </footer>

</body>
</html>