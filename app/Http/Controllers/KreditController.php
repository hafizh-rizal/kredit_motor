<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\PengajuanKredit;
use App\Models\MetodeBayar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KreditController extends Controller
{

    public function myKredit()
{
    $pelanggan = auth('pelanggan')->user();

    $kredit = Kredit::whereHas('pengajuanKredit', function ($query) use ($pelanggan) {
        $query->where('id_pelanggan', $pelanggan->id);
    })->with([
        'pengajuanKredit.motor',
        'metodeBayar'
    ])->get();

    return view('kredit.my_kredit', compact('kredit'));
}

    public function index()
    {
        $kredit = Kredit::with([
            'pengajuanKredit.pelanggan',
            'pengajuanKredit.motor',
            'metodeBayar'
        ])->get();
    
        // Return the view you want
        return view('kredit.index', compact('kredit'));
    }
    
    public function create()
    {
        $pengajuanKredit = PengajuanKredit::with(['pelanggan', 'motor', 'jenisCicilan'])->get();
        $metodeBayar = MetodeBayar::all();

        return view('kredit.create', compact('pengajuanKredit', 'metodeBayar'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_pengajuan_kredit' => 'required|exists:pengajuan_kredit,id',
        'id_metode_bayar' => 'required|exists:metode_bayar,id',
        'tgl_mulai_kredit' => 'required|date',
        'status_kredit' => 'required|in:Dicicil,Macet,Lunas',
    ]);

    $pengajuan = PengajuanKredit::with('jenisCicilan')->findOrFail($request->id_pengajuan_kredit);
    $tenor = $pengajuan->jenisCicilan->lama_cicilan;
    $tglSelesai = Carbon::parse($request->tgl_mulai_kredit)->addMonths($tenor);
  
    $sisaKredit = $pengajuan->harga_kredit - $pengajuan->dp;
    
    Kredit::create([
        'id_pengajuan_kredit' => $request->id_pengajuan_kredit,
        'id_metode_bayar' => $request->id_metode_bayar,
        'tgl_mulai_kredit' => $request->tgl_mulai_kredit,
        'tgl_selesai_kredit' => $tglSelesai->format('Y-m-d'),
        'sisa_kredit' => $sisaKredit,
        'status_kredit' => $request->status_kredit,
    ]);
    

    return redirect()->route('kredit.index')->with('success', 'Kredit berhasil ditambahkan');
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
            'status_kredit' => 'required|string',
        ]);

        $pengajuan = PengajuanKredit::with('jenisCicilan')->findOrFail($request->id_pengajuan_kredit);
$tenor = $pengajuan->jenisCicilan->lama_cicilan;
$tglSelesai = date('Y-m-d', strtotime("{$request->tgl_mulai_kredit} +{$tenor} months"));

$sisaKredit = $pengajuan->harga_kredit - $pengajuan->dp;

$kredit = Kredit::findOrFail($id);
$kredit->update([
    'id_pengajuan_kredit' => $request->id_pengajuan_kredit,
    'id_metode_bayar' => $request->id_metode_bayar,
    'tgl_mulai_kredit' => $request->tgl_mulai_kredit,
    'tgl_selesai_kredit' => $tglSelesai,
    'sisa_kredit' => $sisaKredit,
    'status_kredit' => $request->status_kredit,
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
