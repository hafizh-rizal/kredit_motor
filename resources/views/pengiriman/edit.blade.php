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
                    <input type="text" name="invoice" class="form-control @error('invoice') is-invalid @enderror" id="invoice" value="{{ old('invoice', $pengiriman->invoice) }}" required>
                    @error('invoice')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="tgl_kirim">Tanggal Kirim</label>
                    <input type="datetime-local" name="tgl_kirim" class="form-control @error('tgl_kirim') is-invalid @enderror" id="tgl_kirim" value="{{ old('tgl_kirim', \Carbon\Carbon::parse($pengiriman->tgl_kirim)->format('Y-m-d\TH:i')) }}" required>
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
                    <input type="text" name="nama_kurir" class="form-control @error('nama_kurir') is-invalid @enderror" id="nama_kurir" value="{{ old('nama_kurir', $pengiriman->nama_kurir) }}" required>
                    @error('nama_kurir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="telpon_kurir">Telpon Kurir</label>
                    <input type="number" name="telpon_kurir" class="form-control @error('telpon_kurir') is-invalid @enderror" id="telpon_kurir" value="{{ old('telpon_kurir', $pengiriman->telpon_kurir) }}" required>
                    @error('telpon_kurir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                    <div class="form-group">
                        <label for="bukti_foto">Bukti Foto</label>
                        @if($pengiriman->bukti_foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $pengiriman->bukti_foto) }}" alt="Bukti Foto" width="100" class="img-thumbnail">
                            </div>
                        @endif
                        <input type="file" name="bukti_foto" class="form-control @error('bukti_foto') is-invalid @enderror" id="bukti_foto">
                        @error('bukti_foto')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan">{{ old('keterangan', $pengiriman->keterangan) }}</textarea>
                    @error('keterangan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="id_kredit">Kredit (Pelanggan - Motor)</label>
                    <select name="id_kredit" id="id_kredit" class="form-control @error('id_kredit') is-invalid @enderror" required>
                        <option value="">-- Pilih Kredit --</option>
                        @foreach($kredit as $item)
                        <<option value="{{ $item->id }}" {{ old('id_kredit') == $item->id ? 'selected' : '' }}>
                            {{ $item->id }} - 
                            {{ optional($item->pengajuanKredit->pelanggan)->nama_pelanggan ?? 'Pelanggan Tidak Diketahui' }} - 
                            {{ optional($item->pengajuanKredit->motor)->nama_motor ?? 'Motor Tidak Diketahui' }}
                        </option>                        
                        @endforeach
                    </select>
                    @error('id_kredit')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
