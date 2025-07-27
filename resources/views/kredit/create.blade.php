@extends('fe.master')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Form Tambah Kredit</h2>
        <a href="{{ route('pengajuan_kredit.saya') }}" class="btn btn-outline-secondary rounded-pill">← Kembali</a>
    </div>

    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body p-4">
            <form action="{{ route('kredit.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">
                @csrf

                {{-- Pengajuan Kredit --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Pengajuan Kredit</label>
                    <input type="hidden" name="id_pengajuan_kredit" value="{{ $idPengajuan }}">
                    <div class="form-control-plaintext px-3 py-2 bg-light border rounded-3">
                        {{ $namaPelanggan }} - {{ $namaMotor }}
                    </div>
                    @error('id_pengajuan_kredit') 
                        <small class="text-danger d-block">{{ $message }}</small> 
                    @enderror
                </div>

                {{-- Metode Pembayaran --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Metode Pembayaran</label>
                    <select name="id_metode_bayar" class="form-select rounded-3" required>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        @foreach($metodeBayar as $data)
                            <option value="{{ $data->id }}" {{ old('id_metode_bayar') == $data->id ? 'selected' : '' }}>
                                {{ $data->metode_pembayaran }} - {{ $data->no_rekening }} 
                            </option>
                        @endforeach
                    </select>
                    @error('id_metode_bayar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tanggal Mulai Kredit --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Mulai Kredit</label>
                    <input type="date" name="tgl_mulai_kredit" class="form-control rounded-3" value="{{ old('tgl_mulai_kredit') }}" required>
                    @error('tgl_mulai_kredit')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

{{-- <div class="form-group">
    <label>Jumlah DP</label>
    <input type="number" name="dp" class="form-control" value="{{ old('dp', $pengajuanKredit->dp ?? '') }}">
    @error('dp')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div> --}}
                {{-- Bukti Pembayaran DP --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Bukti Pembayaran DP</label>
                    <input type="file" class="form-control rounded-3" name="bukti_pembayaran_dp">
                    @error('bukti_pembayaran_dp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Status Kredit --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status Kredit</label>
                    <input type="text" class="form-control rounded-3 bg-light" name="status_kredit" value="Dicicil" readonly>
                    @error('status_kredit')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Keterangan Status Kredit</label>
                    <input type="text" name="keterangan_status_kredit" class="form-control rounded-3" value="{{ old('keterangan_status_kredit') }}">
                    @error('keterangan_status_kredit')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-4 rounded-pill">Simpan Kredit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
