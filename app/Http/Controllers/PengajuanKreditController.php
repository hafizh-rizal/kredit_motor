<?php

namespace App\Http\Controllers;

use App\Models\PengajuanKredit;
use App\Models\Motor;
use App\Models\Pelanggan;
use App\Models\JenisCicilan;
use App\Models\Asuransi;
use Illuminate\Http\Request;

class PengajuanKreditController extends Controller
{
   public function myPengajuan()
{
    $user = auth('pelanggan')->user();

    $pengajuanList = PengajuanKredit::with('motor', 'jenisCicilan', 'asuransi')
        ->where('id_pelanggan', $user->id)
        ->latest()
        ->get();

    return view('pengajuan_kredit.my_pengajuan', compact('pengajuanList'));
}


    public function show($id)
{
    $pengajuanKredit = PengajuanKredit::with('pelanggan', 'motor')->findOrFail($id);
    return view('pengajuan_kredit.show', compact('pengajuanKredit'));
}

    /**
     * Display a listing of the Pengajuan Kredit.
     *
     * Retrieves all Pengajuan Kredit records with their related Pelanggan and Motor data,
     * and returns the corresponding view to display the list.
     *
     * @return \Illuminate\View\View
    
 */
    public function index()
    {
        $pengajuanKredit = PengajuanKredit::with('pelanggan', 'motor')->get(); // Menambahkan relasi agar nama pelanggan dan motor ditampilkan
        return view('pengajuan_kredit.index', compact('pengajuanKredit'));
    }

    public function create(Request $request)
{
    $motor_id = $request->query('motor_id');
    $motor = Motor::findOrFail($motor_id);

    $pelanggan = Pelanggan::all();
    $jenisCicilan = JenisCicilan::all();
    $asuransi = Asuransi::all();

    session(['motor_id' => $motor_id]);

    return view('pengajuan_kredit.create', compact('pelanggan', 'motor', 'jenisCicilan', 'asuransi'));
}


   
public function store(Request $request)
{
    $validatedData = $request->validate([
        'id_pelanggan' => 'required|exists:pelanggan,id',
        'id_motor' => 'required|exists:motor,id',
        'harga_cash' => 'required|numeric',
        'dp' => 'required|numeric',
        'id_jenis_cicilan' => 'required|exists:jenis_cicilan,id',
        'harga_kredit' => 'required|numeric',
        'id_asuransi' => 'required|exists:asuransi,id',
        'biaya_asuransi' => 'nullable|numeric',
        'keterangan_status_pengajuan' => 'nullable|string',

        'url_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'url_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'url_npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'url_slip_gaji' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'url_foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $jenisCicilan = JenisCicilan::findOrFail($request->id_jenis_cicilan);
    $validatedData['cicilan_perbulan'] = $request->harga_kredit / $jenisCicilan->lama_cicilan;
    $validatedData['tgl_pengajuan_kredit'] = now();
    $validatedData['status_pengajuan'] = 'Menunggu Konfirmasi'; 

    foreach (['url_kk', 'url_ktp', 'url_npwp', 'url_slip_gaji', 'url_foto'] as $fileField) {
        if ($request->hasFile($fileField)) {
            $validatedData[$fileField] = $request->file($fileField)->store("pengajuan_kredit/{$fileField}", 'public');
        }
    }

    // Simpan data
    $pengajuanKredit = PengajuanKredit::create($validatedData);

    return redirect()->route('pengajuan_kredit.saya')->with('success', 'Pengajuan berhasil dikirim, silakan tunggu konfirmasi.');
}

    
    
    
    public function edit($id)
    {
        $pengajuanKredit = PengajuanKredit::findOrFail($id);
        $pelanggan = Pelanggan::all(); 
        $motor = Motor::all(); 
        $jenisCicilan = JenisCicilan::all(); 
        $asuransi = Asuransi::all();
        return view('pengajuan_kredit.edit', compact('pengajuanKredit', 'pelanggan', 'motor', 'jenisCicilan', 'asuransi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'id_motor' => 'required|exists:motor,id',
            'harga_cash' => 'required|numeric',
            'dp' => 'required|numeric',
            'id_jenis_cicilan' => 'required|exists:jenis_cicilan,id',
            'id_asuransi' => 'required|exists:asuransi,id',
            'harga_kredit' => 'required|numeric',
            'cicilan_perbulan' => 'required|numeric',
            'status_pengajuan' => 'required|in:Menunggu Konfirmasi,Diproses,Dibatalkan Pembeli,Dibatalkan Penjual,Bermasalah,Diterima',
            'keterangan_status_pengajuan' => 'nullable|string',
        ]);

        $pengajuanKredit = PengajuanKredit::findOrFail($id);

        $pengajuanKredit->update([
            'id_pelanggan' => $request->id_pelanggan,
            'id_motor' => $request->id_motor,
            'harga_cash' => $request->harga_cash,
            'dp' => $request->dp,
            'id_jenis_cicilan' => $request->id_jenis_cicilan,
            'harga_kredit' => $request->harga_kredit,
            'id_asuransi' => $request->id_asuransi,
            'biaya_asuransi' => $request->biaya_asuransi,
            'cicilan_perbulan' => $request->cicilan_perbulan,
            'url_kk' => $request->url_kk ? $request->file('url_kk')->store('kk') : $pengajuanKredit->url_kk,
            'url_ktp' => $request->url_ktp ? $request->file('url_ktp')->store('ktp') : $pengajuanKredit->url_ktp,
            'url_npwp' => $request->url_npwp ? $request->file('url_npwp')->store('npwp') : $pengajuanKredit->url_npwp,
            'url_slip_gaji' => $request->url_slip_gaji ? $request->file('url_slip_gaji')->store('slip_gaji') : $pengajuanKredit->url_slip_gaji,
            'url_foto' => $request->url_foto ? $request->file('url_foto')->store('foto') : $pengajuanKredit->url_foto,
            'status_pengajuan' => $request->status_pengajuan,
            'keterangan_status_pengajuan' => $request->keterangan_status_pengajuan,
        ]);

        return redirect()->route('pengajuan_kredit.index')->with('success', 'Pengajuan Kredit berhasil diperbarui');
    }

    public function destroy(PengajuanKredit $pengajuanKredit)
{
    try {
        $pengajuanKredit->delete();

        return redirect()->route('pengajuan_kredit.index')->with('success', 'Pengajuan kredit berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->route('pengajuan_kredit.index')->with('error', 'Data tidak dapat dihapus karena masih terhubung dengan data lain.');
    } catch (\Exception $e) {
        return redirect()->route('pengajuan_kredit.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
    }
}
}