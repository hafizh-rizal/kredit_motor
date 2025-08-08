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
            <h5><i class="ti-plus mr-2"></i> Form Tambah Asuransi</h5>
        </div>
        <div class="card-body">

            {{-- Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('asuransi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Perusahaan</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_perusahaan_asuransi" class="form-control" required placeholder="Masukkan nama perusahaan asuransi" value="{{ old('nama_perusahaan_asuransi') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Asuransi</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_asuransi" class="form-control" required placeholder="Masukkan nama produk asuransi" value="{{ old('nama_asuransi') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Margin (%)</label>
                    <div class="col-sm-10">
                        <input type="number" name="margin_asuransi" class="form-control" min="0" step="0.01" required placeholder="Contoh: 3.5" value="{{ old('margin_asuransi') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. Rekening</label>
                    <div class="col-sm-10">
                        <input type="text" name="no_rekening" class="form-control" required placeholder="Masukkan nomor rekening" value="{{ old('no_rekening') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Logo Perusahaan</label>
                    <div class="col-sm-10">
                        <input type="file" name="url_logo" class="form-control">
                        <small class="form-text text-muted">Format: JPG, PNG. Maks: 2MB</small>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary"><i class="ti-save mr-2"></i> Simpan</button>
                        <a href="{{ route('asuransi.index') }}" class="btn btn-secondary ml-2"><i class="ti-arrow-left mr-2"></i> Kembali</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
