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
            <h5>Daftar Asuransi</h5>
            <span>Manage dan lihat data perusahaan asuransi</span>
        </div>
        <div class="card-body">
            <!-- Tombol Tambah -->
            <a href="{{ route('asuransi.create') }}" class="btn btn-primary mb-3">Tambah Asuransi</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Perusahaan</th>
                            <th>Nama Asuransi</th>
                            <th>Margin (%)</th>
                            <th>No Rekening</th>
                            <th>Logo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asuransi as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->nama_perusahaan_asuransi }}</td>
                            <td>{{ $data->nama_asuransi }}</td>
                            <td>{{ $data->margin_asuransi }}%</td>
                            <td>{{ $data->no_rekening }}</td>
                            <td>
                                @if($data->url_logo)
                                <img 
                                  src="{{ asset('storage/' . $data->url_logo) }}" 
                                  alt="Logo {{ $data->nama_asuransi }}" 
                                  width="50"
                                  class="img-thumbnail"
                                >
                            @else
                                Tidak ada logo
                            @endif
                            
                            </td>
                            <td>
                                <a href="{{ route('asuransi.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('asuransi.destroy', $data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
