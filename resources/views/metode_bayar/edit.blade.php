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
            <h5>Edit Metode Pembayaran</h5>
            <span>Form untuk mengubah data metode pembayaran</span>
        </div>
        <div class="card-body">
            <form action="{{ route('metode_bayar.update', $metode_bayar->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="metode_pembayaran">Metode Pembayaran</label>
                    <input type="text" name="metode_pembayaran" class="form-control" value="{{ old('metode_pembayaran', $metode_bayar->metode_pembayaran) }}" required>
                </div>

                <div class="form-group">
                    <label for="tempat_bayar">Tempat Bayar</label>
                    <input type="text" name="tempat_bayar" class="form-control" value="{{ old('tempat_bayar', $metode_bayar->tempat_bayar) }}" required>
                </div>

                <div class="form-group">
                    <label for="no_rekening">No Rekening</label>
                    <input type="text" name="no_rekening" class="form-control" value="{{ old('no_rekening', $metode_bayar->no_rekening) }}" required>
                </div>

                <div class="form-group">
                    <label for="url_logo">Logo (Opsional)</label><br>
                    @if($metode_bayar->url_logo)
                        <img src="{{ asset('storage/' . $metode_bayar->url_logo) }}" width="80" class="mb-2" alt="Logo">
                    @endif
                    <input type="file" name="url_logo" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('metode_bayar.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
