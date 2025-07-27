@extends('fe.master')
@section('content')

<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Kredit Saya</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Produk</a></li>
            <li class="breadcrumb-item active text-primary">Kredit Saya</li>
        </ol>
    </div>
</div>
<<div class="container my-5">
    <h2 class="text-center mb-4 text-dark">Informasi Kredit Anda</h2>

    @if($kredit->isEmpty())
        <div class="alert alert-info text-center shadow-sm">
            <i class="fas fa-info-circle me-2"></i> Anda belum memiliki kredit aktif.
        </div>
    @else
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body px-4 py-5">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th>Motor</th>
                                <th>Metode Pembayaran</th>
                                <th>Status DP</th>
                                <th>Tanggal Mulai</th>
                                <th>Status Kredit</th>
                                <th>Sisa Kredit</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kredit as $k)
                                <tr>
                                    <td class="fw-semibold">{{ $k->pengajuanKredit->motor->nama_motor }}</td>
                                    <td class="text-center">
                                        @if($k->metodeBayar)
                                            {{ $k->metodeBayar->metode_pembayaran }}<br>
                                            <small class="text-muted">{{ $k->metodeBayar->no_rekening }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>    
                                    <td class="text-center">
                                        @php
                                            $dpStatusClass = match($k->status_pembayaran_dp) {
                                                'Sudah Dibayar' => 'badge bg-success',
                                                'Menunggu Verifikasi' => 'badge bg-warning text-dark',
                                                default => 'badge bg-danger',
                                            };
                                        @endphp
                                        <span class="{{ $dpStatusClass }}">{{ $k->status_pembayaran_dp }}</span>
                                    </td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($k->tgl_mulai_kredit)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = match($k->status_kredit) {
                                                'Aktif', 'Lunas' => 'bg-success',
                                                'Dicicil' => 'bg-warning text-dark',
                                                default => 'bg-danger',
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $k->status_kredit }}</span>

                                        @if(in_array($k->status_kredit, ['Dicicil', 'Macet']))
                                            <div class="mt-2">
                                                <a href="{{ route('angsuran.create', ['id_kredit' => $k->id]) }}" class="btn btn-sm btn-outline-primary shadow-sm">
                                                    <i class="fas fa-credit-card me-1"></i> Bayar Angsuran
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-end fw-bold">Rp {{ number_format($k->sisa_kredit, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pelanggan.kredit.show', $k->id) }}" class="btn btn-sm btn-outline-info shadow-sm">
                                            <i class="fas fa-info-circle me-1"></i> Detail Kredit
                                        </a>
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@section('styles')
<style>
    .card {
        border-radius: 1rem;
        background-color: #ffffff;
    }

    .table thead th {
        font-weight: 600;
        font-size: 0.95rem;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.75em;
        border-radius: 0.4rem;
    }

    .table td, .table th {
        vertical-align: middle;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 0.85rem;
            padding: 0.6rem 0.4rem;
        }

        h2 {
            font-size: 1.6rem;
        }
    }
</style>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
