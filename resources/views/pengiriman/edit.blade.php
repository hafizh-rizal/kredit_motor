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
            <h5>Edit Pengiriman</h5>
            <span>Form untuk mengedit data pengiriman</span>
        </div>
        <div class="card-body">
            <form action="{{ route('pengiriman.update', $pengiriman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="invoice">Invoice</label>
                    <input type="text" name="invoice" class="form-control @error('invoice') is-invalid @enderror" id="invoice" value="{{ old('invoice', $pengiriman->invoice) }}" readonly>
                    @error('invoice')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="tgl_kirim">Tanggal Kirim</label>
                    <input type="datetime-local" name="tgl_kirim" class="form-control @error('tgl_kirim') is-invalid @enderror" id="tgl_kirim" value="{{ old('tgl_kirim', \Carbon\Carbon::parse($pengiriman->tgl_kirim)->format('Y-m-d\TH:i')) }}" required readonly>
                    @error('tgl_kirim')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="status_kirim">Status Kirim</label>
                    <select name="status_kirim" id="status_kirim" class="form-control @error('status_kirim') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Sedang Dikirim" {{ old('status_kirim', $pengiriman->status_kirim) == 'Sedang Dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                        <option value="Tiba Di Tujuan" {{ old('status_kirim', $pengiriman->status_kirim) == 'Tiba Di Tujuan' ? 'selected' : '' }}>Tiba Di Tujuan</option>
                    </select>
                    @error('status_kirim')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="nama_kurir">Nama Kurir</label>
                    <input type="text" name="nama_kurir" class="form-control @error('nama_kurir') is-invalid @enderror" id="nama_kurir" value="{{ old('nama_kurir', $pengiriman->nama_kurir) }}" required readonly>
                    @error('nama_kurir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="telpon_kurir">Telpon Kurir</label>
                    <input type="number" name="telpon_kurir" class="form-control @error('telpon_kurir') is-invalid @enderror" id="telpon_kurir" value="{{ old('telpon_kurir', $pengiriman->telpon_kurir) }}" required readonly>
                    @error('telpon_kurir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="bukti_foto">Bukti Foto Saat Tiba</label><br>

                    {{-- Preview kamera --}}
                    <video id="video" width="300" autoplay></video><br>
                    <button type="button" class="btn btn-sm btn-primary mt-2" onclick="takePhoto()">Ambil Foto</button>
                    <canvas id="canvas" style="display:none;"></canvas>
                    <input type="hidden" name="bukti_foto_data" id="bukti_foto_data">

                    <p class="text-muted mt-3">Atau pilih file secara manual:</p>
                    <input type="file" name="bukti_foto" class="form-control @error('bukti_foto') is-invalid @enderror" accept="image/*">
                    @error('bukti_foto')<span class="invalid-feedback">{{ $message }}</span>@enderror

                    @if($pengiriman->bukti_foto)
                        <p class="mt-3">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $pengiriman->bukti_foto) }}" alt="Foto Bukti" class="img-fluid" style="max-width: 300px;">
                    @endif
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan">{{ old('keterangan', $pengiriman->keterangan) }}</textarea>
                    @error('keterangan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

               {{-- ID Kredit (readonly tampilan, hidden input untuk submit) --}}
<div class="form-group">
    <label for="id_kredit">Kredit (Pelanggan - Motor)</label>

    <input type="text" class="form-control" 
        value="{{ $pengiriman->kredit->id }} - {{ $pengiriman->kredit->pengajuanKredit->pelanggan->nama_pelanggan }} - {{ $pengiriman->kredit->pengajuanKredit->motor->nama_motor }}" 
        readonly>

    <input type="hidden" name="id_kredit" value="{{ $pengiriman->id_kredit }}">

    @error('id_kredit')<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

{{-- Alamat Pengiriman (readonly) --}}
@php
    $pengajuan = $pengiriman->kredit->pengajuanKredit;
    $pel = $pengajuan?->pelanggan;
    $field = $pengajuan?->alamat_pengiriman;
    $alamatLengkap = match($field) {
        'alamat1' => "{$pel->alamat1}, {$pel->kota1}, {$pel->propinsi1}, {$pel->kodepos1}",
        'alamat2' => "{$pel->alamat2}, {$pel->kota2}, {$pel->propinsi2}, {$pel->kodepos2}",
        'alamat3' => "{$pel->alamat3}, {$pel->kota3}, {$pel->propinsi3}, {$pel->kodepos3}",
        default => '-',
    };
@endphp

<div class="form-group">
    <label for="alamat_pengiriman">Alamat Pengiriman</label>
    <input type="text" id="alamat_pengiriman" class="form-control" value="{{ $alamatLengkap }}" readonly>
</div>


                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

{{-- Script kamera & alamat --}}
<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const buktiFotoInput = document.getElementById('bukti_foto_data');

    navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            alert("Tidak bisa mengakses kamera: " + err.message);
        });

    function takePhoto() {
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = canvas.toDataURL('image/jpeg');
        buktiFotoInput.value = imageData;
        alert("Foto berhasil diambil. Klik Update untuk menyimpan.");
    }

    function updateAlamat() {
        const selected = document.getElementById('id_kredit').selectedOptions[0];
        const alamat = selected.getAttribute('data-alamat') || '';
        document.getElementById('alamat_pengiriman').value = alamat;
    }

    document.getElementById('id_kredit').addEventListener('change', updateAlamat);
    window.addEventListener('DOMContentLoaded', updateAlamat);
</script>
@endsection
