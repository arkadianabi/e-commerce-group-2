<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Online') - Mahasiswa Store</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #4f46e5;     
            --primary-hover: #4338ca;       
            --primary-subtle: #e0e7ff;      
            --text-dark: #0f172a;
            --text-gray: #64748b;
            --bg-body: #f8fafc;
        }

        body, .navbar-brand, .nav-link, h1, h2, h3, h4, h5, h6, p, span, small, button, a {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--text-dark) !important;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 600;
            color: var(--text-gray) !important;
            margin: 0 4px;
            transition: all 0.2s;
            font-size: 0.95rem;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        .btn-nav {
            padding: 8px 24px !important;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-nav-login {
            background: white;
            border: 2px solid #e2e8f0;
            color: var(--text-dark) !important;
        }

        .btn-nav-login:hover {
            background-color: var(--primary-subtle); 
            border-color: var(--primary-color);     
            color: var(--primary-color) !important;  
            transform: translateY(-2px);            
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        }

        .btn-nav-register {
            background: var(--primary-color);
            border: 2px solid var(--primary-color);
            color: white !important;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
        }

        .btn-nav-register:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            color: white !important;                 
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        }

        footer {
            background: white;
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
            padding: 1.5rem 0;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-xl"> 
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <i class="bi bi-bag-heart-fill" style="color: var(--primary-color); font-size: 1.4rem;"></i>
                MahasiswaStore.
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2"> <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="#">Katalog</a>
                    </li>

                    @auth
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle fw-bold text-dark bg-light rounded-pill px-3 border" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 mt-2 p-2" style="font-size: 0.9rem;">
                                <li><a class="dropdown-item rounded-3 py-2" href="{{ route('dashboard') }}"><i class="bi bi-grid me-2"></i> Dashboard</a></li>
                                <li><a class="dropdown-item rounded-3 py-2" href="#"><i class="bi bi-cart me-2"></i> Keranjang</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item rounded-3 text-danger fw-bold py-2">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn-nav btn-nav-login" href="{{ route('login') }}">
                                Masuk
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="btn-nav btn-nav-register" href="{{ route('register') }}">
                                Daftar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container-xl text-center">
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-1 gap-md-3">
                <span class="fw-bold text-dark">MahasiswaStore &copy; {{ date('Y') }}</span>
                <span class="d-none d-md-block text-muted">|</span>
                <span class="text-secondary">Tugas Praktikum Pemrograman Web - FILKOM</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>