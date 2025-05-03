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
            <h5>Daftar Pengajuan Kredit</h5>
            <span>Kelola dan lihat semua pengajuan kredit yang tersedia</span>
        </div>
        <div class="card-body">
            <!-- Button Tambah -->
            <a href="{{ route('pengajuan_kredit.create') }}" class="btn btn-primary mb-3">Tambah Pengajuan Kredit</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Motor</th>
                            <th>Harga Kredit</th>
                            <th>Harga Cash</th>
                            <th>DP</th>
                            <th>Jenis Cicilan</th>
                            <th>Asuransi</th>
                            <th>Biaya Asuransi</th>
                            <th>Cicilan / Bulan</th>
                            <th>URL KK</th>
                            <th>URL KTP</th>
                            <th>URL NPWP</th>
                            <th>URL Slip Gaji</th>
                            <th>URL Foto</th>
                            <th>Status Pengajuan</th>
                            <th>Keterangan Status Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuanKredit as $key => $pengajuan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pengajuan->tgl_pengajuan_kredit }}</td>
                            <td>{{ $pengajuan->pelanggan->nama_pelanggan }}</td>
                            <td>{{ $pengajuan->motor->nama_motor }}</td>
                            <td>{{ number_format($pengajuan->harga_kredit, 2, ',', '.') }}</td>
                            <td>{{ number_format($pengajuan->harga_cash, 2, ',', '.') }}</td>
                            <td>{{ $pengajuan->dp }}</td>
                            <td>
                                {{ $pengajuan->jenisCicilan ? $pengajuan->jenisCicilan->lama_cicilan . ' bulan' : '-' }}
                            </td>                                                                    
                            <td>{{ $pengajuan->asuransi ? $pengajuan->asuransi->nama_asuransi : '-' }}</td>
                            <td>{{ number_format($pengajuan->biaya_asuransi, 2, ',', '.') }}</td>
                            <td>{{ number_format($pengajuan->cicilan_perbulan, 2, ',', '.') }}</td>
                            <td>
                                @if($pengajuan->url_kk)
                                    <a href="{{ asset('storage/'.$pengajuan->url_kk) }}" target="_blank">Lihat KK</a>
                                @else
                                    - 
                                @endif
                            </td>
                            <td>
                                @if($pengajuan->url_ktp)
                                    <a href="{{ asset('storage/'.$pengajuan->url_ktp) }}" target="_blank">Lihat KTP</a>
                                @else
                                    - 
                                @endif
                            </td>
                            <td>
                                @if($pengajuan->url_npwp)
                                    <a href="{{ asset('storage/'.$pengajuan->url_npwp) }}" target="_blank">Lihat NPWP</a>
                                @else
                                    - 
                                @endif
                            </td>
                            <td>
                                @if($pengajuan->url_slip_gaji)
                                    <a href="{{ asset('storage/'.$pengajuan->url_slip_gaji) }}" target="_blank">Lihat Slip Gaji</a>
                                @else
                                    - 
                                @endif
                            </td>
                            <td>
                                @if($pengajuan->url_foto)
                                    <a href="{{ asset('storage/'.$pengajuan->url_foto) }}" target="_blank">Lihat Foto</a>
                                @else
                                    - 
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ 
                                    $pengajuan->status_pengajuan == 'Diterima' ? 'success' : 
                                    ($pengajuan->status_pengajuan == 'Menunggu Konfirmasi' ? 'warning' : 
                                    'danger') }}">
                                    {{ $pengajuan->status_pengajuan }}
                                </span>
                            </td>
                            <td>{{ $pengajuan->keterangan_status_pengajuan ?? '-' }}</td>
                            <td>
                                <a href="{{ route('pengajuan_kredit.edit', $pengajuan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pengajuan_kredit.destroy', $pengajuan->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($pengajuanKredit->isEmpty())
                            <tr>
                                <td colspan="18" class="text-center text-muted">Belum ada data pengajuan kredit</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
