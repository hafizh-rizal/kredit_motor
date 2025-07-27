@extends('fe.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5">
        <h4 class="text-white display-4 mb-4">Detail Pengiriman</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active text-primary">Detail Pengiriman</li>
        </ol>
    </div>
</div>

<!-- Main Content -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4 p-md-5">

                    <h4 class="mb-4 text-center text-primary fw-semibold">Informasi Pengiriman</h4>

                    <div class="row g-4">

                        <!-- Info Umum -->
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light">
                                <h6 class="fw-bold mb-3 text-dark">Informasi Umum</h6>
                                <p class="mb-2"><i class="bi bi-receipt-cutoff me-2"></i><strong>Invoice:</strong> {{ $item->invoice }}</p>
                                <p class="mb-2"><i class="bi bi-calendar-check me-2"></i><strong>Tanggal Kirim:</strong> {{ \Carbon\Carbon::parse($item->tgl_kirim)->format('d M Y') }}</p>
                                <p class="mb-0"><i class="bi bi-truck me-2"></i><strong>Status:</strong> 
                                    <span class="{{
                                        $item->status_kirim == 'Sedang Dikirim' ? 'text-warning' :
                                        ($item->status_kirim == 'Tiba Di Tujuan' ? 'text-success' : 'text-secondary')
                                    }}">{{ $item->status_kirim }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Kurir & Motor -->
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light">
                                <h6 class="fw-bold mb-3 text-dark">Kurir & Motor</h6>
                                <p class="mb-2"><i class="bi bi-person-fill me-2"></i><strong>Nama Kurir:</strong> {{ $item->nama_kurir }}</p>
                                <p class="mb-2"><i class="bi bi-telephone-fill me-2"></i><strong>Telepon:</strong> {{ $item->telpon_kurir }}</p>
                                <p class="mb-0"><i class="bi bi-motorcycle me-2"></i><strong>Motor:</strong> {{ $item->kredit->pengajuanKredit->motor->nama_motor }}</p>
                            </div>
                        </div>

                        <!-- Pelanggan & Alamat -->
                        <div class="col-12">
                            <div class="border rounded-3 p-3 bg-light">
                                <h6 class="fw-bold mb-3 text-dark">Informasi Pelanggan</h6>
                                @php
                                    $pengajuan = $item->kredit->pengajuanKredit;
                                    $pel = $pengajuan->pelanggan;
                                    $field = $pengajuan->alamat_pengiriman;
                                    $alamatLengkap = match($field) {
                                        'alamat1' => "{$pel->alamat1}, {$pel->kota1}, {$pel->propinsi1}, {$pel->kodepos1}",
                                        'alamat2' => "{$pel->alamat2}, {$pel->kota2}, {$pel->propinsi2}, {$pel->kodepos2}",
                                        'alamat3' => "{$pel->alamat3}, {$pel->kota3}, {$pel->propinsi3}, {$pel->kodepos3}",
                                        default => '-',
                                    };
                                @endphp

                                <p class="mb-2"><i class="bi bi-person-vcard-fill me-2"></i><strong>Nama:</strong> {{ $pel->nama_pelanggan }}</p>
                                <p class="mb-0"><i class="bi bi-geo-alt-fill me-2"></i><strong>Alamat Tujuan:</strong> {{ $alamatLengkap }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bukti Foto -->
                    <div class="mt-5">
                        <h6 class="fw-bold mb-3 text-center text-dark">Bukti Pengiriman</h6>
                        @if($item->bukti_foto)
                            <div class="d-flex justify-content-center">
                                <img 
                                    src="{{ asset('storage/' . $item->bukti_foto) }}"
                                    alt="Bukti Pengiriman"
                                    class="img-thumbnail shadow-sm"
                                    style="max-width: 300px; cursor: pointer;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalFoto"
                                >
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modalFoto" tabindex="-1" aria-labelledby="modalFotoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalFotoLabel">Bukti Pengiriman</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img 
                                                src="{{ asset('storage/' . $item->bukti_foto) }}"
                                                alt="Bukti Pengiriman"
                                                class="img-fluid rounded"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-muted text-center">Tidak ada foto bukti pengiriman.</p>
                        @endif
                    </div>

                    <!-- Keterangan -->
                    @if($item->keterangan)
                        <div class="mt-4">
                            <h6 class="fw-bold mb-2 text-dark">Keterangan Tambahan</h6>
                            <p class="text-muted">{{ $item->keterangan }}</p>
                        </div>
                    @endif

                    <!-- Tombol Kembali -->
                    <div class="text-center mt-4">
                        <a href="{{ route('pengiriman.saya') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Pengiriman
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
