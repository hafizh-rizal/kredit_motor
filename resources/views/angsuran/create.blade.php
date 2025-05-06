@extends('fe.master')

@section('content')
<div class="card mb-5">
    <div class="card-body">
        <form action="{{ route('angsuran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h4 class="card-title mb-4">Form Pembayaran Angsuran</h4>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="id_kredit">Pilih Kredit</label>
                        <select name="id_kredit" class="form-control @error('id_kredit') is-invalid @enderror" required>
                            <option value="">-- Pilih Kredit --</option>
                            @foreach($kredits as $kredit)
                            <option 
                                value="{{ $kredit->id }}"
                                data-angsuran="{{ $kredit->pengajuanKredit->cicilan_perbulan }}"
                                {{ old('id_kredit', $kreditTerpilih ?? '') == $kredit->id ? 'selected' : '' }}>
                                {{ $kredit->id }} - {{ $kredit->pengajuanKredit->motor->nama_motor ?? 'Motor' }}
                            </option>
                        @endforeach                        
                        </select>
                        @error('id_kredit') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tgl_bayar">Tanggal Bayar</label>
                        <input type="date" name="tgl_bayar" class="form-control @error('tgl_bayar') is-invalid @enderror" value="{{ old('tgl_bayar') }}" required>
                        @error('tgl_bayar') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="angsuran_ke">Angsuran Ke</label>
                        <input type="number" name="angsuran_ke" class="form-control @error('angsuran_ke') is-invalid @enderror" value="{{ old('angsuran_ke') }}" required>
                        @error('angsuran_ke') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="total_bayar">Total Bayar</label>
                        <input type="number" step="0.01" name="total_bayar" id="total_bayar" class="form-control @error('total_bayar') is-invalid @enderror" value="{{ old('total_bayar') }}" required readonly>
                        @error('total_bayar') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="bukti_pembayaran">Bukti Pembayaran</label>
                        <input type="file" name="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror" accept="image/*">
                        @error('bukti_pembayaran') <small class="text-danger">{{ $message }}</small> @enderror
                        <small class="text-muted">Upload bukti pembayaran (JPG, JPEG, PNG)</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status_pembayaran">Status Pembayaran</label>
                        <input type="text" name="status_pembayaran" class="form-control" value="Menunggu" readonly>
                    </div>                    
                    <div class="form-group mb-3">
                        <label for="keterangan">Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
            <a href="{{ route('home.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectKredit = document.querySelector('select[name="id_kredit"]');
        const inputTotalBayar = document.getElementById('total_bayar');

        function updateTotalBayar() {
            const selectedOption = selectKredit.options[selectKredit.selectedIndex];
            const angsuran = selectedOption.getAttribute('data-angsuran');
            inputTotalBayar.value = angsuran || '';
        }

        selectKredit.addEventListener('change', updateTotalBayar);

        updateTotalBayar();
    });
</script>
@endpush

@endsection
