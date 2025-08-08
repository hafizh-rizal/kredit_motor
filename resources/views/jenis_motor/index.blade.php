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
                <h5><i class="ti-layout-grid2 mr-2"></i> Daftar Jenis Motor</h5>
                <span>Kelola dan lihat semua jenis motor yang tersedia</span>
            </div>
            <a href="{{ route('jenis_motor.create') }}" class="btn btn-primary mt-2 mt-md-0">
                <i class="ti-plus mr-2"></i> Tambah Jenis Motor
            </a>
        </div>
        <div class="card-body">

            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            {{-- Filter / Search --}}
            <form method="GET" action="{{ route('jenis_motor.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-5 mb-2">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari merk / jenis...">
                    </div>
                    <div class="col-md-4 mb-2">
                        <button type="submit" class="btn btn-secondary">
                            <i class="ti-search mr-1"></i> Cari
                        </button>
                        <a href="{{ route('jenis_motor.index') }}" class="btn btn-light border">
                            <i class="ti-reload mr-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Merk</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $key => $motor)
                        <tr>
                            <td>{{ $key + $data->firstItem() }}</td>
                            <td>{{ $motor->merk }}</td>
                            <td>{{ $motor->jenis }}</td>
                            <td class="text-truncate" style="max-width: 150px;">{{ $motor->deskripsi_jenis ?? '-' }}</td>
                            <td>
                                @if($motor->image_url)
                                    <a href="#" data-toggle="modal" data-target="#modalGambar{{ $motor->id }}">
                                        <img src="{{ asset('storage/'.$motor->image_url) }}" width="50" class="img-thumbnail">
                                    </a>

                                    {{-- Modal Zoom Gambar --}}
                                    <div class="modal fade" id="modalGambar{{ $motor->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Gambar Jenis Motor</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/'.$motor->image_url) }}" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('jenis_motor.edit', $motor->id) }}" class="btn btn-sm btn-warning edit-button" title="Edit">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                               <form action="{{ route('jenis_motor.destroy', $motor->id) }}" method="POST" class="d-inline delete-form">
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
                            <td colspan="6" class="text-center text-muted">Data tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if(method_exists($data, 'links'))
                <div class="mt-3">
                    {{ $data->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </div>
</div>

<style>
    .text-truncate {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

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
