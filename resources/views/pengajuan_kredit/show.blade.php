@extends('fe.master')

@section('content')
<div class="card shadow-lg rounded-3 border-0">
    <div class="card-body p-5">
        <h4 class="card-title mb-5 text-primary fw-bold" style="letter-spacing: 0.5px;">Detail Pengajuan Kredit</h4>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user-circle fa-lg text-secondary me-3"></i>
                    <div>
                        <strong class="text-muted">Pelanggan:</strong>
                        <p class="mb-0 fw-semibold text-dark">{{ $pengajuanKredit->pelanggan->nama_pelanggan }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-motorcycle fa-lg text-info me-3"></i>
                    <div>
                        <strong class="text-muted">Motor:</strong>
                        <p class="mb-0 fw-semibold text-dark">{{ $pengajuanKredit->motor->nama_motor }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-tag fa-lg text-success me-3"></i>
                    <div>
                        <strong class="text-muted">Harga Kredit:</strong>
                        <p class="mb-0 fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->harga_kredit, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-money-bill-wave fa-lg text-warning me-3"></i>
                    <div>
                        <strong class="text-muted">Harga Cash:</strong>
                        <p class="mb-0 fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->harga_cash, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-hand-holding-usd fa-lg text-primary me-3"></i>
                    <div>
                        <strong class="text-muted">DP:</strong>
                        <p class="mb-0 fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->dp, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-calendar-alt fa-lg text-secondary me-3"></i>
                    <div>
                        <strong class="text-muted">Jenis Cicilan:</strong>
                        <p class="mb-0 fw-semibold text-dark">{{ $pengajuanKredit->jenisCicilan->lama_cicilan }} Bulan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-shield-alt fa-lg text-info me-3"></i>
                    <div>
                        <strong class="text-muted">Asuransi:</strong>
                        <p class="mb-0 fw-semibold text-dark">{{ $pengajuanKredit->asuransi ? $pengajuanKredit->asuransi->nama_asuransi : '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-coins fa-lg text-success me-3"></i>
                    <div>
                        <strong class="text-muted">Cicilan / Bulan:</strong>
                        <p class="mb-0 fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->cicilan_perbulan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-money-check-alt fa-lg text-warning me-3"></i>
                    <div>
                        <strong class="text-muted">Biaya Asuransi:</strong>
                        <p class="mb-0 fw-semibold text-dark">Rp {{ number_format($pengajuanKredit->biaya_asuransi, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fa-lg me-3" style="color: #28a745;"></i>
                    <div>
                        <strong class="text-muted">Status Pengajuan:</strong>
                        @php
                            $statusClass = '';
                            $statusIcon = '';
                            if ($pengajuanKredit->status_pengajuan == 'Menunggu Konfirmasi') {
                                $statusClass = 'bg-warning text-dark';
                                $statusIcon = 'fa-clock';
                            } elseif ($pengajuanKredit->status_pengajuan == 'Diproses') {
                                $statusClass = 'bg-primary text-white';
                                $statusIcon = 'fa-cog fa-spin';
                            } elseif (in_array($pengajuanKredit->status_pengajuan, ['Dibatalkan Pembeli', 'Dibatalkan Penjual'])) {
                                $statusClass = 'bg-danger text-white';
                                $statusIcon = 'fa-times-circle';
                            } elseif ($pengajuanKredit->status_pengajuan == 'Bermasalah') {
                                $statusClass = 'bg-dark text-white';
                                $statusIcon = 'fa-exclamation-triangle';
                            } elseif ($pengajuanKredit->status_pengajuan == 'Diterima') {
                                $statusClass = 'bg-success text-white';
                                $statusIcon = 'fa-check-double';
                            } else {
                                $statusClass = 'bg-light text-dark border';
                                $statusIcon = 'fa-question-circle';
                            }
                        @endphp
                        <span class="badge rounded-pill {{ $statusClass }}">
                            <i class="{{ $statusIcon }} me-1"></i> {{ $pengajuanKredit->status_pengajuan }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <strong class="text-muted"><i class="fas fa-info-circle fa-lg text-info me-2"></i> Keterangan Status Pengajuan:</strong>
            <p class="mt-2 fw-semibold text-dark" style="line-height: 1.6;">{{ $pengajuanKredit->keterangan_status_pengajuan ?? '<span class="text-muted fst-italic">Tidak ada keterangan</span>' }}</p>
        </div>

        <div class="form-group mt-4">
            <a href="{{ route('pengajuan_kredit.saya') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold"><i class="fas fa-arrow-left me-2"></i> Kembali ke Produk</a>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .card {
            background-color: #f0f8ff; /* Warna latar belakang card biru muda */
            border: 1px solid #007bff;
            border-radius: 0.3rem;
            transition: box-shadow 0.3s ease-in-out;
        }
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.75rem;
            color: #007bff;
        }
        .text-muted {
            color: #6c757d !important;
            font-size: 0.9rem;
        }
        .fw-semibold {
            font-weight: 500;
        }
        .badge {
            font-size: 0.9rem;
            padding: 0.6rem 1rem;
            letter-spacing: 0.3px;
        }
        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
        }
        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }
        .row + .row {
            border-top: 1px solid #eee;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        /* Warna pada ikon */
        .fa-user-circle { color: #6c757d; }
        .fa-motorcycle { color: #007bff; }
        .fa-tag { color: #28a745; }
        .fa-money-bill-wave { color: #ffc107; }
        .fa-hand-holding-usd { color: #007bff; }
        .fa-calendar-alt { color: #6c757d; }
        .fa-shield-alt { color: #17a2b8; }
        .fa-coins { color: #28a745; }
        .fa-money-check-alt { color: #ffc107; }
        .fa-info-circle { color: #17a2b8; }
        .fa-check-circle { color: #28a745; }
        .fa-arrow-left { color: #6c757d; }
    </style>
@endsection
