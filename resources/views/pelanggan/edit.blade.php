@extends('fe.master')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0">Edit Profil Pelanggan</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" class="form-control rounded-3" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}">
                    @error('nama_pelanggan') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control rounded-3" value="{{ old('email', $pelanggan->email) }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Kata Kunci -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kata Kunci (opsional)</label>
                    <input type="password" name="kata_kunci" class="form-control rounded-3">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah kata kunci.</small>
                    @error('kata_kunci') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- No Telp -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">No Telepon</label>
                    <input type="text" name="no_telp" class="form-control rounded-3" value="{{ old('no_telp', $pelanggan->no_telp) }}">
                    @error('no_telp') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Alamat 1 -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Alamat Utama</label>
                    <input type="text" name="alamat1" class="form-control rounded-3 mb-2" value="{{ old('alamat1', $pelanggan->alamat1) }}">

                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="kota1" class="form-control rounded-3" placeholder="Kota" value="{{ old('kota1', $pelanggan->kota1) }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="propinsi1" class="form-control rounded-3" placeholder="Propinsi" value="{{ old('propinsi1', $pelanggan->propinsi1) }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="kodepos1" class="form-control rounded-3" placeholder="Kodepos" value="{{ old('kodepos1', $pelanggan->kodepos1) }}">
                        </div>
                    </div>
                </div>

                <!-- Alamat 2 & 3 -->
                @for ($i = 2; $i <= 3; $i++)
                <div class="mb-4">
                    <h6 class="fw-semibold">Alamat {{ $i }} (opsional)</h6>
                    <input type="text" name="alamat{{ $i }}" class="form-control rounded-3 mb-2" value="{{ old("alamat$i", $pelanggan["alamat$i"]) }}">

                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="kota{{ $i }}" class="form-control rounded-3" placeholder="Kota" value="{{ old("kota$i", $pelanggan["kota$i"]) }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="propinsi{{ $i }}" class="form-control rounded-3" placeholder="Propinsi" value="{{ old("propinsi$i", $pelanggan["propinsi$i"]) }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="kodepos{{ $i }}" class="form-control rounded-3" placeholder="Kodepos" value="{{ old("kodepos$i", $pelanggan["kodepos$i"]) }}">
                        </div>
                    </div>
                </div>
                @endfor

                <!-- Foto -->
                <div class="mb-4">
                    <label class="form-label fw-semibold d-block">Foto Profil</label>
                    @if($pelanggan->foto)
                        <img src="{{ asset('storage/' . $pelanggan->foto) }}" class="img-thumbnail mb-2" style="width: 100px; height: 100px; object-fit: cover;">
                    @endif
                    <input type="file" name="foto" class="form-control rounded-3">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                    @error('foto') <br><small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('home.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
