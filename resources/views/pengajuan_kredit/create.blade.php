@extends('fe.master')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('pengajuan_kredit.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h4 class="card-title mb-4">Form Pengajuan Kredit</h4>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label>Pelanggan</label>
                        <input type="text" class="form-control" value="{{ Auth::guard('pelanggan')->user()->nama_pelanggan }}" readonly>
                        <input type="hidden" name="id_pelanggan" value="{{ Auth::guard('pelanggan')->user()->id }}">
                        @error('id_pelanggan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Motor</label>
                        <input type="text" class="form-control" id="nama_motor" readonly>
                        <input type="hidden" name="id_motor" id="id_motor">
                        @error('id_motor') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga Kredit</label>
                        <input type="number" name="harga_kredit" class="form-control" value="{{ old('harga_kredit') }}">
                        @error('harga_kredit') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Harga Cash</label>
                        <input type="number" name="harga_cash" id="harga_cash" class="form-control" value="{{ old('harga_cash') }}" readonly>
                        @error('harga_cash') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    

                    <div class="form-group mb-3">
                        <label>DP</label>
                        <input type="number" name="dp" class="form-control" value="{{ old('dp') }}">
                        @error('dp') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Jenis Cicilan</label>
                        <select name="id_jenis_cicilan" class="form-control" id="id_jenis_cicilan">
                            <option value="">Pilih Jenis Cicilan</option>
                            @foreach ($jenisCicilan as $item)
                                <option 
                                    value="{{ $item->id }}" 
                                    data-bunga="{{ $item->margin_kredit }}">
                                    {{ $item->lama_cicilan }} bulan - Margin {{ $item->margin_kredit }}%
                                </option>
                            @endforeach
                        </select>                        
                        @error('id_jenis_cicilan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label>Asuransi</label>
                        <select name="id_asuransi" class="form-control" id="id_asuransi">
                            <option value="">Pilih Asuransi</option>
                            @foreach ($asuransi as $item)
                            <option value="{{ $item->id }}" data-margin="{{ $item->margin_asuransi }}">
                                {{ $item->nama_asuransi }} Margin {{ $item->margin_asuransi }}%
                            </option>                            
                            @endforeach
                        </select>                                               
                        @error('id_asuransi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>                    

                    <div class="form-group mb-3">
                        <label>Biaya Asuransi</label>
                        <input type="number" name="biaya_asuransi" class="form-control" value="{{ old('biaya_asuransi') }}">
                        @error('biaya_asuransi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>                    

                    <div class="form-group mb-3">
                        <label>URL KK (Opsional)</label>
                        <input type="file" name="url_kk" class="form-control-file">
                        @error('url_kk') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>URL KTP (Opsional)</label>
                        <input type="file" name="url_ktp" class="form-control-file">
                        @error('url_ktp') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>URL NPWP (Opsional)</label>
                        <input type="file" name="url_npwp" class="form-control-file">
                        @error('url_npwp') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>URL Slip Gaji (Opsional)</label>
                        <input type="file" name="url_slip_gaji" class="form-control-file">
                        @error('url_slip_gaji') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>URL Foto (Opsional)</label>
                        <input type="file" name="url_foto" class="form-control-file">
                        @error('url_foto') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
{{-- 
                    <div class="form-group mb-3">
                        <label>Status Pengajuan</label>
                        <select name="status_pengajuan" class="form-control">
                            <option value="Menunggu Konfirmasi" {{ old('status_pengajuan') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>
                                Menunggu Konfirmasi</option>
                            <option value="Diproses" {{ old('status_pengajuan') == 'Diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="Dibatalkan Pembeli"
                                {{ old('status_pengajuan') == 'Dibatalkan Pembeli' ? 'selected' : '' }}>Dibatalkan Pembeli
                            </option>
                            <option value="Dibatalkan Penjual"
                                {{ old('status_pengajuan') == 'Dibatalkan Penjual' ? 'selected' : '' }}>Dibatalkan Penjual
                            </option>
                            <option value="Bermasalah" {{ old('status_pengajuan') == 'Bermasalah' ? 'selected' : '' }}>
                                Bermasalah</option>
                            <option value="Diterima" {{ old('status_pengajuan') == 'Diterima' ? 'selected' : '' }}>Diterima
                            </option>
                        </select>
                        @error('status_pengajuan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div> --}}
                    <div class="form-group mb-3">
                        <label>Status Pengajuan</label>
                        <input type="text" class="form-control" value="Menunggu Konfirmasi" disabled>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Keterangan Status Pengajuan</label>
                        <textarea name="keterangan_status_pengajuan"
                            class="form-control">{{ old('keterangan_status_pengajuan') }}</textarea>
                        @error('keterangan_status_pengajuan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('motor.detail', ['id' => session('motor_id')]) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ambil harga cash dari motor
    const hargaCash = @json($motor->harga_jual);
    document.getElementById('harga_cash').value = hargaCash;
    document.getElementById('nama_motor').value = @json($motor->nama_motor);
    document.getElementById('id_motor').value = @json($motor->id);

    const hargaKreditInput = document.querySelector('input[name="harga_kredit"]');
    const dpInput = document.querySelector('input[name="dp"]');
    const idJenisCicilanSelect = document.getElementById('id_jenis_cicilan');
    const idAsuransiSelect = document.getElementById('id_asuransi');
    const biayaAsuransiInput = document.querySelector('input[name="biaya_asuransi"]');

    // Fungsi untuk menghitung harga kredit dan biaya asuransi otomatis
    function updateHargaKreditDanAsuransi() {
        // Ambil data bunga cicilan dari pilihan jenis cicilan
        const selectedOptionCicilan = idJenisCicilanSelect.options[idJenisCicilanSelect.selectedIndex];
        const persentaseBunga = parseFloat(selectedOptionCicilan?.dataset.bunga || 0);

        // Hitung harga kredit jika persentase bunga ada
        if (!isNaN(persentaseBunga)) {
            const hargaKredit = hargaCash + (hargaCash * persentaseBunga / 100);
            hargaKreditInput.value = hargaKredit.toFixed(0); // Pembulatan ke angka bulat

            // Hitung DP secara otomatis (misalnya 20% dari harga kredit)
            const dp = hargaKredit * 0.20; // 20% DP
            dpInput.value = dp.toFixed(0); // Pembulatan ke angka bulat
        }

        // Hitung biaya asuransi berdasarkan margin asuransi yang dipilih
        const selectedOptionAsuransi = idAsuransiSelect.options[idAsuransiSelect.selectedIndex];
        const marginAsuransi = parseFloat(selectedOptionAsuransi?.dataset.margin || 0);

        // Jika margin asuransi ada, hitung biaya asuransi
        if (!isNaN(marginAsuransi)) {
            const biayaAsuransi = hargaKreditInput.value * marginAsuransi / 100;
            biayaAsuransiInput.value = biayaAsuransi.toFixed(0); // Pembulatan ke angka bulat
        }
    }

    // Event listener untuk memilih jenis cicilan
    idJenisCicilanSelect.addEventListener('change', updateHargaKreditDanAsuransi);

    // Event listener untuk memilih asuransi
    idAsuransiSelect.addEventListener('change', updateHargaKreditDanAsuransi);

    // Jika sudah ada pilihan cicilan atau asuransi pada form yang sudah dibuka, langsung hitung harga kredit dan biaya asuransi
    if (idJenisCicilanSelect.value || idAsuransiSelect.value) {
        updateHargaKreditDanAsuransi();
    }
});
</script>
@endpush