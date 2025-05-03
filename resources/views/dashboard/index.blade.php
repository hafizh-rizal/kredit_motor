@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
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

    <!-- Statistik Cards -->
    <div class="row">
        <!-- Total Jenis Motor -->
        <div class="col-md-12 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Jenis Motor</h6>
                    <h2 class="text-right">
                        <i class="ti-tag f-left"></i>
                        <span>{{ $totalJenisMotor }}</span>
                    </h2>
                </div>
            </div>
        </div>

        <!-- Total Pelanggan -->
        <div class="col-md-12 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Pelanggan</h6>
                    <h2 class="text-right">
                        <i class="ti-user f-left"></i>
                        <span>{{ $totalPelanggan }}</span>
                    </h2>
                </div>
            </div>
        </div>

        <!-- Total Motor -->
        <div class="col-md-12 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Motor</h6>
                    <h2 class="text-right">
                        <i class="ti-bike f-left"></i>
                        <span>{{ $totalMotor }}</span>
                    </h2>
                </div>
            </div>
        </div>

        <!-- Total Pengajuan Kredit -->
        <div class="col-md-12 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Pengajuan Kredit</h6>
                    <h2 class="text-right">
                        <i class="ti-file f-left"></i>
                        <span>{{ $totalPengajuan }}</span>
                    </h2>
                </div>
            </div>
        </div>

      
</div>
@endsection
