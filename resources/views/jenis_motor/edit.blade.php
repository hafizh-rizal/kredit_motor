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
            <h5><i class="ti-pencil-alt mr-2"></i> Form Edit Jenis Motor</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis_motor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label fw-semibold">Merk</label>
                    <div class="col-sm-10">
                        <input type="text" name="merk" class="form-control" value="{{ $motor->merk }}" required placeholder="Masukkan Merk Motor">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label fw-semibold">Jenis</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach(['Bebek', 'Skuter', 'Dual Sport', 'Naked Sport', 'Sport Bike', 'Retro', 'Cruiser', 'Sport Touring', 'Dirt Bike', 'Motocross', 'Scrambler', 'ATV', 'Motor Adventure', 'Lainnya'] as $optionJenis)
                                <option value="{{ $optionJenis }}" @if($motor->jenis == $optionJenis) selected @endif>{{ $optionJenis }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label fw-semibold">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi_jenis" class="form-control" placeholder="Masukkan Deskripsi (opsional)">{{ $motor->deskripsi_jenis }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label fw-semibold">Upload Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" name="image_url" class="form-control">
                        @if($motor->image_url)
                            <div class="mt-2">
                                <small class="form-text text-muted">Gambar saat ini:</small>
                                <img src="{{ asset($motor->image_url) }}" alt="{{ $motor->merk }} - {{ $motor->jenis }}" class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        @endif
                        <small class="form-text text-muted">Format file: JPG, PNG, GIF. Ukuran maksimal: (sesuaikan dengan konfigurasi Anda).</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary"><i class="ti-save mr-2"></i> Simpan Perubahan</button>
                        <a href="{{ route('jenis_motor.index') }}" class="btn btn-secondary ml-2"><i class="ti-arrow-left mr-2"></i> Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection