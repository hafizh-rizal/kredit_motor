<?php
namespace App\Http\Controllers;

use App\Notifications\StatusPengajuanKreditNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
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

    public function index()
    {
        $pengajuanKredit = PengajuanKredit::with('pelanggan', 'motor')->get();
        return view('pengajuan_kredit.index', compact('pengajuanKredit'));
    }

    public function create(Request $request)
    {
        $user = auth('pelanggan')->user();
        $motor_id = $request->query('motor_id');
        $motor = Motor::findOrFail($motor_id);

        $pelanggan = Pelanggan::where('id', $user->id)->first();
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
    'alamat_pengiriman' => 'required|in:alamat1,alamat2,alamat3',
    'keterangan_status_pengajuan' => 'nullable|string',
    'url_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    'url_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    'url_npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    'url_slip_gaji' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    'url_foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
]);


        $jenisCicilan = JenisCicilan::findOrFail($request->id_jenis_cicilan);
        $validatedData['cicilan_perbulan'] = ($request->harga_kredit - $request->dp) / $jenisCicilan->lama_cicilan;
        $validatedData['tgl_pengajuan_kredit'] = now();
        $validatedData['status_pengajuan'] = 'Menunggu Konfirmasi'; 
        $validatedData['alamat_pengiriman'] = $request->alamat_pengiriman;



        foreach (['url_kk', 'url_ktp', 'url_npwp', 'url_slip_gaji', 'url_foto'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $validatedData[$fileField] = $request->file($fileField)->store("pengajuan_kredit/{$fileField}", 'public');
            }
        }

        PengajuanKredit::create($validatedData);

        return redirect()->route('pengajuan_kredit.saya')->with('success', 'Pengajuan berhasil dikirim, silakan tunggu konfirmasi.');
    }

    public function edit($id)
{
    $pengajuanKredit = PengajuanKredit::findOrFail($id);
    $pelanggan = Pelanggan::all();
    $motor = Motor::all();
    $jenisCicilan = JenisCicilan::all();
    $asuransi = Asuransi::all();
    $pelangganTerpilih = $pelanggan->firstWhere('id', $pengajuanKredit->id_pelanggan);

    return view('pengajuan_kredit.edit', compact(
        'pengajuanKredit',
        'pelanggan',
        'motor',
        'jenisCicilan',
        'asuransi',
        'pelangganTerpilih' 
    ));
}


  public function update(Request $request, $id)
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
        'alamat_pengiriman' => 'required|in:alamat1,alamat2,alamat3',
        'keterangan_status_pengajuan' => 'nullable|string',
        'status_pengajuan' => 'required|string',
        'url_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'url_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'url_npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'url_slip_gaji' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'url_foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $pengajuanKredit = PengajuanKredit::findOrFail($id);
    $jenisCicilan = JenisCicilan::findOrFail($request->id_jenis_cicilan);

    $validatedData['cicilan_perbulan'] = ($request->harga_kredit - $request->dp) / $jenisCicilan->lama_cicilan;

    foreach (['url_kk', 'url_ktp', 'url_npwp', 'url_slip_gaji', 'url_foto'] as $fileField) {
        if ($request->hasFile($fileField)) {
            $validatedData[$fileField] = $request->file($fileField)->store("pengajuan_kredit/{$fileField}", 'public');
        }
    }

    // Deteksi perubahan status
    $statusLama = $pengajuanKredit->status_pengajuan;

    // Update data
    $pengajuanKredit->update($validatedData);


    if ($statusLama !== $validatedData['status_pengajuan']) {
       $pelanggan = $pengajuanKredit->pelanggan;

if ($pelanggan) {
    $pelanggan->notify(new StatusPengajuanKreditNotification($pengajuanKredit));
}

    }

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
