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
<div class="container py-5">
    <h3 class="mb-4 text-center">Daftar Pengiriman Saya</h3>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($pengiriman as $item)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="card-title mb-2">Invoice: <span class="fw-normal">{{ $item->invoice }}</span></h5>
                    <p class="card-text mb-1">
                        <strong>Tanggal Kirim:</strong> {{ \Carbon\Carbon::parse($item->tgl_kirim)->format('d M Y') }}
                    </p>
                    <p class="card-text mb-2">
                        <strong>Status:</strong>
                        @if ($item->status_kirim == 'Dikirim')
                            <span class="badge bg-success">{{ $item->status_kirim }}</span>
                        @elseif ($item->status_kirim == 'Pending')
                            <span class="badge bg-warning">{{ $item->status_kirim }}</span>
                        @else
                            <span class="badge bg-info">{{ $item->status_kirim }}</span>
                        @endif
                    </p>
                    <div class="d-grid">
                        <a href="{{ route('pengiriman.show', $item->id) }}" class="btn btn-primary rounded-pill">
                            <i class="bi bi-eye me-1"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <p class="text-center text-muted">Belum ada pengiriman.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection