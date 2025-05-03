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
            <h5>Daftar Pengiriman</h5>
            <span>Kelola dan lihat semua data pengiriman motor</span>
        </div>
        <div class="card-body">
            <!-- Button Tambah -->
            <a href="{{ route('pengiriman.create') }}" class="btn btn-primary mb-3">Tambah Pengiriman</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Tanggal Kirim</th>
                            <th>Status Kirim</th>
                            <th>Nama Kurir</th>
                            <th>Telpon Kurir</th>
                            <th>Bukti Foto</th>
                            <th>Keterangan</th>
                            <th>ID Kredit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengiriman as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->invoice }}</td>
                            <td>{{ $item->tgl_kirim }}</td>
                            <td>{{ $item->status_kirim }}</td>
                            <td>{{ $item->nama_kurir }}</td>
                            <td>{{ $item->telpon_kurir }}</td>
                            <td>
                                @if($item->bukti_foto)
                                    <img src="{{ asset('storage/' . $item->bukti_foto) }}" alt="Bukti" width="50" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>                            
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->id_kredit }}</td>
                            <td>
                                <a href="{{ route('pengiriman.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pengiriman.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($pengiriman->isEmpty())
                            <tr>
                                <td colspan="10" class="text-center text-muted">Belum ada data pengiriman</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
