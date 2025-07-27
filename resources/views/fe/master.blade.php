<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HRide - Layanan Kredit Motor</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="icon" href="{{ asset('front-end/img/hride.png') }}">
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
                    <a href="https://wa.me/62812345678" target="_blank" class="text-light me-4 d-flex align-items-center">
                        <i class="fab fa-whatsapp text-success me-2"></i>Chat via WhatsApp
                    </a>
                    <a href="mailto:hrideofficial@gmail.com" class="text-light d-flex align-items-center">
                        <i class="fas fa-paper-plane text-primary me-2"></i>Kirim Email
                    </a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Logo -->
            <a href="{{ route('home.index') }}" class="navbar-brand d-flex align-items-center p-0">
                <img src="{{ asset('front-end/img/hride.png') }}" alt="HRide Logo" style="height: 40px; width: auto; margin-right: 10px;">
                <span class="fw-bold text-primary h4 mb-0">Motor</span>
            </a>

            <!-- Toggle Button (Mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto py-0">
                    <li class="nav-item {{ Request::routeIs('home.index*') ? 'active' : '' }}">
                        <a href="{{ route('home.index') }}" class="nav-link {{ Request::routeIs('home.index*') ? 'text-primary' : '' }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('product.*') ? 'active' : '' }}">
                        <a href="{{ route('product.index') }}" class="nav-link {{ Request::routeIs('product.*') ? 'text-primary' : '' }}">Motor</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('about.index*') ? 'active' : '' }}">
                        <a href="{{ route('about.index') }}" class="nav-link {{ Request::routeIs('about.index*') ? 'text-primary' : '' }}">About</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('service.index*') ? 'active' : '' }}">
                        <a href="{{ route('service.index') }}" class="nav-link {{ Request::routeIs('service.index*') ? 'text-primary' : '' }}">Service</a>
                    </li>
                </ul>

                <!-- Notifikasi (jika login) -->
         @auth('pelanggan')
<li class="nav-item dropdown me-3 position-relative">
    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell fa-lg text-dark position-relative">
            @if(Auth::guard('pelanggan')->user()->unreadNotifications->count())
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger animate__animated animate__bounceIn">
                    {{ Auth::guard('pelanggan')->user()->unreadNotifications->count() }}
                </span>
            @endif
        </i>
    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-2 mt-2" aria-labelledby="notifDropdown" style="min-width: 320px;">
        <li class="px-3 py-2 border-bottom">
            <h6 class="mb-0 fw-bold text-primary">🔔 Notifikasi Terbaru</h6>
        </li>

        @forelse(Auth::guard('pelanggan')->user()->notifications->take(5) as $notification)
    <li class="d-flex justify-content-between align-items-start notification-item px-2" data-id="{{ $notification->id }}">
        <a class="dropdown-item flex-grow-1 d-flex flex-column gap-1 py-2 px-0" href="#">
            <span class="fw-semibold text-dark">{{ $notification->data['title'] }}</span>
            <small class="text-muted">{{ $notification->data['message'] }}</small>
        </a>
        <button class="btn btn-sm btn-link text-danger p-0 btn-delete-notification" title="Hapus">
            &times;
        </button>
    </li>
@empty
    <li>
        <span class="dropdown-item text-muted text-center py-2">Tidak ada notifikasi</span>
    </li>
@endforelse


        <li><hr class="dropdown-divider"></li>
        {{-- <li>
            <a href="#" class="dropdown-item text-center text-primary fw-semibold">Lihat Semua Notifikasi</a>
        </li> --}}
    </ul>
</li>
@endauth

                <!-- Dropdown Akun (jika login) -->
              @auth('pelanggan')
<div class="dropdown">
    <button class="btn btn-light border rounded-pill px-3 py-2 d-flex align-items-center gap-2 shadow-sm"
            type="button" id="pelangganMenu" data-bs-toggle="dropdown" aria-expanded="false"
            style="min-width: 180px;">
        @if(Auth::guard('pelanggan')->user()->foto)
            <img src="{{ asset('storage/' . Auth::guard('pelanggan')->user()->foto) }}"
                 alt="Foto Profil" class="rounded-circle"
                 style="width: 35px; height: 35px; object-fit: cover;">
        @else
            <i class="fas fa-user-circle fa-2x text-secondary"></i>
        @endif
        <div class="d-flex flex-column align-items-start">
            <span class="fw-semibold text-dark" style="font-size: 0.95rem;">{{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</span>
            <small class="text-muted" style="font-size: 0.75rem;">Pelanggan</small>
        </div>
        <i class="fas fa-chevron-down text-muted ms-auto"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-2 py-2" aria-labelledby="pelangganMenu" style="min-width: 220px;">
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('pelanggan.edit', Auth::guard('pelanggan')->user()->id) }}">
                <i class="fas fa-user text-primary"></i>
                Profil Saya
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('pengajuan_kredit.saya') }}">
                <i class="fas fa-edit text-success"></i>
                Pengajuan Kredit
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('kredit.saya') }}">
                <i class="fas fa-money-check-alt text-info"></i>
                Kredit Saya
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('pengiriman.saya') }}">
                <i class="fas fa-truck text-warning"></i>
                Pengiriman
            </a>
        </li>
        <li><hr class="dropdown-divider my-1"></li>
        <li>
            <form action="{{ route('pelanggan.auth.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>
@endauth


                <!-- Tombol Login (jika belum login) -->
                @guest('pelanggan')
                    <a href="{{ route('pelanggan.auth.login') }}" class="btn btn-primary rounded-pill py-2 px-4">Get Started</a>
                @endguest
            </div>
        </nav>
    </div>
</div>

    @yield('content')
    @include('layouts.alert')
<footer class="bg-dark text-light pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <!-- Tentang -->
            <div class="col-12 col-md-6 col-lg-3">
                <h5 class="mb-3 text-white">Tentang Hride</h5>
                <p class="small">Hride adalah platform kredit motor terpercaya yang membantu Anda memiliki motor impian dengan mudah dan cepat.</p>
                <form class="d-flex mt-3">
                    <input type="email" class="form-control rounded-start" placeholder="Email Anda">
                    <button type="submit" class="btn btn-primary rounded-end">Langganan</button>
                </form>
            </div>

            <!-- Tautan Cepat -->
            <div class="col-12 col-md-6 col-lg-3">
                <h5 class="mb-3 text-white">Tautan Cepat</h5>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-light text-decoration-none d-block py-1"><i class="fas fa-angle-right me-2"></i> Tentang Kami</a></li>
                    <li><a href="#" class="text-light text-decoration-none d-block py-1"><i class="fas fa-angle-right me-2"></i> Daftar Motor</a></li>
                    <li><a href="#" class="text-light text-decoration-none d-block py-1"><i class="fas fa-angle-right me-2"></i> Pengajuan Kredit</a></li>
                    <li><a href="#" class="text-light text-decoration-none d-block py-1"><i class="fas fa-angle-right me-2"></i> Kontak</a></li>
                    <li><a href="#" class="text-light text-decoration-none d-block py-1"><i class="fas fa-angle-right me-2"></i> Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <!-- Jam Operasional -->
            <div class="col-12 col-md-6 col-lg-3">
                <h5 class="mb-3 text-white">Jam Operasional</h5>
                <ul class="list-unstyled small">
                    <li>Senin - Jumat: 08.00 - 17.00</li>
                    <li>Sabtu: 09.00 - 14.00</li>
                    <li>Minggu: Libur</li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-12 col-md-6 col-lg-3">
                <h5 class="mb-3 text-white">Kontak Kami</h5>
                <ul class="list-unstyled small">
                    <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Merdeka No.123, Jakarta</li>
                    <li><i class="fas fa-envelope me-2"></i> cs@hride.id</li>
                    <li><i class="fas fa-phone me-2"></i> +62 812 3456 7890</li>
                    <li><i class="fas fa-print me-2"></i> +62 21 1234 5678</li>
                </ul>
                <div class="d-flex mt-3">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <hr class="border-light my-4">

        <div class="text-center small">
            &copy; {{ date('Y') }} <strong>Hride</strong>. All rights reserved.
        </div>
    </div>
</footer>


<!-- Copyright -->
<div class="container-fluid copyright py-3 bg-dark text-white">
    <div class="container d-flex flex-column flex-md-row justify-content-between text-center text-md-start">
        <div>
            &copy; <a href="#" class="text-white">Hride</a>. All rights reserved.
        </div>
        <div>
            Designed by <a href="https://htmlcodex.com" class="text-white">HTML Codex</a>
        </div>
    </div>
</div>

<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete-notification').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const item = this.closest('.notification-item');
            const notifId = item.getAttribute('data-id');

            headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    'Accept': 'application/json'
}

            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    item.remove();
                } else {
                    alert('Gagal menghapus notifikasi');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Terjadi kesalahan saat menghapus notifikasi');
            });
        });
    });
</script>
@endpush

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front-end/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('front-end/js/main.js') }}"></script>
    @stack('scripts')

</body>

</html>

