@extends('fe.master')

@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Pengiriman Saya</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Produk</a></li>
            <li class="breadcrumb-item active text-primary">Pengiriman Saya</li>
        </ol>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Main Content -->
<div class="container py-5">
    <h3 class="mb-4 text-center fw-semibold text-primary">Daftar Pengiriman Anda</h3>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($pengiriman as $item)
        <div class="col">
            <div class="card h-100 border-0 shadow rounded-4 position-relative hover-shadow">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title fw-bold text-dark mb-2">
                            <i class="bi bi-receipt me-2 text-primary"></i>Invoice: 
                            <span class="fw-normal">{{ $item->invoice }}</span>
                        </h5>
                        <p class="mb-2">
                            <i class="bi bi-calendar-event me-2 text-secondary"></i>
                            <strong>Tanggal Kirim:</strong> {{ \Carbon\Carbon::parse($item->tgl_kirim)->format('d M Y') }}
                        </p>
                        <p class="mb-3">
                            <i class="bi bi-truck me-2 text-secondary"></i>
                            <strong>Status:</strong>
                            @if ($item->status_kirim == 'Dikirim')
                                <span class="badge bg-success px-3 py-1 rounded-pill">{{ $item->status_kirim }}</span>
                            @elseif ($item->status_kirim == 'Pending')
                                <span class="badge bg-warning text-dark px-3 py-1 rounded-pill">{{ $item->status_kirim }}</span>
                            @else
                                <span class="badge bg-info text-white px-3 py-1 rounded-pill">{{ $item->status_kirim }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="text-end mt-3">
                        <a href="{{ route('pelanggan.pengiriman.show', $item->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                            <i class="bi bi-eye me-1"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-secondary text-center rounded-3 shadow-sm">
                <i class="bi bi-info-circle me-2"></i>Belum ada data pengiriman.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
