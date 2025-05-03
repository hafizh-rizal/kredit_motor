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
            <h5>Edit Motor</h5>
            <span>Form untuk mengedit data motor</span>
        </div>
        <div class="card-body">
            <form action="{{ route('motor.update', $motor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Motor -->
                <div class="form-group">
                    <label for="nama_motor">Nama Motor</label>
                    <input type="text" name="nama_motor" class="form-control @error('nama_motor') is-invalid @enderror" id="nama_motor" value="{{ old('nama_motor', $motor->nama_motor) }}" required>
                    @error('nama_motor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <!-- Jenis Motor -->
                <div class="form-group">
                    <label for="id_jenis_motor">Jenis Motor</label>
                    <select name="id_jenis_motor" class="form-control @error('id_jenis_motor') is-invalid @enderror" id="id_jenis_motor" required>
                        <option value="">Pilih Jenis Motor</option>
                        @foreach($jenis_motor as $jenis)
                            <option value="{{ $jenis->id }}" {{ $motor->id_jenis_motor == $jenis->id ? 'selected' : '' }}>{{ $jenis->jenis }}</option>
                        @endforeach
                    </select>
                    @error('id_jenis_motor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <!-- Harga Jual -->
                <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" value="{{ old('harga_jual', $motor->harga_jual) }}" required>
                    @error('harga_jual')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <!-- Deskripsi Motor -->
                <div class="form-group">
                    <label for="deskripsi_motor">Deskripsi Motor</label>
                    <textarea name="deskripsi_motor" class="form-control @error('deskripsi_motor') is-invalid @enderror" id="deskripsi_motor" required>{{ old('deskripsi_motor', $motor->deskripsi_motor) }}</textarea>
                    @error('deskripsi_motor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <!-- Warna -->
                <div class="form-group">
                    <label for="warna">Warna</label>
                    <textarea name="warna" class="form-control @error('warna') is-invalid @enderror" id="warna" required>{{ old('warna', $motor->warna) }}</textarea>
                    @error('warna')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <!-- Kapasitas Mesin -->
                <div class="form-group">
                    <label for="kapasitas_mesin">Kapasitas Mesin</label>
                    <input type="text" name="kapasitas_mesin" class="form-control @error('kapasitas_mesin') is-invalid @enderror" id="kapasitas_mesin" value="{{ old('kapasitas_mesin', $motor->kapasitas_mesin) }}" required>
                    @error('kapasitas_mesin')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <!-- Foto 1 -->
                <div class="form-group">
                    <label for="foto1">Foto 1</label>
                    <input type="file" name="foto1" class="form-control @error('foto1') is-invalid @enderror" id="foto1">
                    @error('foto1')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    @if($motor->foto1)
                        <img src="{{ asset('storage/' . $motor->foto1) }}" alt="Foto 1" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>

                <!-- Foto 2 -->
                <div class="form-group">
                    <label for="foto2">Foto 2</label>
                    <input type="file" name="foto2" class="form-control @error('foto2') is-invalid @enderror" id="foto2">
                    @error('foto2')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    @if($motor->foto2)
                        <img src="{{ asset('storage/' . $motor->foto2) }}" alt="Foto 2" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>

                <!-- Foto 3 -->
                <div class="form-group">
                    <label for="foto3">Foto 3</label>
                    <input type="file" name="foto3" class="form-control @error('foto3') is-invalid @enderror" id="foto3">
                    @error('foto3')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    @if($motor->foto3)
                        <img src="{{ asset('storage/' . $motor->foto3) }}" alt="Foto 3" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>

                <!-- Stok -->
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" id="stok" value="{{ old('stok', $motor->stok) }}" required>
                    @error('stok')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group text-center">
                    <!-- Button Save & Cancel -->
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('motor.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
