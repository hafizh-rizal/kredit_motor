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
            <h5>Daftar Kredit</h5>
            <span>Kelola dan lihat semua data kredit yang tersedia</span>
        </div>
        <div class="card-body">
            <!-- Tombol Tambah -->
            <a href="{{ route('kredit.create') }}" class="btn btn-primary mb-3">+ Tambah Kredit</a>

            <!-- Notifikasi -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Pelanggan</th>
                            <th>Motor</th>
                            <th>Metode Bayar</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
                            <th>Sisa Kredit</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kredit as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pengajuanKredit->pelanggan->nama_pelanggan ?? '-' }}</td>
                                <td>{{ $item->pengajuanKredit->motor->nama_motor ?? '-' }}</td>
                                <td>{{ $item->metodeBayar->metode_pembayaran ?? '-' }}</td>
                                <td>{{ $item->tgl_mulai_kredit }}</td>
                                <td>{{ $item->tgl_selesai_kredit }}</td>
                                <td>Rp{{ number_format($item->sisa_kredit, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($item->status_kredit == 'Lunas') bg-success 
                                        @elseif($item->status_kredit == 'Dicicil') bg-warning 
                                        @else bg-danger @endif">
                                        {{ $item->status_kredit }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('kredit.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kredit.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Belum ada data kredit</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
