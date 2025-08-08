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
                <h5><i class="ti-user mr-2"></i> Manajemen Pelanggan</h5>
                <span>Kelola data pelanggan dan alamatnya</span>
            </div>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mt-2 mt-md-0">
                <i class="ti-plus mr-2"></i> Tambah Pelanggan
            </a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- FORM FILTER & SEARCH --}}
            <form method="GET" action="{{ route('pelanggan.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau telp..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="filter_kota" class="form-control">
                            <option value="">-- Semua Kota 1 --</option>
                            @foreach ($daftarKota as $kota)
                                <option value="{{ $kota }}" {{ request('filter_kota') == $kota ? 'selected' : '' }}>
                                    {{ $kota }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5 mb-2">
                        <button type="submit" class="btn btn-secondary">
                            <i class="ti-search mr-1"></i> Cari
                        </button>
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-light border">
                            <i class="ti-reload mr-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- TABEL PELANGGAN --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telp</th>
                            <th>Alamat 1</th>
                            <th>Kota 1</th>
                            <th>Propinsi 1</th>
                            <th>Kodepos 1</th>
                            <th>Alamat 2</th>
                            <th>Kota 2</th>
                            <th>Propinsi 2</th>
                            <th>Kodepos 2</th>
                            <th>Alamat 3</th>
                            <th>Kota 3</th>
                            <th>Propinsi 3</th>
                            <th>Kodepos 3</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggans as $key => $pelanggan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pelanggan->nama_pelanggan }}</td>
                            <td>{{ $pelanggan->email }}</td>
                            <td>{{ $pelanggan->no_telp }}</td>
                            <td>{{ $pelanggan->alamat1 }}</td>
                            <td>{{ $pelanggan->kota1 }}</td>
                            <td>{{ $pelanggan->propinsi1 }}</td>
                            <td>{{ $pelanggan->kodepos1 }}</td>
                            <td>{{ $pelanggan->alamat2 }}</td>
                            <td>{{ $pelanggan->kota2 }}</td>
                            <td>{{ $pelanggan->propinsi2 }}</td>
                            <td>{{ $pelanggan->kodepos2 }}</td>
                            <td>{{ $pelanggan->alamat3 }}</td>
                            <td>{{ $pelanggan->kota3 }}</td>
                            <td>{{ $pelanggan->propinsi3 }}</td>
                            <td>{{ $pelanggan->kodepos3 }}</td>
                            <td>
                                @if($pelanggan->foto)
                                    <img src="{{ asset('storage/' . $pelanggan->foto) }}" width="50" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="btn btn-sm btn-warning edit-button" title="Edit">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <form action="{{ route('pelanggan.destroy', $pelanggan) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button btn-delete" title="Hapus">
        <i class="ti-trash"></i>
    </button>
</form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="18" class="text-center text-muted">Tidak ada data pelanggan ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

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
