@extends('fe.master')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body p-5">
            <h3 class="mb-4 fw-bold text-primary">🧾 Form Pembayaran Angsuran</h3>

            @if(session('error'))
                <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
            @endif

            <form action="{{ route('angsuran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @php
                    $kreditTerpilihObj = $kredits->firstWhere('id', old('id_kredit', $kreditTerpilih ?? null));
                    $namaMotor = $kreditTerpilihObj->pengajuanKredit->motor->nama_motor ?? 'Motor';
                    $idKredit = $kreditTerpilihObj->id ?? '';
                    $lastAngsuran = $kreditTerpilihObj->angsuran->sortByDesc('angsuran_ke')->first();
                    $nextAngsuranKe = $lastAngsuran ? $lastAngsuran->angsuran_ke + 1 : 1;
                    $nextTanggalBayar = $lastAngsuran ? \Carbon\Carbon::parse($lastAngsuran->tgl_bayar)->addMonth()->format('Y-m-d') : now()->format('Y-m-d');
                    $cicilan = $kreditTerpilihObj->pengajuanKredit->cicilan_perbulan ?? 0;
                @endphp

                <div class="row g-4">
                    <div class="col-md-6">
                        <input type="hidden" name="id_kredit" value="{{ $idKredit }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kredit Terpilih</label>
                            <div class="form-control-plaintext border rounded py-2 px-3 bg-light">
                                <span class="text-dark">{{ $idKredit }} - {{ $namaMotor }}</span>
                            </div>
                            @error('id_kredit') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tgl_bayar" class="form-label fw-semibold">Tanggal Bayar</label>
                            <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control" value="{{ old('tgl_bayar', $nextTanggalBayar) }}" readonly>
                            @error('tgl_bayar') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="angsuran_ke" class="form-label fw-semibold">Angsuran Ke</label>
                            <input type="number" name="angsuran_ke" id="angsuran_ke" class="form-control" value="{{ old('angsuran_ke', $nextAngsuranKe) }}" readonly>
                            @error('angsuran_ke') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_bayar" class="form-label fw-semibold">Total Bayar</label>
                            <input type="number" step="0.01" name="total_bayar" id="total_bayar" class="form-control" value="{{ old('total_bayar', $cicilan) }}" readonly>
                            @error('total_bayar') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label fw-semibold">Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" accept="image/*">
                            <small class="text-muted">Hanya file JPG, JPEG, PNG</small>
                            @error('bukti_pembayaran') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status_pembayaran" class="form-label fw-semibold">Status Pembayaran</label>
                            <input type="text" name="status_pembayaran" id="status_pembayaran" class="form-control" value="Menunggu" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan (Opsional)</label>
                            <textarea name="keterangan" class="form-control" rows="4" placeholder="Tulis keterangan jika ada...">{{ old('keterangan') }}</textarea>
                            @error('keterangan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('home.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-credit-card me-1"></i> Bayar Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
