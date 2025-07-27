@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .dashboard-container {
        padding: 30px;
        background: #f9fafb;
    }

    .dashboard-header {
        margin-bottom: 30px;
    }

    .dashboard-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
    }

    .dashboard-header p {
        color: #6b7280;
        font-size: 16px;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .dashboard-card {
        background: linear-gradient(to right, #06b6d4, #3b82f6);
        color: #fff;
        border-radius: 20px;
        padding: 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .dashboard-card .icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 40px;
        opacity: 0.2;
    }

    .dashboard-card h3 {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .dashboard-card .count {
        font-size: 36px;
        font-weight: 700;
    }

    .dashboard-footer {
        margin-top: 40px;
        text-align: center;
        color: #6b7280;
        font-size: 14px;
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
        <p>Berikut ringkasan tugas pengiriman Anda</p>
    </div>

    <div class="card-grid">
        <div class="dashboard-card">
            <div class="icon">
                <i class="ti-truck"></i>
            </div>
            <h3>Total Pengiriman</h3>
            <div class="count">{{ $totalPengiriman }}</div>
        </div>

        {{-- Tambahan opsional kalau kurir punya status --}}
        {{-- 
        <div class="dashboard-card" style="background: linear-gradient(to right, #10b981, #22c55e);">
            <div class="icon">
                <i class="ti-check-box"></i>
            </div>
            <h3>Pengiriman Selesai</h3>
            <div class="count">12</div>
        </div>

        <div class="dashboard-card" style="background: linear-gradient(to right, #facc15, #f59e0b);">
            <div class="icon">
                <i class="ti-time"></i>
            </div>
            <h3>Dalam Proses</h3>
            <div class="count">3</div>
        </div>
        --}}
    </div>

    <div class="dashboard-footer">
        HRIDE Kurir &copy; {{ date('Y') }}
    </div>
</div>
@endsection
