@extends('fe.master')

@section('content')
    <div class="container-fluid py-5" style="background-color: #fff;">
        <div class="container">
            <div class="text-end mb-4">
                <a href="{{ route('product.index') }}" class="btn btn-secondary rounded-pill py-2 px-4 shadow-sm">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Produk
                </a>
            </div>

            <div class="text-center mx-auto pb-4" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize mb-3 text-dark">{{ $motor->nama_motor }}</h1>
                <p class="text-muted">{{ $motor->deskripsi_motor ?? 'Deskripsi motor tidak tersedia.' }}</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div id="motorCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/' . $motor->foto1) }}"
                                    class="d-block w-100 rounded-3 shadow-sm" style="object-fit: cover; height: 400px;"
                                    alt="{{ $motor->nama_motor }} - Gambar 1">
                            </div>
                            @if ($motor->foto2)
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $motor->foto2) }}"
                                        class="d-block w-100 rounded-3 shadow-sm" style="object-fit: cover; height: 400px;"
                                        alt="{{ $motor->nama_motor }} - Gambar 2">
                                </div>
                            @endif
                            @if ($motor->foto3)
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $motor->foto3) }}"
                                        class="d-block w-100 rounded-3 shadow-sm" style="object-fit: cover; height: 400px;"
                                        alt="{{ $motor->nama_motor }} - Gambar 3">
                                </div>
                            @endif
                            @if ($motor->foto4)
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $motor->foto4) }}"
                                        class="d-block w-100 rounded-3 shadow-sm" style="object-fit: cover; height: 400px;"
                                        alt="{{ $motor->nama_motor }} - Gambar 4">
                                </div>
                            @endif
                        </div>
                        @if ($motor->foto2 || $motor->foto3 || $motor->foto4)
                            <button class="carousel-control-prev" type="button" data-bs-target="#motorCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#motorCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3 text-dark">Detail Motor</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
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
                            <div class="text-center mt-3">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row mt-5">
                <div class="col-12">
                    <h5 class="mb-3 text-dark">Deskripsi Motor</h5>
                    <p class="fs-5 text-muted" style="line-height: 1.8;">
                        {{ $motor->deskripsi_motor ?? 'Deskripsi tidak tersedia' }}
                    </p>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Carousel Styling */
        .carousel-inner img {
            object-fit: cover;
            border-radius: 10px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 5px;
        }

        /* Card Styling for motor details */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        /* Text Styling */
        .fs-4,
        .fs-5 {
            font-weight: 500;
        }

        .text-muted {
            font-size: 1rem;
        }

        /* Button Styling */
        .btn-primary,
        .btn-warning,
        .btn-secondary {
            font-size: 1rem;
            padding: 12px 30px;
            border-radius: 25px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-warning:hover {
            background-color: #e6a900;
            border-color: #e6a900;
        }

        .btn-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
@endsection

@section('scripts')
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.min.css">
@endsection