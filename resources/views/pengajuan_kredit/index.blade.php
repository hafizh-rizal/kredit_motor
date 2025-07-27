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
                <div class="alert alert-danger">{{ session('error') }}</div>
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
                            <th>Alamat Pengiriman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuanKredit as $key => $pengajuan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pengajuan->tgl_pengajuan_kredit }}</td>
                            <td>{{ $pengajuan->pelanggan->nama_pelanggan }}</td>
                            <td>{{ $pengajuan->motor->nama_motor }}</td>
                            <td>{{ number_format($pengajuan->harga_kredit, 2, ',', '.') }}</td>
                            <td>{{ number_format($pengajuan->harga_cash, 2, ',', '.') }}</td>
                            <td>{{ number_format($pengajuan->dp, 2, ',', '.') }}</td>
                            <td>{{ $pengajuan->jenisCicilan ? $pengajuan->jenisCicilan->lama_cicilan . ' bulan' : '-' }}</td>
                            <td>{{ $pengajuan->asuransi ? $pengajuan->asuransi->nama_asuransi : '-' }}</td>
                            <td>{{ number_format($pengajuan->biaya_asuransi, 2, ',', '.') }}</td>
                            <td>{{ number_format($pengajuan->cicilan_perbulan, 2, ',', '.') }}</td>
                           <td>
    @if($pengajuan->url_kk)
        <a href="#" data-toggle="modal" data-target="#modalKK{{ $pengajuan->id }}">Lihat KK</a>

        <!-- Modal -->
        <div class="modal fade" id="modalKK{{ $pengajuan->id }}" tabindex="-1" role="dialog" aria-labelledby="modalKKLabel{{ $pengajuan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalKKLabel{{ $pengajuan->id }}">Kartu Keluarga</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        @php
                            $ext = pathinfo($pengajuan->url_kk, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ asset('storage/' . $pengajuan->url_kk) }}" class="img-fluid" alt="KK">
                        @elseif (strtolower($ext) == 'pdf')
                            <iframe src="{{ asset('storage/' . $pengajuan->url_kk) }}" width="100%" height="500px"></iframe>
                        @else
                            <p>Format file tidak dikenali.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        -
    @endif
</td>

                           <td>
    @if($pengajuan->url_ktp)
        <a href="#" data-toggle="modal" data-target="#modalKTP{{ $pengajuan->id }}">Lihat KTP</a>

        <!-- Modal -->
        <div class="modal fade" id="modalKTP{{ $pengajuan->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">KTP</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        @php
                            $ext = pathinfo($pengajuan->url_ktp, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ asset('storage/' . $pengajuan->url_ktp) }}" class="img-fluid">
                        @elseif ($ext == 'pdf')
                            <iframe src="{{ asset('storage/' . $pengajuan->url_ktp) }}" width="100%" height="500px"></iframe>
                        @else
                            <p>Format tidak dikenali.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        -
    @endif
</td>

                           <td>
    @if($pengajuan->url_npwp)
        <a href="#" data-toggle="modal" data-target="#modalNPWP{{ $pengajuan->id }}">Lihat NPWP</a>

        <!-- Modal -->
        <div class="modal fade" id="modalNPWP{{ $pengajuan->id }}" tabindex="-1" role="dialog" aria-labelledby="modalNPWPLabel{{ $pengajuan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalNPWPLabel{{ $pengajuan->id }}">Dokumen NPWP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        @php
                            $ext = pathinfo($pengajuan->url_npwp, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ asset('storage/' . $pengajuan->url_npwp) }}" class="img-fluid" alt="NPWP">
                        @elseif (strtolower($ext) == 'pdf')
                            <iframe src="{{ asset('storage/' . $pengajuan->url_npwp) }}" width="100%" height="500px"></iframe>
                        @else
                            <p>Format file tidak dikenali.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        -
    @endif
</td>

                            <!-- Slip Gaji -->
<td>
    @if($pengajuan->url_slip_gaji)
        <a href="#" data-toggle="modal" data-target="#modalSlipGaji{{ $pengajuan->id }}">Lihat Slip Gaji</a>

        <!-- Modal Slip Gaji -->
        <div class="modal fade" id="modalSlipGaji{{ $pengajuan->id }}" tabindex="-1" role="dialog" aria-labelledby="modalSlipGajiLabel{{ $pengajuan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSlipGajiLabel{{ $pengajuan->id }}">Slip Gaji</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        @php
                            $ext = pathinfo($pengajuan->url_slip_gaji, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                            <img src="{{ asset('storage/' . $pengajuan->url_slip_gaji) }}" class="img-fluid" alt="Slip Gaji">
                        @elseif (strtolower($ext) == 'pdf')
                            <iframe src="{{ asset('storage/' . $pengajuan->url_slip_gaji) }}" width="100%" height="500px"></iframe>
                        @else
                            <p>Format file tidak dikenali.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        -
    @endif
</td>

<!-- Foto -->
<td>
    @if($pengajuan->url_foto)
        <a href="#" data-toggle="modal" data-target="#modalFoto{{ $pengajuan->id }}">Lihat Foto</a>

        <!-- Modal Foto -->
        <div class="modal fade" id="modalFoto{{ $pengajuan->id }}" tabindex="-1" role="dialog" aria-labelledby="modalFotoLabel{{ $pengajuan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFotoLabel{{ $pengajuan->id }}">Foto Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        @php
                            $ext = pathinfo($pengajuan->url_foto, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                            <img src="{{ asset('storage/' . $pengajuan->url_foto) }}" class="img-fluid" alt="Foto Pelanggan">
                        @elseif (strtolower($ext) == 'pdf')
                            <iframe src="{{ asset('storage/' . $pengajuan->url_foto) }}" width="100%" height="500px"></iframe>
                        @else
                            <p>Format file tidak dikenali.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        -
    @endif
</td>

                            <td>
                                <span class="badge badge-{{ 
                                    $pengajuan->status_pengajuan == 'Diterima' ? 'success' : 
                                    ($pengajuan->status_pengajuan == 'Menunggu Konfirmasi' ? 'warning' : 'danger') }}">
                                    {{ $pengajuan->status_pengajuan }}
                                </span>
                            </td>
                            <td>{{ $pengajuan->keterangan_status_pengajuan ?? '-' }}</td>
                        <td>
    @php
        $pel = $pengajuan->pelanggan;
        $field = $pengajuan->alamat_pengiriman;

        $alamatLengkap = match($field) {
            'alamat1' => "$pel->alamat1, $pel->kota1, $pel->propinsi1, $pel->kodepos1",
            'alamat2' => "$pel->alamat2, $pel->kota2, $pel->propinsi2, $pel->kodepos2",
            'alamat3' => "$pel->alamat3, $pel->kota3, $pel->propinsi3, $pel->kodepos3",
            default => '-',
        };
    @endphp
    {{ $alamatLengkap }}
</td>

                            <td>
                                <a href="{{ route('pengajuan_kredit.edit', $pengajuan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pengajuan_kredit.destroy', $pengajuan->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="20" class="text-center text-muted">Belum ada data pengajuan kredit</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
