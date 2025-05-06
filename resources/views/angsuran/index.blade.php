@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="page-body">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Data Angsuran</h5>
                <span>Kelola dan lihat data angsuran dari pelanggan</span>
            </div>
            <div class="card-body">
                <a href="{{ route('angsuran.create') }}" class="btn btn-primary mb-3">+ Tambah Angsuran</a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>ID Kredit</th>
                                <th>Tanggal Bayar</th>
                                <th>Angsuran Ke</th>
                                <th>Total Bayar</th>
                                <th>Bukti Pembayaran</th>
                                <th>Keterangan</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($angsuran as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->kredit->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tgl_bayar)->format('d-m-Y') }}</td>
                                    <td>{{ $data->angsuran_ke }}</td>
                                    <td>Rp {{ number_format($data->total_bayar, 0, ',', '.') }}</td>
                                    <td>
                                        @if($data->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $data->bukti_pembayaran) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $data->bukti_pembayaran) }}" alt="Bukti Pembayaran" width="50" height="50">
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $data->keterangan ?? '-' }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($data->status_pembayaran == 'Menunggu') badge-warning
                                            @elseif($data->status_pembayaran == 'Diterima') badge-success
                                            @else badge-danger
                                            @endif">
                                            {{ $data->status_pembayaran }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('angsuran.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('angsuran.destroy', $data->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data angsuran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
