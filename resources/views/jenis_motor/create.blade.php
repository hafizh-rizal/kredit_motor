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
            <h5><i class="ti-plus mr-2"></i> Form Tambah Jenis Motor</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis_motor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Merk</label>
                    <div class="col-sm-10">
                        <input type="text" name="merk" class="form-control" required placeholder="Masukkan Merk Motor">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach(['Bebek', 'Skuter', 'Dual Sport', 'Naked Sport', 'Sport Bike', 'Retro', 'Cruiser', 'Sport Touring', 'Dirt Bike', 'Motocross', 'Scrambler', 'ATV', 'Motor Adventure', 'Lainnya'] as $jenis)
                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi_jenis" class="form-control" placeholder="Masukkan Deskripsi (opsional)"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Upload Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" name="image_url" class="form-control">
                        <small class="form-text text-muted">Format file: JPG, PNG, GIF. Ukuran maksimal: (sesuaikan dengan konfigurasi Anda).</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary"><i class="ti-save mr-2"></i> Simpan</button>
                        <a href="{{ route('jenis_motor.index') }}" class="btn btn-secondary ml-2"><i class="ti-arrow-left mr-2"></i> Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection