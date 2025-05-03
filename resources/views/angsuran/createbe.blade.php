@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="page-body">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Form Tambah Angsuran</h5>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('angsuran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="id_kredit">Kredit</label>
                        <select name="id_kredit" class="form-control @error('id_kredit') is-invalid @enderror" required>
                            <option value="">-- Pilih Kredit --</option>
                            @foreach($kredits as $kredit)
                                <option value="{{ $kredit->id }}" {{ old('id_kredit') == $kredit->id ? 'selected' : '' }}>
                                    {{ $kredit->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kredit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tgl_bayar">Tanggal Bayar</label>
                        <input type="date" name="tgl_bayar" class="form-control @error('tgl_bayar') is-invalid @enderror"
                            value="{{ old('tgl_bayar') }}" required>
                        @error('tgl_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="angsuran_ke">Angsuran Ke</label>
                        <input type="number" name="angsuran_ke" class="form-control @error('angsuran_ke') is-invalid @enderror"
                            value="{{ old('angsuran_ke') }}" required>
                        @error('angsuran_ke')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_bayar">Total Bayar</label>
                        <input type="number" step="0.01" name="total_bayar" class="form-control @error('total_bayar') is-invalid @enderror"
                            value="{{ old('total_bayar') }}" required>
                        @error('total_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="bukti_pembayaran">Bukti Pembayaran</label>
                        <input type="file" name="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror" accept="image/*">
                        @error('bukti_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Upload file bukti pembayaran (JPG, PNG, JPEG).</small>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('angsuran.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
