<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HRide - Layanan Kredit Motor</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('front-end/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('front-end/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('front-end/css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('front-end/img/car-1.png') }}">
</head>

<body class="animsition" id="body" style="background-color: #ffffff;">


    <div class="container-fluid topbar bg-secondary d-none d-xl-block w-100">
        <div class="container">
            <div class="row gx-0 align-items-center" style="height: 45px;">
                <div class="col-lg-6 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="https://www.google.com/maps" target="_blank" class="text-muted me-4">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location
                        </a>
                        <a href="tel:+62812345678" class="text-muted me-4">
                            <i class="fas fa-phone-alt text-primary me-2"></i>+628 1234 5678
                        </a>
                        <a href="mailto:hrideofficial@gmail.com" class="text-muted me-0">
                            <i class="fas fa-envelope text-primary me-2"></i>hrideofficial@gmail.com
                        </a>
                    </div>                    
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-light btn-sm-square rounded-circle me-0"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="{{ route('home.index') }}" class="navbar-brand p-0">
                    <h1 class="display-6 text-primary"><i class="fas fa-motorcycle me-3"></i>HRide</h1>
                </a>                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto py-0">
                        <li class="nav-item {{ Request::routeIs('home.index*') ? 'active' : '' }}">
                            <a href="{{ route('home.index') }}"
                               class="nav-link {{ Request::routeIs('home.index*') ? 'text-primary' : '' }}">Home</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('product.*') ? 'active' : '' }}">
                            <a href="{{ route('product.index') }}"
                               class="nav-link {{ Request::routeIs('product.*') ? 'text-primary' : '' }}">Product</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('about.index*') ? 'active' : '' }}">
                            <a href="{{ route('about.index') }}"
                               class="nav-link {{ Request::routeIs('about.index*') ? 'text-primary' : '' }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="service.html" class="nav-link">Service</a>
                        </li>
                        <li class="nav-item">
                            <a href="blog.html" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.html" class="nav-link">Contact</a>
                        </li>
                    </ul>
    
                    <!-- Authenticated User Dropdown -->
                    @auth('pelanggan')
                    <div class="dropdown">
                        <button class="btn btn-primary rounded-pill py-2 px-4 dropdown-toggle d-flex align-items-center"
                                type="button" id="pelangganMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::guard('pelanggan')->user()->foto_profil)
                                <img src="{{ asset('storage/' . Auth::guard('pelanggan')->user()->foto_profil) }}"
                                     alt="Foto Profil" class="rounded-circle me-2"
                                     style="width: 30px; height: 30px; object-fit: cover;">
                            @else
                                <i class="fas fa-user-circle fa-lg me-2"></i>
                            @endif
                            {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="pelangganMenu">
                            <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengajuan_kredit.saya') }}">Pengajuan Kredit</a></li>
                            <li><a class="dropdown-item" href="{{ route('kredit.saya') }}">Kredit Saya</a></li>  
                            <li><a class="dropdown-item" href="{{ route('pengiriman.saya') }}">Pengiriman</a></li>
                            <li>
                                <form action="{{ route('pelanggan.auth.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth

                    @guest('pelanggan')
                    <a href="{{ route('pelanggan.auth.login') }}" class="btn btn-primary rounded-pill py-2 px-4">Get Started</a>
                @endguest
                
                </div>
            </nav>
        </div>
    </div>
    

    @yield('content')
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- About Section -->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Tentang Hride</h4>
                        <p class="mb-3">Hride adalah platform kredit motor terpercaya yang membantu Anda memiliki motor impian dengan mudah dan cepat.</p>
                        <div class="position-relative">
                            <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Masukkan email Anda">
                            <button type="button"
                                class="btn btn-secondary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">Langganan</button>
                        </div>
                    </div>
                </div>
    
                <!-- Quick Links -->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Tautan Cepat</h4>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Tentang Kami</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Daftar Motor</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Pengajuan Kredit</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Kontak</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Syarat & Ketentuan</a>
                    </div>
                </div>
    
                <!-- Business Hours -->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Jam Operasional</h4>
                        <p class="mb-2"><strong>Senin - Jumat:</strong> 08.00 - 17.00</p>
                        <p class="mb-2"><strong>Sabtu:</strong> 09.00 - 14.00</p>
                        <p class="mb-2"><strong>Minggu:</strong> Libur</p>
                    </div>
                </div>
    
                <!-- Contact Info -->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Kontak Kami</h4>
                        <a href="#"><i class="fa fa-map-marker-alt me-2"></i> Jl. Merdeka No.123, Jakarta, Indonesia</a>
                        <a href="mailto:cs@hride.id"><i class="fas fa-envelope me-2"></i> cs@hride.id</a>
                        <a href="tel:+6281234567890"><i class="fas fa-phone me-2"></i> +62 812 3456 7890</a>
                        <a href="#"><i class="fas fa-print me-2"></i> +62 21 1234 5678</a>
                        <div class="d-flex mt-3">
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href="#"><i
                                    class="fab fa-facebook-f text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href="#"><i
                                    class="fab fa-twitter text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href="#"><i
                                    class="fab fa-instagram text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-0" href="#"><i
                                    class="fab fa-linkedin-in text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-body"><a href="#" class="border-bottom text-white">
                        <i class="fas fa-copyright text-light me-2"></i>
                        Hride
                    </a>, Semua Hak Dilindungi.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-body">
                    Dikembangkan oleh <a class="border-bottom text-white" href="#">Tim Hride Dev</a>
                </div>
            </div>
        </div>
    </div>
    
    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front-end/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('front-end/js/main.js') }}"></script>
    @stack('scripts')

</body>

</html>

