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
            <h5>Daftar Motor</h5>
            <span>Kelola dan lihat semua data motor yang tersedia</span>
        </div>
        <div class="card-body">
            <!-- Button Tambah -->
            <a href="{{ route('motor.create') }}" class="btn btn-primary mb-3">Tambah Motor</a>

         @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif


            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Motor</th>
                            <th>Jenis Motor</th>
                            <th>Harga Jual</th>
                            <th>Deskripsi</th>
                            <th>Warna</th>
                            <th>Kapasitas Mesin</th>
                            <th>Foto 1</th>
                            <th>Foto 2</th>
                            <th>Foto 3</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($motors as $key => $motor)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $motor->nama_motor }}</td>
                           <td>{{ $motor->jenis_motor->merk ?? 'N/A' }} - {{ $motor->jenis_motor->jenis ?? 'N/A' }}</td>
                            <td>{{ number_format($motor->harga_jual ?: 0, 0, ',', '.') }}</td>
                            <td>{{ $motor->deskripsi_motor ?? 'Tidak ada deskripsi' }}</td>
                            <td>{{ $motor->warna }}</td>
                            <td>{{ $motor->kapasitas_mesin }}</td>
                           
                           <td>
    @if($motor->foto1)
        <a href="#" data-toggle="modal" data-target="#modalFoto1{{ $motor->id }}">
            <img src="{{ asset('storage/' . $motor->foto1) }}" width="50" class="img-thumbnail">
        </a>

        <!-- Modal Foto 1 -->
        <div class="modal fade" id="modalFoto1{{ $motor->id }}" tabindex="-1" role="dialog" aria-labelledby="modalFoto1Label{{ $motor->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Foto 1</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $motor->foto1) }}" class="img-fluid" alt="Foto 1">
                    </div>
                </div>
            </div>
        </div>
    @else
        Tidak ada foto
    @endif
</td>

<td>
    @if($motor->foto2)
        <a href="#" data-toggle="modal" data-target="#modalFoto2{{ $motor->id }}">
            <img src="{{ asset('storage/' . $motor->foto2) }}" width="50" class="img-thumbnail">
        </a>

        <!-- Modal Foto 2 -->
        <div class="modal fade" id="modalFoto2{{ $motor->id }}" tabindex="-1" role="dialog" aria-labelledby="modalFoto2Label{{ $motor->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Foto 2</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $motor->foto2) }}" class="img-fluid" alt="Foto 2">
                    </div>
                </div>
            </div>
        </div>
    @else
        Tidak ada foto
    @endif
</td>

<td>
    @if($motor->foto3)
        <a href="#" data-toggle="modal" data-target="#modalFoto3{{ $motor->id }}">
            <img src="{{ asset('storage/' . $motor->foto3) }}" width="50" class="img-thumbnail">
        </a>

        <!-- Modal Foto 3 -->
        <div class="modal fade" id="modalFoto3{{ $motor->id }}" tabindex="-1" role="dialog" aria-labelledby="modalFoto3Label{{ $motor->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Foto 3</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $motor->foto3) }}" class="img-fluid" alt="Foto 3">
                    </div>
                </div>
            </div>
        </div>
    @else
        Tidak ada foto
    @endif
</td>

                            <td>{{ $motor->stok }}</td>
                            
                            <td>
                                <a href="{{ route('motor.edit', $motor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('motor.destroy', $motor->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($motors->isEmpty())
                            <tr>
                                <td colspan="11" class="text-center text-muted">Belum ada data motor</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
