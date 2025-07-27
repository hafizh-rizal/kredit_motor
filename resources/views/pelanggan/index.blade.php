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
            <h5>Daftar Pelanggan</h5>
            <span>Manage dan lihat semua data pelanggan</span>
        </div>
        <div class="card-body">
            <!-- Button Tambah -->
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telp</th>
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
                        @foreach($pelanggans as $key => $pelanggan)
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
                                    Tidak ada foto
                                @endif
                            </td>
                            <td>
                                {{-- <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</button>
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
@endsection
