@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<style>
    .dashboard-card {
        color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        min-height: 120px;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 35px rgba(0, 0, 0, 0.15);
    }

    .dashboard-icon {
        font-size: 2rem;
        opacity: 0.8;
    }

    .dashboard-count {
        font-size: 2rem;
        font-weight: bold;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .btn-pdf {
        background-color: #b91c1c;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 14px;
        border-radius: 8px;
        margin-bottom: 20px;
        transition: background 0.3s ease;
    }

    .btn-pdf:hover {
        background-color: #991b1b;
        color: #fff;
    }

    /* Warna dashboard */
    .bg-navy { background: #1e3a8a; }
    .bg-lightblue { background: #3b82f6; }
    .bg-slate { background: #64748b; }
    .bg-teal { background: #14b8a6; }
    .bg-indigo { background: #4338ca; }
    .bg-gray { background: #4b5563; }
    .bg-sky { background: #0ea5e9; }
    .bg-green { background: #16a34a; }
</style>

<div class="container-fluid">
    <div class="page-header card">
        <div class="card-block">
            <h5 class="m-b-10">Dashboard</h5>
            <p class="text-muted m-b-10">Lihat ringkasan performa dan statistik aplikasi</p>
            <ul class="breadcrumb-title b-t-default p-t-10">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
            </ul>
        </div>
    </div>

    {{-- Tombol PDF --}}
    <div class="mb-3">
        <a href="{{ route('laporan.download') }}" class="btn btn-pdf">
            <i class="fa fa-file-pdf-o"></i> Download Laporan PDF
        </a>
    </div>

    {{-- Statistik --}}
    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dashboard-card bg-navy">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Jenis Motor</h6>
                            <div class="dashboard-count">{{ $totalJenisMotor }}</div>
                        </div>
                        <div class="dashboard-icon"><i class="ti-tag"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dashboard-card bg-lightblue">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Pelanggan</h6>
                            <div class="dashboard-count">{{ $totalPelanggan }}</div>
                        </div>
                        <div class="dashboard-icon"><i class="ti-user"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dashboard-card bg-sky">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Motor</h6>
                            <div class="dashboard-count">{{ $totalMotor }}</div>
                        </div>
                        <div class="dashboard-icon"><i class="ti-bike"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dashboard-card bg-indigo">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Pengajuan Kredit</h6>
                            <div class="dashboard-count">{{ $totalPengajuan }}</div>
                        </div>
                        <div class="dashboard-icon"><i class="ti-file"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dashboard-card bg-slate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Angsuran</h6>
                            <div class="dashboard-count">{{ $totalAngsuran }}</div>
                        </div>
                        <div class="dashboard-icon"><i class="ti-wallet"></i></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dashboard-card bg-gray">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>User Terdaftar</h6>
                            <div class="dashboard-count">{{ $totalUser }}</div>
                        </div>
                        <div class="dashboard-icon"><i class="ti-id-badge"></i></div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dashboard-card bg-green">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Kredit Aktif</h6>
                            <div class="dashboard-count">{{ $totalKredit }}</div>
                        </div>
                        <div class="dashboard-icon"><i class="ti-credit-card"></i></div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-md-6 col-xl-3 mb-4">
            <div class="card dashboard-card bg-teal">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Pengiriman</h6>
                            <div class="dashboard-count">{{ $totalPengiriman }}</div>
                        </div>
                        <div class="dashboard-icon"><i class="ti-truck"></i></div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
