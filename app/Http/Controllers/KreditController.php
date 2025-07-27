<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\PengajuanKredit;
use App\Models\MetodeBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KreditController extends Controller
{
    public function myKredit()
    {
        $pelanggan = auth ('pelanggan')->user();

        $kredit = Kredit::whereHas('pengajuanKredit', function ($query) use ($pelanggan) {
            $query->where('id_pelanggan', $pelanggan->id);
        })->with([
            'pengajuanKredit.motor',
            'metodeBayar'
        ])->get();

        return view('kredit.my_kredit', compact('kredit'));
    }

    public function show($id)
    {
        $kredit = Kredit::with(['angsuran', 'pengajuanKredit.motor'])->findOrFail($id);
        return view('kredit.show', compact('kredit'));
    }

    public function index()
    {
        $kredit = Kredit::with([
            'pengajuanKredit.pelanggan',
            'pengajuanKredit.motor',
            'metodeBayar'
        ])->get();

        return view('kredit.index', compact('kredit'));
    }

  public function create(Request $request)
{
    $idPengajuan = $request->query('id_pengajuan');

    if (!$idPengajuan) {
        return redirect()->route('kredit.saya')->with('error', 'ID Pengajuan Kredit tidak ditemukan di URL.');
    }

    $pengajuan = PengajuanKredit::with(['pelanggan', 'motor'])->findOrFail($idPengajuan);
    $metodeBayar = MetodeBayar::all();

    return view('kredit.create', [
        'idPengajuan' => $pengajuan->id,
        'namaPelanggan' => $pengajuan->pelanggan->nama_pelanggan,
        'namaMotor' => $pengajuan->motor->nama_motor,
        'metodeBayar' => $metodeBayar,
    ]);
}


    public function store(Request $request)
    {
        $request->validate([
            'id_pengajuan_kredit' => 'required|exists:pengajuan_kredit,id',
            'id_metode_bayar' => 'required|exists:metode_bayar,id',
            'tgl_mulai_kredit' => 'required|date',
            'status_kredit' => 'required|in:Dicicil,Macet,Lunas',
            'bukti_pembayaran_dp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $pengajuan = PengajuanKredit::with('jenisCicilan')->findOrFail($request->id_pengajuan_kredit);
        $tenor = $pengajuan->jenisCicilan->lama_cicilan;
        $tglSelesai = Carbon::parse($request->tgl_mulai_kredit)->addMonths($tenor);

        $buktiDpPath = null;
        if ($request->hasFile('bukti_pembayaran_dp')) {
            $buktiDpPath = $request->file('bukti_pembayaran_dp')->store('bukti_dp', 'public');
        }

        Kredit::create([
            'id_pengajuan_kredit' => $request->id_pengajuan_kredit,
            'id_metode_bayar' => $request->id_metode_bayar,
            'tgl_mulai_kredit' => $request->tgl_mulai_kredit,
            'tgl_selesai_kredit' => $tglSelesai->format('Y-m-d'),
            'dp' => $pengajuan->dp,
            'bukti_pembayaran_dp' => $buktiDpPath,
            'status_pembayaran_dp' => 'Menunggu Verifikasi',
            'sisa_kredit' => $pengajuan->harga_kredit, 
            'status_kredit' => $request->status_kredit,
            'keterangan_status_kredit' => $request->keterangan_status_kredit,
        ]);

       return redirect()->route('kredit.saya')->with('success', 'Kredit berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kredit = Kredit::findOrFail($id);
        $pengajuanKredit = PengajuanKredit::with(['pelanggan', 'motor', 'jenisCicilan'])->get();
        $metodeBayar = MetodeBayar::all();

        return view('kredit.edit', compact('kredit', 'pengajuanKredit', 'metodeBayar'));
    }

  public function update(Request $request, $id)
{
    $request->validate([
        'id_pengajuan_kredit' => 'required|exists:pengajuan_kredit,id',
        'id_metode_bayar' => 'required|exists:metode_bayar,id',
        'tgl_mulai_kredit' => 'required|date',
        'status_kredit' => 'required|in:Dicicil,Macet,Lunas',
        'status_pembayaran_dp' => 'required|in:Belum Dibayar,Menunggu Verifikasi,Sudah Dibayar',
        'keterangan_status_kredit' => 'nullable|string',
    ]);

    $kredit = Kredit::findOrFail($id);
    $pengajuan = PengajuanKredit::with('jenisCicilan')->findOrFail($request->id_pengajuan_kredit);
    $tenor = $pengajuan->jenisCicilan->lama_cicilan;
    $tglSelesai = Carbon::parse($request->tgl_mulai_kredit)->addMonths($tenor);

    $sisaKredit = $kredit->sisa_kredit;

    if (
        $kredit->status_pembayaran_dp != 'Sudah Dibayar' &&
        $request->status_pembayaran_dp == 'Sudah Dibayar'
    ) {
        $sisaKredit = $pengajuan->harga_kredit - $pengajuan->dp;
    }

    $kredit->update([
        'id_pengajuan_kredit' => $request->id_pengajuan_kredit,
        'id_metode_bayar' => $request->id_metode_bayar,
        'tgl_mulai_kredit' => $request->tgl_mulai_kredit,
        'tgl_selesai_kredit' => $tglSelesai->format('Y-m-d'),
        'sisa_kredit' => $sisaKredit,
        'status_kredit' => $request->status_kredit,
        'status_pembayaran_dp' => $request->status_pembayaran_dp,
        'keterangan_status_kredit' => $request->keterangan_status_kredit,
    ]);

    return redirect()->route('kredit.index')->with('success', 'Kredit berhasil diperbarui');
}


    public function destroy($id)
    {
        try {
            $kredit = Kredit::findOrFail($id);
            $kredit->delete();

            return redirect()->route('kredit.index')->with('success', 'Kredit berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kredit.index')->with('error', 'Kredit tidak dapat dihapus karena masih terhubung dengan data lain.');
        } catch (\Exception $e) {
            return redirect()->route('kredit.index')->with('error', 'Terjadi kesalahan saat menghapus data kredit.');
        }
    }
}
