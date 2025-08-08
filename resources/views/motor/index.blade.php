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

            <!-- Filter & Search -->
            <form method="GET" action="{{ route('motor.index') }}" class="form-inline mb-3 flex-wrap gap-2">
                <div class="form-group mr-2 mb-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama / warna...">
                </div>

                <div class="form-group mr-2 mb-2">
                    <select name="jenis" class="form-control">
                        <option value="">-- Semua Jenis --</option>
                        @foreach($jenis_motor as $jm)
                            <option value="{{ $jm->id }}" {{ request('jenis') == $jm->id ? 'selected' : '' }}>
                                {{ $jm->merk }} - {{ $jm->jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-primary mb-2">Terapkan</button>
                <a href="{{ route('motor.index') }}" class="btn btn-outline-secondary mb-2">Reset</a>
            </form>

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
                            <td>{{ $key + $motors->firstItem() }}</td>
                            <td>{{ $motor->nama_motor }}</td>
                            <td>{{ $motor->jenis_motor->merk ?? 'N/A' }} - {{ $motor->jenis_motor->jenis ?? 'N/A' }}</td>
                            <td>{{ number_format($motor->harga_jual ?: 0, 0, ',', '.') }}</td>
                            <td>{{ $motor->deskripsi_motor ?? 'Tidak ada deskripsi' }}</td>
                            <td>{{ $motor->warna }}</td>
                            <td>{{ $motor->kapasitas_mesin }}</td>

                            {{-- Foto 1 --}}
                            <td>
                                @if($motor->foto1)
                                    <a href="#" data-toggle="modal" data-target="#modalFoto1{{ $motor->id }}">
                                        <img src="{{ asset('storage/' . $motor->foto1) }}" width="50" class="img-thumbnail">
                                    </a>
                                    <div class="modal fade" id="modalFoto1{{ $motor->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Foto 1</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $motor->foto1) }}" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    Tidak ada foto
                                @endif
                            </td>

                            {{-- Foto 2 --}}
                            <td>
                                @if($motor->foto2)
                                    <a href="#" data-toggle="modal" data-target="#modalFoto2{{ $motor->id }}">
                                        <img src="{{ asset('storage/' . $motor->foto2) }}" width="50" class="img-thumbnail">
                                    </a>
                                    <div class="modal fade" id="modalFoto2{{ $motor->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Foto 2</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $motor->foto2) }}" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    Tidak ada foto
                                @endif
                            </td>

                            {{-- Foto 3 --}}
                            <td>
                                @if($motor->foto3)
                                    <a href="#" data-toggle="modal" data-target="#modalFoto3{{ $motor->id }}">
                                        <img src="{{ asset('storage/' . $motor->foto3) }}" width="50" class="img-thumbnail">
                                    </a>
                                    <div class="modal fade" id="modalFoto3{{ $motor->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Foto 3</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $motor->foto3) }}" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    Tidak ada foto
                                @endif
                            </td>

                            <td>{{ $motor->stok }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('motor.edit', $motor->id) }}" class="btn btn-sm btn-warning edit-button" title="Edit">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                               <form action="{{ route('motor.destroy', $motor->id) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button btn-delete" title="Hapus">
        <i class="ti-trash"></i>
    </button>
</form>
                            </td>
                        </tr>
                        @endforeach

                        @if($motors->isEmpty())
                            <tr>
                                <td colspan="12" class="text-center text-muted">Belum ada data motor</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if(method_exists($motors, 'links'))
                <div class="mt-3">
                    {{ $motors->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
