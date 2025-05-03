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
<div class="container mt-5 mb-5">
    <h1 class="text-center mb-4 text-dark">Informasi Kredit Anda</h1>

    @if($kredit->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle me-2"></i> Anda belum memiliki kredit aktif.
        </div>
    @else
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover mb-0">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th>Motor</th>
                                <th>Metode Pembayaran</th>
                                <th>Tanggal Mulai</th>
                                <th>Status</th>
                                <th>Sisa Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kredit as $k)
                                <tr>
                                    <td>{{ $k->pengajuanKredit->motor->nama_motor }}</td>
                                    <td class="text-center">
                                        @if($k->metodeBayar)
                                            {{ $k->metodeBayar->metode_pembayaran }} - {{ $k->metodeBayar->no_rekening }}
                                        @else
                                            -
                                        @endif
                                    </td>                                    
                                    <td class="text-center">{{ \Carbon\Carbon::parse($k->tgl_mulai_kredit)->format('d M Y') }}</td>
                                    <td class="text-center ">
                                        @php
                                            $statusClass = '';
                                            if ($k->status_kredit == 'Aktif') {
                                                $statusClass = 'badge bg-success';
                                            } elseif ($k->status_kredit == 'Lunas') {
                                                $statusClass = 'badge bg-success';
                                            } elseif ($k->status_kredit == 'Dicicil') {
                                                $statusClass = 'badge bg-warning';
                                            } else {
                                                $statusClass = 'badge bg-danger'; 
                                            }
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $k->status_kredit }}</span>
                                    
                                        @if($k->status_kredit == 'Dicicil' || $k->status_kredit == 'Macet')
                                            <div class="mt-2">
                                                <a href="{{ route('angsuran.create', ['id_kredit' => $k->id]) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-credit-card me-1"></i> Bayar Angsuran
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <td class="text-end">Rp {{ number_format($k->sisa_kredit, 0, ',', '.') }}</td>
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
   =
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        background-color: #fff; 
    }

    .card-body {
        padding: 2rem;
    }

    
    .table {
        background-color: #fff; 
    }

    .table th, .table td {
        vertical-align: middle;
        color: #212529; 
    }

    .table thead th {
        background-color: #007bff; 
        color: white;
        border-bottom: 2px solid #0056b3;
        font-weight: 500;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa; 
    }

    .badge {
        font-size: 0.9rem;
        font-weight: 400;
        padding: 0.4rem 0.8rem;
        border-radius: 0.25rem;
        color: #fff; 
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-primary {
        background-color: #007bff;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529; 
    }
    .badge-danger {
        background-color: #dc3545;
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 2.2rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table th, .table td {
            font-size: 0.9rem;
            padding: 0.75rem 0.5rem;
        }
    }
</style>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
