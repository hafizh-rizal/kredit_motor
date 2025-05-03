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
            <h5>Form Tambah Asuransi</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('asuransi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Perusahaan Asuransi</label>
                    <input type="text" name="nama_perusahaan_asuransi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nama Asuransi</label>
                    <input type="text" name="nama_asuransi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Margin Asuransi (%)</label>
                    <input type="number" step="0.01" name="margin_asuransi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>No Rekening</label>
                    <input type="text" name="no_rekening" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Logo Perusahaan (Opsional)</label>
                    <input type="file" name="url_logo" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('asuransi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
