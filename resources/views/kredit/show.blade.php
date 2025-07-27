@extends('fe.master')

@section('content')
<style>
    .modern-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    }
    .modern-table th, .modern-table td {
        vertical-align: middle !important;
    }
    .badge-status {
        padding: 0.5em 0.8em;
        font-size: 0.9em;
        border-radius: 0.5em;
    }
    .badge-menunggu {
        background-color: #fff3cd;
        color: #856404;
    }
    .badge-diterima {
        background-color: #d4edda;
        color: #155724;
    }
    .badge-ditolak {
        background-color: #f8d7da;
        color: #721c24;
    }
    .img-thumbnail {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        object-fit: cover;
        transition: transform 0.2s ease;
    }
    .img-thumbnail:hover {
        transform: scale(1.05);
    }
</style>

<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">Detail Kredit - {{ $kredit->pengajuanKredit->motor->nama_motor }}</h2>

    <div class="card modern-card mb-5">
        <div class="card-body">
            <div class="row text-md-start text-center">
                <div class="col-md-4 mb-3">
                    <h6 class="text-muted">Status Kredit</h6>
                    <p class="fw-semibold">{{ $kredit->status_kredit }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-muted">Sisa Kredit</h6>
                    <p class="fw-semibold">Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-muted">Metode Bayar</h6>
                    <p class="fw-semibold">
                        @if($kredit->metodeBayar)
                            {{ $kredit->metodeBayar->metode_pembayaran }}<br>
                            <small>{{ $kredit->metodeBayar->no_rekening }}</small>
                        @else
                            <em>Tidak tersedia</em>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-4">Riwayat Pembayaran Angsuran</h4>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover modern-table align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th>Tanggal Bayar</th>
                    <th>Angsuran Ke</th>
                    <th>Total Bayar</th>
                    <th>Bukti</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kredit->angsuran as $data)
                    <tr class="text-center">
                        <td>{{ \Carbon\Carbon::parse($data->tgl_bayar)->format('d-m-Y') }}</td>
                        <td>{{ $data->angsuran_ke }}</td>
                        <td class="fw-semibold text-primary">Rp {{ number_format($data->total_bayar, 0, ',', '.') }}</td>
                        <td>
                            @if($data->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $data->bukti_pembayaran) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $data->bukti_pembayaran) }}" alt="Bukti Pembayaran" width="50" height="50" class="img-thumbnail">
                                </a>
                            @else
                                <em>-</em>
                            @endif
                        </td>
                        <td>{{ $data->keterangan ?? '-' }}</td>
                        <td>
                            <span class="badge badge-status 
                                @if($data->status_pembayaran == 'Menunggu') badge-menunggu
                                @elseif($data->status_pembayaran == 'Diterima') badge-diterima
                                @else badge-ditolak
                                @endif">
                                {{ $data->status_pembayaran }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada pembayaran angsuran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('kredit.saya') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>
@endsection
