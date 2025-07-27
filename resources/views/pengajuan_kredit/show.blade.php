@extends('fe.master')

@section('content')
<div class="container my-5">
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-5">
            <h2 class="text-primary fw-bold mb-4">
                <i class="fas fa-file-alt me-2"></i> Detail Pengajuan Kredit
            </h2>

            {{-- Informasi Pelanggan & Motor --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-user-circle fa-lg text-secondary me-3"></i>
                        <div>
                            <div class="text-muted">Pelanggan</div>
                            <div class="fw-semibold text-dark">{{ $pengajuanKredit->pelanggan->nama_pelanggan }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-motorcycle fa-lg text-info me-3"></i>
                        <div>
                            <div class="text-muted">Motor</div>
                            <div class="fw-semibold text-dark">{{ $pengajuanKredit->motor->nama_motor }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Harga --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-tag fa-lg text-success me-3"></i>
                        <div>
                            <div class="text-muted">Harga Kredit</div>
                            <div class="fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->harga_kredit, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-money-bill-wave fa-lg text-warning me-3"></i>
                        <div>
                            <div class="text-muted">Harga Cash</div>
                            <div class="fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->harga_cash, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DP & Cicilan --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-hand-holding-usd fa-lg text-primary me-3"></i>
                        <div>
                            <div class="text-muted">DP</div>
                            <div class="fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->dp, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-calendar-alt fa-lg text-secondary me-3"></i>
                        <div>
                            <div class="text-muted">Jenis Cicilan</div>
                            <div class="fw-semibold text-dark">{{ $pengajuanKredit->jenisCicilan->lama_cicilan }} Bulan</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Asuransi --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-shield-alt fa-lg text-info me-3"></i>
                        <div>
                            <div class="text-muted">Asuransi</div>
                            <div class="fw-semibold text-dark">{{ $pengajuanKredit->asuransi->nama_asuransi ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-coins fa-lg text-success me-3"></i>
                        <div>
                            <div class="text-muted">Cicilan / Bulan</div>
                            <div class="fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->cicilan_perbulan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Biaya & Status --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-money-check-alt fa-lg text-warning me-3"></i>
                        <div>
                            <div class="text-muted">Biaya Asuransi</div>
                            <div class="fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->biaya_asuransi, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-box">
                        <i class="fas fa-check-circle fa-lg text-success me-3"></i>
                        <div>
                            <div class="text-muted">Status Pengajuan</div>
                            @php
                                $class = match($pengajuanKredit->status_pengajuan) {
                                    'Menunggu Konfirmasi' => 'bg-warning text-dark',
                                    'Diproses' => 'bg-primary text-white',
                                    'Dibatalkan Pembeli', 'Dibatalkan Penjual' => 'bg-danger text-white',
                                    'Bermasalah' => 'bg-dark text-white',
                                    'Diterima' => 'bg-success text-white',
                                    default => 'bg-secondary text-white',
                                };
                                $icon = match($pengajuanKredit->status_pengajuan) {
                                    'Menunggu Konfirmasi' => 'fa-clock',
                                    'Diproses' => 'fa-cog fa-spin',
                                    'Dibatalkan Pembeli', 'Dibatalkan Penjual' => 'fa-times-circle',
                                    'Bermasalah' => 'fa-exclamation-triangle',
                                    'Diterima' => 'fa-check-double',
                                    default => 'fa-question-circle',
                                };
                            @endphp
                            <span class="badge rounded-pill {{ $class }}">
                                <i class="fas {{ $icon }} me-1"></i> {{ $pengajuanKredit->status_pengajuan }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="mb-4">
                <div class="info-box align-items-start">
                    <i class="fas fa-info-circle fa-lg text-info me-3 mt-1"></i>
                    <div>
                        <div class="text-muted">Keterangan Status</div>
                        <div class="fw-semibold text-dark">{!! $pengajuanKredit->keterangan_status_pengajuan ?? '<span class="text-muted fst-italic">Tidak ada keterangan</span>' !!}</div>
                    </div>
                </div>
            </div>

            {{-- Alamat Pengiriman --}}
            <div class="mb-4">
                <div class="info-box align-items-start">
                    <i class="fas fa-map-marker-alt fa-lg text-danger me-3 mt-1"></i>
                    <div>
                        <div class="text-muted">Alamat Pengiriman</div>
                        <div class="fw-semibold text-dark">
                            @php
                                $alamat = match($pengajuanKredit->alamat_pengiriman) {
                                    'alamat1' => "{$pengajuanKredit->pelanggan->alamat1}, {$pengajuanKredit->pelanggan->kota1}, {$pengajuanKredit->pelanggan->propinsi1}, {$pengajuanKredit->pelanggan->kodepos1}",
                                    'alamat2' => "{$pengajuanKredit->pelanggan->alamat2}, {$pengajuanKredit->pelanggan->kota2}, {$pengajuanKredit->pelanggan->propinsi2}, {$pengajuanKredit->pelanggan->kodepos2}",
                                    'alamat3' => "{$pengajuanKredit->pelanggan->alamat3}, {$pengajuanKredit->pelanggan->kota3}, {$pengajuanKredit->pelanggan->propinsi3}, {$pengajuanKredit->pelanggan->kodepos3}",
                                    default => '<span class="text-muted fst-italic">Alamat tidak diketahui</span>',
                                };
                            @endphp
                            {!! $alamat !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-4">
                <a href="{{ route('pengajuan_kredit.saya') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Produk
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        .info-box {
            display: flex;
            align-items: center;
            background: #f9fafd;
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.05);
            transition: all 0.2s ease-in-out;
        }
        .info-box:hover {
            background-color: #eef5ff;
        }
        .badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            letter-spacing: 0.5px;
        }
    </style>
@endsection
