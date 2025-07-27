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
            <h5>Form Edit Kredit</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('kredit.update', $kredit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Pengajuan Kredit -->
             <div class="form-group">
    <label>Pengajuan Kredit</label>
    <select name="id_pengajuan_kredit_disabled" class="form-control" disabled>
        <option>
            {{ $kredit->pengajuanKredit->pelanggan->nama_pelanggan }} - {{ $kredit->pengajuanKredit->motor->nama_motor }}
        </option>
    </select>
    <input type="hidden" name="id_pengajuan_kredit" value="{{ $kredit->id_pengajuan_kredit }}">
</div>


                <!-- Metode Bayar -->
            <div class="form-group">
    <label>Metode Pembayaran</label>
    <select name="id_metode_bayar_disabled" class="form-control" disabled>
        <option>
            {{ $kredit->metodeBayar->metode_pembayaran }}
        </option>
    </select>
    <input type="hidden" name="id_metode_bayar" value="{{ $kredit->id_metode_bayar }}">
</div>


                <!-- Tanggal Mulai -->
                <div class="form-group">
                    <label>Tanggal Mulai Kredit</label>
                    <input type="date" name="tgl_mulai_kredit" class="form-control"
                        value="{{ $kredit->tgl_mulai_kredit }}" required readonly>
                </div>

                <!-- Tanggal Selesai Kredit (hanya info) -->
                <div class="form-group">
                    <label>Tanggal Selesai Kredit</label>
                    <input type="text" class="form-control" value="{{ $kredit->tgl_selesai_kredit }}" readonly>
                </div>

                <!-- Jumlah DP -->
                <div class="form-group">
                    <label>Jumlah DP</label>
                    <input type="number" name="jumlah_dp" class="form-control" value="{{ $kredit->dp }}" readonly>
                </div>

                <!-- Bukti Pembayaran DP -->
                {{-- <div class="form-group">
                    <label>Bukti Pembayaran DP</label><br>
                    @if($kredit->bukti_pembayaran_dp)
                        <a href="{{ asset('storage/' . $kredit->bukti_pembayaran_dp) }}" target="_blank">Lihat Bukti</a><br>
                    @endif
                    <input type="file" name="bukti_pembayaran_dp" class="form-control-file mt-2">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah bukti.</small>
                </div> --}}

                <!-- Status Pembayaran DP -->
                <div class="form-group">
                    <label>Status Pembayaran DP</label>
                    <select name="status_pembayaran_dp" class="form-control" required>
                        <option value="Belum Dibayar" {{ $kredit->status_pembayaran_dp == 'Belum Dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                        <option value="Menunggu Verifikasi"{{ $kredit->status_pembayaran_dp == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="Sudah Dibayar" {{ $kredit->status_pembayaran_dp == 'Sudah Dibayar' ? 'selected' : '' }}>Sudah Dibayar</option>
                    </select>
                </div>

                <!-- Sisa Kredit (readonly) -->
                <div class="form-group">
                    <label>Sisa Kredit</label>
                    <input type="text" class="form-control" value="Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }}" readonly>
                </div>

                <!-- Status Kredit -->
                <div class="form-group">
                    <label>Status Kredit</label>
                    <select name="status_kredit" class="form-control" required>
                        <option value="Dicicil" {{ $kredit->status_kredit == 'Dicicil' ? 'selected' : '' }}>Dicicil</option>
                        <option value="Macet" {{ $kredit->status_kredit == 'Macet' ? 'selected' : '' }}>Macet</option>
                        <option value="Lunas" {{ $kredit->status_kredit == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <!-- Keterangan Status Kredit -->
                <div class="form-group">
                    <label>Keterangan Status Kredit</label>
                    <input type="text" name="keterangan_status_kredit" class="form-control"
                        value="{{ $kredit->keterangan_status_kredit }}" required>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('kredit.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
