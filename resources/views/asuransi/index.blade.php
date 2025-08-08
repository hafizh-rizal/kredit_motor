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
                <h5><i class="ti-shield mr-2"></i> Data Asuransi</h5>
                <span>Kelola daftar perusahaan asuransi dan margin terkait</span>
            </div>
            <a href="{{ route('asuransi.create') }}" class="btn btn-primary mt-2 mt-md-0">
                <i class="ti-plus mr-2"></i> Tambah Asuransi
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

            {{-- FORM FILTER & SEARCH --}}
            <form method="GET" action="{{ route('asuransi.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama perusahaan / asuransi / rekening..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="filter_perusahaan" class="form-control">
                            <option value="">-- Semua Perusahaan --</option>
                            @foreach($perusahaanList as $perusahaan)
                                <option value="{{ $perusahaan }}" {{ request('filter_perusahaan') == $perusahaan ? 'selected' : '' }}>
                                    {{ $perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5 mb-2">
                        <button type="submit" class="btn btn-secondary">
                            <i class="ti-search mr-1"></i> Cari
                        </button>
                        <a href="{{ route('asuransi.index') }}" class="btn btn-light border">
                            <i class="ti-reload mr-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- TABEL ASURANSI --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Logo</th>
                            <th>Perusahaan</th>
                            <th>Nama Asuransi</th>
                            <th>Margin (%)</th>
                            <th>No Rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asuransi as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($item->url_logo)
                                    <img src="{{ asset('storage/'.$item->url_logo) }}" class="img-thumbnail" width="60" height="60" style="object-fit: cover;">
                                @else
                                    <span class="text-muted">Tidak Ada</span>
                                @endif
                            </td>
                            <td>{{ $item->nama_perusahaan_asuransi }}</td>
                            <td>{{ $item->nama_asuransi }}</td>
                            <td>{{ $item->margin_asuransi }}%</td>
                            <td>{{ $item->no_rekening }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('asuransi.edit', $item) }}" class="btn btn-sm btn-warning edit-button" title="Edit">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <form action="{{ route('asuransi.destroy', $item) }}" method="POST" class="d-inline delete-form">
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
                            <td colspan="7" class="text-center text-muted">Tidak ada data ditemukan.</td>
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
