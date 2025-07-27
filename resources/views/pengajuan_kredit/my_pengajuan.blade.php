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
    <h3 class="mb-4 text-center fw-bold">Riwayat Pengajuan Kredit</h3>

    @forelse ($pengajuanList as $pengajuan)
        <div class="card mb-4 border-0 shadow-sm rounded-4 px-3 py-2">
            <div class="card-body">
                <div class="row align-items-center gy-2">
                    <div class="col-md-4">
                        <h5 class="fw-semibold mb-1 text-primary">{{ $pengajuan->motor->nama_motor }}</h5>
                        <small class="text-muted">Diajukan: {{ $pengajuan->created_at->format('d M Y') }}</small>
                    </div>
                    <div class="col-md-3">
                        <small class="d-block"><strong>Harga Kredit:</strong> Rp{{ number_format($pengajuan->harga_kredit, 0, ',', '.') }}</small>
                        <small class="d-block"><strong>DP:</strong> Rp{{ number_format($pengajuan->dp, 0, ',', '.') }}</small>
                    </div>
                    <div class="col-md-3">
                        <small class="d-block"><strong>Cicilan:</strong> {{ $pengajuan->jenisCicilan->lama_cicilan }} bulan</small>
                        <small class="d-block">
                            <strong>Status:</strong>
                            @php
                                $status = $pengajuan->status_pengajuan ?? 'Belum Ditetapkan';
                                $statusClass = match(true) {
                                    $status == 'Menunggu Konfirmasi' => 'bg-warning text-dark',
                                    $status == 'Diproses' => 'bg-primary text-white',
                                    Str::startsWith($status, 'Dibatalkan') => 'bg-danger text-white',
                                    $status == 'Bermasalah' => 'bg-dark text-white',
                                    $status == 'Diterima' => 'bg-success text-white',
                                    default => 'bg-secondary text-white',
                                };
                            @endphp
                            <span class="badge rounded-pill {{ $statusClass }}">{{ $status }}</span>
                        </small>
                    </div>
                    <div class="col-md-2 text-end">
                        @if ($pengajuan->status_pengajuan === 'Diterima' && !$pengajuan->kredit)
                            <a href="{{ route('kredit.create', ['id_pengajuan' => $pengajuan->id]) }}" class="btn btn-sm btn-success rounded-pill mb-2 w-100">Kredit</a>
                        @elseif ($pengajuan->status_pengajuan === 'Diterima' && $pengajuan->kredit)
                            <span class="badge bg-success rounded-pill d-block mb-2">Kredit dibuat</span>
                        @endif
                        <a href="{{ route('pelanggan.pengajuan_kredit.show', $pengajuan->id) }}" class="btn btn-sm btn-outline-primary rounded-pill w-100">Detail</a>
                    </div>
                </div>
                @if($pengajuan->keterangan_status_pengajuan)
                    <div class="mt-3">
                        <small class="text-muted"><strong>Keterangan:</strong> {{ $pengajuan->keterangan_status_pengajuan }}</small>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center rounded-pill">Belum ada pengajuan kredit.</div>
    @endforelse

    <div class="text-center mt-5">
        <a href="{{ route('product.index') }}" class="btn btn-secondary rounded-pill btn-sm px-4 py-2"><i class="bi bi-arrow-left me-2"></i> Kembali ke Produk</a>
    </div>
</div>

@endsection

@section('styles')
<style>
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0 15px rgba(0, 123, 255, 0.1);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.4em 0.6em;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .btn-sm {
        font-size: 0.8rem;
    }
</style>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.5/font/bootstrap-icons.min.css">
@endsection
