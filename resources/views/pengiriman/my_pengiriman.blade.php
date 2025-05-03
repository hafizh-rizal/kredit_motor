@extends('fe.master')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5">
        <h4 class="text-white display-4 mb-4">Detail Pengiriman</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active text-primary">Detail Pengiriman</li>
        </ol>
    </div>
</div>
<div class="container py-5">
    <h3 class="mb-4 text-center">Pengiriman Anda</h3>
    @foreach($pengiriman as $item)
    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="mb-2 fw-bold">Informasi Umum</h6>
                    <p class="mb-1"><i class="bi bi-receipt-cutoff me-2"></i> <strong>Invoice:</strong> {{ $item->invoice }}</p>
                    <p class="mb-1"><i class="bi bi-calendar-check me-2"></i> <strong>Dikirim pada:</strong> {{ \Carbon\Carbon::parse($item->tgl_kirim)->format('d M Y') }}</p>
                    <p class="mb-0"><i class="bi bi-truck me-2"></i> <strong>Status Pengiriman:</strong> <span class="{{ $item->status_kirim == 'Dikirim' ? 'text-success' : ($item->status_kirim == 'Pending' ? 'text-warning' : 'text-info') }}">{{ $item->status_kirim }}</span></p>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="mb-2 fw-bold">Detail Kurir & Kendaraan</h6>
                    <p class="mb-1"><i class="bi bi-person-fill me-2"></i> <strong>Nama Kurir:</strong> {{ $item->nama_kurir }}</p>
                    <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i> <strong>Telepon Kurir:</strong> {{ $item->telpon_kurir }}</p>
                    <p class="mb-0"><i class="bi bi-motorcycle me-2"></i> <strong>Motor:</strong> {{ $item->kredit->pengajuanKredit->motor->nama_motor }}</p>
                </div>
                <div class="col-12">
                    <h6 class="mb-2 fw-bold">Informasi Pelanggan</h6>
                    <p class="mb-0"><i class="bi bi-person-vcard-fill me-2"></i> <strong>Pelanggan:</strong> {{ $item->kredit->pengajuanKredit->pelanggan->nama_pelanggan }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="mb-2 fw-bold">Bukti Foto</h6>
                @if($item->bukti_foto)
                    <img src="{{ asset('storage/' . $item->bukti_foto) }}" alt="Bukti Foto" class="img-fluid rounded">
                @else
                    <p class="text-muted">Tidak ada foto bukti pengiriman.</p>
                @endif
            </div>

            @if($item->keterangan)
                <div class="mt-4">
                    <h6 class="mb-2 fw-bold">Keterangan Tambahan</h6>
                    <p class="text-muted">{{ $item->keterangan }}</p>
                </div>
            @endif
        </div>
    </div>
    @endforeach

    <div class="text-center mt-4">
        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Pengiriman</a>
    </div>
</div>
@endsection