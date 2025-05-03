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
            <h5><i class="ti-layout-grid2 mr-2"></i> Daftar Jenis Motor</h5>
            <span>Kelola dan lihat semua jenis motor yang tersedia</span>
        </div>
        <div class="card-body">
            <a href="{{ route('jenis_motor.create') }}" class="btn btn-primary mb-3"><i class="ti-plus mr-2"></i> Tambah Jenis Motor</a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

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
                        @foreach($data as $key => $motor)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $motor->merk }}</td>
                            <td>{{ $motor->jenis }}</td>
                            <td class="text-truncate" style="max-width: 150px;">{{ $motor->deskripsi_jenis ?? '-' }}</td>
                            <td>
                                @if($motor->image_url)
                                    <span class="image-zoom-container">
                                        <img src="{{ asset('storage/'.$motor->image_url) }}" width="80" alt="Gambar Motor" class="img-thumbnail image-zoom">
                                    </span>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('jenis_motor.edit', $motor->id) }}" class="btn btn-sm btn-warning edit-button" title="Edit"><i class="ti-pencil-alt"></i></a>
                                <form action="{{ route('jenis_motor.destroy', $motor->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-button" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="ti-trash"></i></button>
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

<style>
    .table img {
        max-height: 70px;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .image-zoom-container {
        display: inline-block; /* Prevent container from taking full width */
    }

    .image-zoom {
        cursor: zoom-in;
    }

    .image-zoom:hover {
        transform: scale(2); /* Adjust the zoom level as needed */
        transform-origin: center; /* Zoom from the center */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Optional shadow for better visual */
        z-index: 10; /* Ensure the zoomed image is above other elements */
    }

    .text-truncate {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    /* Styling untuk tombol aksi */
    .action-buttons {
        white-space: nowrap; /* Mencegah tombol agar tidak wrap ke baris baru */
    }

    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.8rem;
        border-radius: 0.2rem;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .edit-button {
        background-color: #ffc107; /* Warna kuning khas untuk edit */
        border-color: #ffc107;
        color: #212529;
    }

    .edit-button:hover {
        transform: scale(1.1);
        box-shadow: 0 0 5px rgba(255, 193, 7, 0.5);
    }

    .delete-button {
        background-color: #dc3545; /* Warna merah khas untuk delete */
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