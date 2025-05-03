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
            <form action="{{ route('kredit.update', $kredit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Pengajuan Kredit -->
                <div class="form-group">
                    <label>Pengajuan Kredit</label>
                    <select name="id_pengajuan_kredit" class="form-control" required>
                        <option value="">-- Pilih Pengajuan Kredit --</option>
                        @foreach($pengajuanKredit as $data)
                            <option value="{{ $data->id }}"
                                {{ $kredit->id_pengajuan_kredit == $data->id ? 'selected' : '' }}>
                                {{ $data->pelanggan->nama_pelanggan }} - {{ $data->motor->nama_motor }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Metode Bayar -->
                <div class="form-group">
                    <label>Metode Pembayaran</label>
                    <select name="id_metode_bayar" class="form-control" required>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        @foreach($metodeBayar as $data)
                            <option value="{{ $data->id }}"
                                {{ $kredit->id_metode_bayar == $data->id ? 'selected' : '' }}>
                                {{ $data->metode_pembayaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Mulai -->
                <div class="form-group">
                    <label>Tanggal Mulai Kredit</label>
                    <input type="date" name="tgl_mulai_kredit" class="form-control"
                        value="{{ $kredit->tgl_mulai_kredit }}" required>
                </div>

                <!-- Tanggal Selesai -->
                <div class="form-group">
                    <label>Tanggal Selesai Kredit</label>
                    <input type="date" name="tgl_selesai_kredit" class="form-control"
                        value="{{ $kredit->tgl_selesai_kredit }}" required>
                </div>

                <!-- Sisa Kredit -->
                <div class="form-group">
                    <label>Sisa Kredit (Rp)</label>
                    <input type="number" name="sisa_kredit" class="form-control"
                        value="{{ $kredit->sisa_kredit }}" required>
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

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('kredit.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
