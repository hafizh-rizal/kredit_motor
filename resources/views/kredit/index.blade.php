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
            <h5>Daftar Kredit</h5>
            <span>Kelola dan lihat semua data kredit yang tersedia</span>
        </div>
        <div class="card-body">
            <!-- Tombol Tambah -->
            <a href="{{ route('kredit.create') }}" class="btn btn-primary mb-3">+ Tambah Kredit</a>

            <!-- Notifikasi -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Motor</th>
                            <th>Metode Bayar</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
                            <th>Jumlah DP</th>
                            <th>Status DP</th>
                            <th>Bukti DP</th>
                            <th>Sisa Kredit</th>
                            <th>Status Kredit</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kredit as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pengajuanKredit->pelanggan->nama_pelanggan ?? '-' }}</td>
                                <td>{{ $item->pengajuanKredit->motor->nama_motor ?? '-' }}</td>
                                <td>{{ $item->metodeBayar->metode_pembayaran ?? '-' }}</td>
                                <td>{{ $item->tgl_mulai_kredit }}</td>
                                <td>{{ $item->tgl_selesai_kredit }}</td>
                              <td>
    @if($item->dp)
        Rp{{ number_format($item->dp, 0, ',', '.') }}
    @else
        -
    @endif
</td>

                                <td>
                                    <span class="badge 
                                        @if($item->status_pembayaran_dp == 'Sudah Dibayar') bg-success 
                                        @elseif($item->status_pembayaran_dp == 'Menunggu Verifikasi') bg-warning 
                                        @else bg-secondary @endif">
                                        {{ $item->status_pembayaran_dp }}
                                    </span>
                                </td>
                               <td>
    @if($item->bukti_pembayaran_dp)
        <a href="#" data-toggle="modal" data-target="#modalDP{{ $item->id }}" class="btn btn-sm btn-info">Lihat</a>

        <!-- Modal Bukti Pembayaran DP -->
        <div class="modal fade" id="modalDP{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDPLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDPLabel{{ $item->id }}">Bukti Pembayaran DP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        @php
                            $ext = pathinfo($item->bukti_pembayaran_dp, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                            <img src="{{ asset('storage/' . $item->bukti_pembayaran_dp) }}" class="img-fluid" alt="Bukti Pembayaran DP">
                        @elseif (strtolower($ext) == 'pdf')
                            <iframe src="{{ asset('storage/' . $item->bukti_pembayaran_dp) }}" width="100%" height="500px"></iframe>
                        @else
                            <p>Format file tidak dikenali.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <span class="text-muted">-</span>
    @endif
</td>

                                <td>Rp{{ number_format($item->sisa_kredit, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($item->status_kredit == 'Lunas') bg-success 
                                        @elseif($item->status_kredit == 'Dicicil') bg-warning 
                                        @else bg-danger @endif">
                                        {{ $item->status_kredit }}
                                    </span>
                                </td>
                                <td>{{ $item->keterangan_status_kredit ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('kredit.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kredit.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center text-muted">Belum ada data kredit</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
