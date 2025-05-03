@extends('fe.master')

@section('content')

 <!-- Breadcrumb Start -->
 <div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Pengajuan Kredit Saya</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Produk</a></li>
            <li class="breadcrumb-item active text-primary">Pengajuan Kredit Saya</li>
        </ol>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="container py-5">
    <h3 class="mb-4 text-center">Daftar Pengajuan Kredit Anda</h3>

    @forelse ($pengajuanList as $pengajuan)
        <div class="card mb-3 shadow-sm border-0 rounded-3">
            <div class="card-body p-3">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h6 class="card-title mb-0 text-truncate" style="max-width: 200px;">{{ $pengajuan->motor->nama_motor }}</h6>
                        <p class="mb-0 small text-muted">Diajukan pada: {{ $pengajuan->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-0 small"><strong>Harga:</strong> Rp{{ number_format($pengajuan->harga_kredit, 0, ',', '.') }}</p>
                        <p class="mb-0 small"><strong>DP:</strong> Rp{{ number_format($pengajuan->dp, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-0 small"><strong>Cicilan:</strong> {{ $pengajuan->jenisCicilan->lama_cicilan }} bulan</p>
                        <p class="mb-0 small">
                            <strong>Status:</strong>
                            @if($pengajuan->status_pengajuan)
                                @php
                                    $statusClass = '';
                                    $statusText = $pengajuan->status_pengajuan;
                                    if ($pengajuan->status_pengajuan == 'Menunggu Konfirmasi') {
                                        $statusClass = 'bg-warning text-dark';
                                    } elseif ($pengajuan->status_pengajuan == 'Diproses') {
                                        $statusClass = 'bg-primary text-white';
                                    } elseif (Str::startsWith($pengajuan->status_pengajuan, 'Dibatalkan')) {
                                        $statusClass = 'bg-danger text-white';
                                    } elseif ($pengajuan->status_pengajuan == 'Bermasalah') {
                                        $statusClass = 'bg-dark text-white';
                                    } elseif ($pengajuan->status_pengajuan == 'Diterima') {
                                        $statusClass = 'bg-success text-white';
                                    } else {
                                        $statusClass = 'bg-light text-dark border';
                                    }
                                @endphp
                                <span class="badge rounded-pill {{ $statusClass }}">{{ $statusText }}</span>
                            @else
                                <span class="text-muted small">Status belum tersedia</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-2 text-end">
                        <a href="{{ route('pengajuan_kredit.show', $pengajuan->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                    </div>
                </div>
                @if($pengajuan->keterangan_status_pengajuan)
                    <p class="mb-0 mt-2 small text-muted"><strong>Keterangan:</strong> {{ $pengajuan->keterangan_status_pengajuan }}</p>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">Belum ada pengajuan kredit.</div>
    @endforelse

    <div class="text-center mt-4">
        <a href="{{ route('product.index') }}" class="btn btn-secondary rounded-pill btn-sm"><i class="bi bi-arrow-left me-2"></i> Kembali ke Produk</a>
    </div>
</div>

@endsection

@section('styles')
<style>
    .card {
        border-radius: 0.5rem !important;
    }
    .badge {
        font-size: 0.8rem;
    }
    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }
    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }
    .text-muted strong {
        color: #6c757d;
    }
</style>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.5/font/bootstrap-icons.min.css">
@endsection