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
            <h5>Daftar Metode Pembayaran</h5>
            <span>Kelola dan lihat semua metode pembayaran yang tersedia</span>
        </div>
        <div class="card-body">
            <!-- Button Tambah -->
            <a href="{{ route('metode_bayar.create') }}" class="btn btn-primary mb-3">Tambah Metode Bayar</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Metode Pembayaran</th>
                            <th>Tempat Bayar</th>
                            <th>No Rekening</th>
                            <th>Logo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($metode_bayar as $key => $metode)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $metode->metode_pembayaran }}</td>
                            <td>{{ $metode->tempat_bayar }}</td>
                            <td>{{ $metode->no_rekening }}</td>
                            <td>
                                @if($metode->url_logo)
                                    <img src="{{ asset($metode->url_logo) }}" alt="Logo" width="50" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada logo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('metode_bayar.edit', $metode->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('metode_bayar.destroy', $metode->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($metode_bayar->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data metode bayar</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
