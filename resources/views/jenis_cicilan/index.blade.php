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
        <div class="card-header">
            <h5>Daftar Jenis Cicilan</h5>
            <span>Manage dan lihat semua jenis cicilan yang tersedia</span>
        </div>
        <div class="card-body">
            <!-- Button Tambah -->
            <a href="{{ route('jenis_cicilan.create') }}" class="btn btn-primary mb-3">Tambah Jenis Cicilan</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Tabel -->
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
                        @foreach($jenisCicilans as $key => $cicilan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $cicilan->lama_cicilan }} bulan</td>
                            <td>{{ $cicilan->margin_kredit }}%</td>
                            <td>
                                <a href="{{ route('jenis_cicilan.edit', $cicilan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('jenis_cicilan.destroy', $cicilan->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
