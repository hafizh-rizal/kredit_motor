@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="page-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h5><i class="ti-calendar mr-2"></i> Daftar Jenis Cicilan</h5>
                <span>Manage dan lihat semua jenis cicilan yang tersedia</span>
            </div>
            <a href="{{ route('jenis_cicilan.create') }}" class="btn btn-primary mt-2 mt-md-0">
                <i class="ti-plus mr-2"></i> Tambah Jenis Cicilan
            </a>
        </div>
        <div class="card-body">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            {{-- FORM FILTER & SEARCH --}}
            <form method="GET" action="{{ route('jenis_cicilan.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari durasi / margin..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="filter_lama" class="form-control">
                            <option value="">-- Semua Durasi --</option>
                            @foreach($jenisCicilans->pluck('lama_cicilan')->unique() as $durasi)
                                <option value="{{ $durasi }}" {{ request('filter_lama') == $durasi ? 'selected' : '' }}>
                                    {{ $durasi }} bulan
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5 mb-2">
                        <button type="submit" class="btn btn-secondary">
                            <i class="ti-search mr-1"></i> Cari
                        </button>
                        <a href="{{ route('jenis_cicilan.index') }}" class="btn btn-light border">
                            <i class="ti-reload mr-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- TABEL --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Lama Cicilan (bulan)</th>
                            <th>Margin Kredit (%)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenisCicilans as $key => $cicilan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $cicilan->lama_cicilan }} bulan</td>
                            <td>{{ number_format($cicilan->margin_kredit, 2) }}%</td>
                            <td class="action-buttons">
                                <a href="{{ route('jenis_cicilan.edit', $cicilan->id) }}" class="btn btn-sm btn-warning edit-button">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <form action="{{ route('jenis_cicilan.destroy', $cicilan->id) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button btn-delete">
        <i class="ti-trash"></i>
    </button>
</form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data cicilan ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- STYLE --}}
<style>
    .action-buttons {
        white-space: nowrap;
    }

    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.8rem;
        border-radius: 0.2rem;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .edit-button {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .edit-button:hover {
        transform: scale(1.1);
        box-shadow: 0 0 5px rgba(255, 193, 7, 0.5);
    }

    .delete-button {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .delete-button:hover {
        transform: scale(1.1);
        box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
    }

    .btn i {
        margin-right: 0.3rem;
    }
</style>
@endsection
