@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Pengajuan Kredit</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengajuan_kredit.update', $pengajuanKredit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Inputan untuk Pelanggan -->
                <div class="form-group">
                    <label>Pelanggan</label>

                    {{-- Select yang tidak bisa diubah --}}
                    <select name="id_pelanggan_display" class="form-control" disabled>
                        <option value="">Pilih Pelanggan</option>
                        @foreach ($pelanggan as $item)
                            <option value="{{ $item->id }}" {{ $pengajuanKredit->id_pelanggan == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Hidden input untuk mengirim data ke server --}}
                    <input type="hidden" name="id_pelanggan" value="{{ $pengajuanKredit->id_pelanggan }}">

                    @error('id_pelanggan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Inputan untuk Motor -->
                <div class="form-group">
                    <label>Motor</label>
                    <select name="id_motor_display" class="form-control" disabled>
                        <option value="">Pilih Motor</option>
                        @foreach ($motor as $item)
                            <option value="{{ $item->id }}" {{ $pengajuanKredit->id_motor == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_motor }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="id_motor" value="{{ $pengajuanKredit->id_motor }}">

                    @error('id_motor') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <!-- Harga Cash -->
                <div class="form-group">
                    <label>Harga Cash</label>
                    <input type="number" name="harga_cash" class="form-control" value="{{ old('harga_cash', $pengajuanKredit->harga_cash) }}" {{ 'readonly' }}>
                    @error('harga_cash') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- DP -->
                <div class="form-group">
                    <label>DP</label>
                    <input type="number" name="dp" class="form-control" value="{{ old('dp', $pengajuanKredit->dp) }}" {{ 'readonly' }}>
                    @error('dp') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Jenis Cicilan -->
                <div class="form-group">
                    <label>Jenis Cicilan</label>

                
                    <select name="id_jenis_cicilan_display" class="form-control" disabled>
                        <option value="">Pilih Jenis Cicilan</option>
                        @foreach ($jenisCicilan as $item)
                            <option value="{{ $item->id }}" {{ $pengajuanKredit->id_jenis_cicilan == $item->id ? 'selected' : '' }}>
                                {{ $item->lama_cicilan }} bulan
                            </option>
                        @endforeach
                    </select>

                    
                    <input type="hidden" name="id_jenis_cicilan" value="{{ $pengajuanKredit->id_jenis_cicilan }}">

                    @error('id_jenis_cicilan') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>
                <!-- Harga Kredit -->
                <div class="form-group">
                    <label>Harga Kredit</label>
                    <input type="number" name="harga_kredit" class="form-control" value="{{ old('harga_kredit', $pengajuanKredit->harga_kredit) }}" {{ 'readonly' }}>
                    @error('harga_kredit') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Asuransi -->
<div class="form-group">
    <label>Asuransi</label>
    <select name="id_asuransi_disabled" class="form-control" disabled>
        <option value="">Pilih Asuransi</option>
        @foreach ($asuransi as $item)
            <option value="{{ $item->id }}" {{ $pengajuanKredit->id_asuransi == $item->id ? 'selected' : '' }}>
                {{ $item->nama_asuransi }}
            </option>
        @endforeach
    </select>

    <input type="hidden" name="id_asuransi" value="{{ $pengajuanKredit->id_asuransi }}">

    @error('id_asuransi') 
        <small class="text-danger">{{ $message }}</small> 
    @enderror
</div>


                <!-- Biaya Asuransi -->
                <div class="form-group">
                    <label>Biaya Asuransi</label>
                    <input type="number" name="biaya_asuransi" class="form-control" value="{{ old('biaya_asuransi', $pengajuanKredit->biaya_asuransi) }}" {{ 'readonly' }}>
                    @error('biaya_asuransi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Cicilan Per Bulan</label>
                    <input type="number" name="cicilan_perbulan" class="form-control" value="{{ old('cicilan_perbulan', $pengajuanKredit->cicilan_perbulan) }}" {{ 'readonly' }}>
                    @error('cicilan_perbulan') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <!-- URL KK -->
                {{-- <div class="form-group">
                    <label>URL KK (Opsional)</label>
                    <input type="file" name="url_kk" class="form-control-file">
                    @error('url_kk') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

                <!-- URL KTP -->
                {{-- <div class="form-group">
                    <label>URL KTP (Opsional)</label>
                    <input type="file" name="url_ktp" class="form-control-file">
                    @error('url_ktp') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

                <!-- URL NPWP -->
                {{-- <div class="form-group">
                    <label>URL NPWP (Opsional)</label>
                    <input type="file" name="url_npwp" class="form-control-file">
                    @error('url_npwp') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

                <!-- URL Slip Gaji -->
                {{-- <div class="form-group">
                    <label>URL Slip Gaji (Opsional)</label>
                    <input type="file" name="url_slip_gaji" class="form-control-file">
                    @error('url_slip_gaji') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

                <!-- URL Foto -->
                {{-- <div class="form-group">
                    <label>URL Foto (Opsional)</label>
                    <input type="file" name="url_foto" class="form-control-file">
                    @error('url_foto') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}

                <!-- Status Pengajuan -->
                <div class="form-group">
                    <label>Status Pengajuan</label>
                    <select name="status_pengajuan" class="form-control">
                        <option value="Menunggu Konfirmasi" {{ $pengajuanKredit->status_pengajuan == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="Diproses" {{ $pengajuanKredit->status_pengajuan == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Dibatalkan Pembeli" {{ $pengajuanKredit->status_pengajuan == 'Dibatalkan Pembeli' ? 'selected' : '' }}>Dibatalkan Pembeli</option>
                        <option value="Dibatalkan Penjual" {{ $pengajuanKredit->status_pengajuan == 'Dibatalkan Penjual' ? 'selected' : '' }}>Dibatalkan Penjual</option>
                        <option value="Bermasalah" {{ $pengajuanKredit->status_pengajuan == 'Bermasalah' ? 'selected' : '' }}>Bermasalah</option>
                        <option value="Diterima" {{ $pengajuanKredit->status_pengajuan == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                    </select>
                    @error('status_pengajuan') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
 <div class="mb-3">
    <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>

    {{-- Select tampilan saja (tidak bisa diedit) --}}
    <select name="alamat_pengiriman_display" id="alamat_pengiriman" class="form-control" disabled>
        @if ($pelangganTerpilih)
            <option value="alamat1" {{ old('alamat_pengiriman', $pengajuanKredit->alamat_pengiriman) == 'alamat1' ? 'selected' : '' }}>
                Alamat 1 - {{ $pelangganTerpilih->alamat1 }}, {{ $pelangganTerpilih->kota1 }}, {{ $pelangganTerpilih->propinsi1 }}, {{ $pelangganTerpilih->kodepos1 }}
            </option>
            @if ($pelangganTerpilih->alamat2)
                <option value="alamat2" {{ old('alamat_pengiriman', $pengajuanKredit->alamat_pengiriman) == 'alamat2' ? 'selected' : '' }}>
                    Alamat 2 - {{ $pelangganTerpilih->alamat2 }}, {{ $pelangganTerpilih->kota2 }}, {{ $pelangganTerpilih->propinsi2 }}, {{ $pelangganTerpilih->kodepos2 }}
                </option>
            @endif
            @if ($pelangganTerpilih->alamat3)
                <option value="alamat3" {{ old('alamat_pengiriman', $pengajuanKredit->alamat_pengiriman) == 'alamat3' ? 'selected' : '' }}>
                    Alamat 3 - {{ $pelangganTerpilih->alamat3 }}, {{ $pelangganTerpilih->kota3 }}, {{ $pelangganTerpilih->propinsi3 }}, {{ $pelangganTerpilih->kodepos3 }}
                </option>
            @endif
        @else
            <option value="">Pilih pelanggan terlebih dahulu</option>
        @endif
    </select>

    {{-- Hidden input untuk dikirim ke server --}}
    <input type="hidden" name="alamat_pengiriman" value="{{ old('alamat_pengiriman', $pengajuanKredit->alamat_pengiriman) }}">
</div>




                <!-- Keterangan Status Pengajuan -->
                <div class="form-group">
                    <label>Keterangan Status Pengajuan</label>
                    <textarea name="keterangan_status_pengajuan" class="form-control">{{ old('keterangan_status_pengajuan', $pengajuanKredit->keterangan_status_pengajuan) }}</textarea>
                    @error('keterangan_status_pengajuan') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Button Submit -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('pengajuan_kredit.index') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
