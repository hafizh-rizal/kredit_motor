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
            <h5>Tambah Metode Pembayaran</h5>
            <span>Form untuk menambahkan data metode pembayaran baru</span>
        </div>
        <div class="card-body">
            <form action="{{ route('metode_bayar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="metode_pembayaran">Metode Pembayaran</label>
                    <input type="text" name="metode_pembayaran" class="form-control @error('metode_pembayaran') is-invalid @enderror" id="metode_pembayaran" value="{{ old('metode_pembayaran') }}" required>
                    @error('metode_pembayaran')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="tempat_bayar">Tempat Pembayaran</label>
                    <input type="text" name="tempat_bayar" class="form-control @error('tempat_bayar') is-invalid @enderror" id="tempat_bayar" value="{{ old('tempat_bayar') }}" required>
                    @error('tempat_bayar')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="no_rekening">Nomor Rekening</label>
                    <input type="text" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" id="no_rekening" value="{{ old('no_rekening') }}" required>
                    @error('no_rekening')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="url_logo">Logo Pembayaran</label>
                    <input type="file" name="url_logo" class="form-control @error('url_logo') is-invalid @enderror" id="url_logo">
                    @error('url_logo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('metode_bayar.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
