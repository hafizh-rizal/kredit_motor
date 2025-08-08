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
            <h5>Daftar Pengiriman</h5>
            <span>Kelola dan lihat semua data pengiriman motor</span>
        </div>
        <div class="card-body">
            <!-- Button Tambah -->
            <a href="{{ route('pengiriman.create') }}" class="btn btn-primary mb-3">Tambah Pengiriman</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Filter & Search -->
            <form method="GET" action="{{ route('pengiriman.index') }}" class="row mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Pelanggan..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">-- Filter Status --</option>
                        <option value="Sedang Dikirim" {{ request('status') == 'Sedang Dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                        <option value="Tiba Di Tujuan" {{ request('status') == 'Tiba Di Tujuan' ? 'selected' : '' }}>Tiba Di Tujuan</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-success">Filter</button>
                    <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Tanggal Kirim</th>
                            <th>Status Kirim</th>
                            <th>Kurir</th>
                            <th>Telpon</th>
                            <th>Bukti Foto</th>
                            <th>Keterangan</th>
                            <th>Pelanggan</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengiriman as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->invoice }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_kirim)->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($item->status_kirim == 'Sedang Dikirim')
                                    <span class="badge bg-warning text-dark">{{ $item->status_kirim }}</span>
                                @elseif($item->status_kirim == 'Tiba Di Tujuan')
                                    <span class="badge bg-success">{{ $item->status_kirim }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $item->status_kirim }}</span>
                                @endif
                            </td>
                            <td>{{ $item->nama_kurir }}</td>
                            <td>{{ $item->telpon_kurir }}</td>
                            <td>
                                @if ($item->bukti_foto)
                                    <a href="#" data-toggle="modal" data-target="#modalFoto{{ $item->id }}">
                                        <img src="{{ asset('storage/' . $item->bukti_foto) }}" class="img-thumbnail" width="60" alt="Bukti">
                                    </a>

                                    <!-- Modal Bukti Foto -->
                                    <div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalFotoLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalFotoLabel{{ $item->id }}">Bukti Foto</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    @php
                                                        $ext = pathinfo($item->bukti_foto, PATHINFO_EXTENSION);
                                                    @endphp

                                                    @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                                                        <img src="{{ asset('storage/' . $item->bukti_foto) }}" class="img-fluid" alt="Bukti Foto">
                                                    @elseif (strtolower($ext) == 'pdf')
                                                        <iframe src="{{ asset('storage/' . $item->bukti_foto) }}" width="100%" height="500px"></iframe>
                                                    @else
                                                        <p>Format file tidak dikenali.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">Tidak Ada</span>
                                @endif
                            </td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td>{{ data_get($item, 'kredit.pengajuanKredit.pelanggan.nama_pelanggan', '-') }}</td>

                            @php
                                $pengajuan = $item->kredit->pengajuanKredit ?? null;
                                $pel = $pengajuan?->pelanggan;
                                $field = $pengajuan?->alamat_pengiriman;
                                $alamat = match($field) {
                                    'alamat1' => "{$pel->alamat1}, {$pel->kota1}, {$pel->propinsi1}, {$pel->kodepos1}",
                                    'alamat2' => "{$pel->alamat2}, {$pel->kota2}, {$pel->propinsi2}, {$pel->kodepos2}",
                                    'alamat3' => "{$pel->alamat3}, {$pel->kota3}, {$pel->propinsi3}, {$pel->kodepos3}",
                                    default => '-',
                                };
                            @endphp
                            <td>{{ $alamat }}</td>

                            <td>
                                <a href="{{ route('pengiriman.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pengiriman.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm btn-delete">Hapus</button>
</form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">Belum ada data pengiriman</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $pengiriman->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
