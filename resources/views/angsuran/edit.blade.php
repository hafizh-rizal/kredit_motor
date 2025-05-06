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
                <h5>Edit Angsuran</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('angsuran.update', $angsuran->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="id_kredit">Kredit</label>
                        <select name="id_kredit" id="id_kredit" class="form-control @error('id_kredit') is-invalid @enderror" required>
                            @foreach($kredits as $kredit)
                                <option value="{{ $kredit->id }}" {{ old('id_kredit', $angsuran->id_kredit) == $kredit->id ? 'selected' : '' }}>
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
                        <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control @error('tgl_bayar') is-invalid @enderror"
                            value="{{ old('tgl_bayar', $angsuran->tgl_bayar) }}" required>
                        @error('tgl_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="angsuran_ke">Angsuran Ke</label>
                        <input type="number" name="angsuran_ke" id="angsuran_ke" class="form-control @error('angsuran_ke') is-invalid @enderror"
                            value="{{ old('angsuran_ke', $angsuran->angsuran_ke) }}" required>
                        @error('angsuran_ke')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_bayar">Total Bayar</label>
                        <input type="number" step="0.01" name="total_bayar" id="total_bayar" class="form-control @error('total_bayar') is-invalid @enderror"
                            value="{{ old('total_bayar', $angsuran->total_bayar) }}" required>
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
                        <small class="text-muted">Upload file bukti pembayaran (JPG, PNG, JPEG).  Current:
                            @if($angsuran->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $angsuran->bukti_pembayaran) }}" target="_blank">
                                     View
                                </a>
                            @else
                                None
                            @endif
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $angsuran->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_pembayaran">Status Pembayaran</label>
                        <select name="status_pembayaran" id="status_pembayaran" class="form-control @error('status_pembayaran') is-invalid @enderror" required>
                            <option value="Menunggu" {{ old('status_pembayaran', $angsuran->status_pembayaran) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="Diterima" {{ old('status_pembayaran', $angsuran->status_pembayaran) == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Ditolak" {{ old('status_pembayaran', $angsuran->status_pembayaran) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('angsuran.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
