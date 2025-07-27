@extends('fe.master')

@section('content')
<div class="container-fluid py-5" style="background-color: #fff;">
    <div class="container">
        {{-- Tombol kembali --}}
        <div class="text-end mb-4">
            <a href="{{ route('product.index') }}" class="btn btn-secondary rounded-pill py-2 px-4 shadow-sm">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Produk
            </a>
        </div>

        {{-- Judul dan deskripsi motor --}}
        <div class="text-center mx-auto pb-4" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3 text-dark">{{ $motor->nama_motor }}</h1>
            <p class="text-muted">{{ $motor->deskripsi_motor ?? 'Deskripsi motor tidak tersedia.' }}</p>
        </div>

        <div class="row g-4">
            {{-- Gambar carousel --}}
            <div class="col-md-6">
                <div id="motorCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $motor->foto1) }}" class="d-block w-100 rounded-3 shadow-sm"
                                style="object-fit: cover; height: 400px;" alt="{{ $motor->nama_motor }} - Gambar 1">
                        </div>
                        @foreach (['foto2', 'foto3', 'foto4'] as $foto)
                            @if ($motor->$foto)
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $motor->$foto) }}"
                                        class="d-block w-100 rounded-3 shadow-sm"
                                        style="object-fit: cover; height: 400px;"
                                        alt="{{ $motor->nama_motor }} - Gambar">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Navigasi carousel --}}
                    @if ($motor->foto2 || $motor->foto3 || $motor->foto4)
                        <button class="carousel-control-prev" type="button" data-bs-target="#motorCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#motorCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>

            {{-- Detail motor --}}
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3 text-dark">Detail Motor</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong class="text-dark">Harga:</strong>
                                <p class="fs-4 text-primary mb-0">Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</p>
                            </li>
                            <li class="mb-2">
                                <strong class="text-dark">Kapasitas Mesin:</strong>
                                <p class="fs-5 text-muted mb-0">{{ $motor->kapasitas_mesin }} cc</p>
                            </li>
                            <li class="mb-2">
                                <strong class="text-dark">Warna:</strong>
                                <p class="fs-5 text-muted mb-0">{{ $motor->warna }}</p>
                            </li>
                            <li class="mb-3">
                                <strong class="text-dark">Stok:</strong>
                                <p class="fs-5 text-muted mb-0">{{ $motor->stok }} unit tersedia</p>
                            </li>
                        </ul>

                        {{-- Tombol aksi --}}
                        <div class="text-center mt-4">
                            @if ($motor->stok > 0)
                                @auth('pelanggan')
                                    <a href="{{ route('pengajuan_kredit.create', ['motor_id' => $motor->id]) }}"
                                        class="btn btn-primary rounded-pill py-2 px-4 shadow-sm">
                                        <i class="bi bi-cash-coin me-2"></i> Ajukan Kredit
                                    </a>
                                @else
                                    <a href="{{ route('pelanggan.auth.login') }}"
                                        class="btn btn-warning rounded-pill py-2 px-4 shadow-sm">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Login untuk Kredit
                                    </a>
                                @endauth
                            @else
                                <button class="btn btn-danger rounded-pill py-2 px-4 shadow-sm" disabled>
                                    <i class="bi bi-exclamation-circle me-2"></i> Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jika ingin menampilkan deskripsi ulang --}}
        {{-- 
        <div class="row mt-5">
            <div class="col-12">
                <h5 class="mb-3 text-dark">Deskripsi Motor</h5>
                <p class="fs-5 text-muted" style="line-height: 1.8;">
                    {{ $motor->deskripsi_motor ?? 'Deskripsi tidak tersedia' }}
                </p>
            </div>
        </div> 
        --}}
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .carousel-inner img {
        object-fit: cover;
        border-radius: 20px;
        transition: transform 0.4s ease-in-out;
    }

    .carousel-inner img:hover {
        transform: scale(1.02);
    }

    .carousel-control-prev, .carousel-control-next {
        width: 5%;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        padding: 10px;
    }

    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
    }

    .card-body {
        padding: 40px 30px;
    }

    .card-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: #343a40;
    }

    .list-unstyled li {
        margin-bottom: 1.25rem;
    }

    .fs-4 {
        font-size: 1.75rem !important;
        font-weight: 600;
    }

    .fs-5 {
        font-size: 1.25rem !important;
        font-weight: 500;
    }

    .text-muted {
        font-size: 1rem;
        color: #6c757d !important;
    }

    .btn {
        font-size: 1rem;
        padding: 12px 32px;
        border-radius: 30px;
        letter-spacing: 0.5px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e6a900;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:disabled {
        opacity: 0.75;
    }

    .container-fluid {
        background: linear-gradient(to right, #e0f7fa, #ffffff);
    }

    .display-5 {
        font-size: 2.5rem;
        font-weight: 700;
    }

    .text-end a.btn i {
        transition: transform 0.2s ease;
    }

    .text-end a.btn:hover i {
        transform: translateX(-4px);
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 25px 20px;
        }

        .fs-4 {
            font-size: 1.5rem !important;
        }

        .fs-5 {
            font-size: 1.1rem !important;
        }

        .display-5 {
            font-size: 2rem;
        }

        .carousel-inner img {
            height: 300px !important;
        }
    }
</style>
@endsection
