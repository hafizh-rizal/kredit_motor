<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Kredit;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    public function index()
    {
        $angsuran = Angsuran::with('kredit')->get();
        return view('angsuran.index', compact('angsuran'));
    }

    public function create(Request $request)
{
    $kredits = Kredit::all();
    $kreditTerpilih = $request->id_kredit; 
    return view('angsuran.create', compact('kredits', 'kreditTerpilih'));
}


public function store(Request $request)
{
    $request->validate([
        'id_kredit'    => 'required|exists:kredit,id',
        'tgl_bayar'    => 'required|date',
        'angsuran_ke'  => 'required|integer|min:1',
        'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'total_bayar'  => 'required|numeric|min:0',
        'keterangan'   => 'nullable|string|max:255',
    ]);

    try {
        // Simpan angsuran baru dengan status "Menunggu"
        $angsuran = Angsuran::create([
            'id_kredit'    => $request->id_kredit,
            'tgl_bayar'    => $request->tgl_bayar,
            'angsuran_ke'  => $request->angsuran_ke,
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('angsuran', 'public'),
            'total_bayar'  => $request->total_bayar,
            'keterangan'   => $request->keterangan,
            'status_pembayaran' => 'Menunggu',  
        ]);

        $kredit = Kredit::findOrFail($request->id_kredit);

        return redirect()->route('kredit.saya')->with('success', 'Angsuran berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menambahkan angsuran.')->withInput();
    }
}

    public function edit($id)
    {
        $angsuran = Angsuran::findOrFail($id);
        $kredits = Kredit::all();
        return view('angsuran.edit', compact('angsuran', 'kredits'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kredit'    => 'required|exists:kredit,id',
            'tgl_bayar'    => 'required|date',
            'angsuran_ke'  => 'required|integer|min:1',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'total_bayar'  => 'required|numeric|min:0',
            'keterangan'   => 'nullable|string|max:255',
            'status_pembayaran' => 'required|in:Menunggu,Diterima,Ditolak',
        ]);
    
        try {
            $angsuran = Angsuran::findOrFail($id);
            $kredit = Kredit::findOrFail($angsuran->id_kredit);
    
            $oldStatus = $angsuran->status_pembayaran;
            $oldTotalBayar = $angsuran->total_bayar;
            
            // Update data angsuran
            $angsuran->update([
                'id_kredit'    => $request->id_kredit,
                'tgl_bayar'    => $request->tgl_bayar,
                'angsuran_ke'  => $request->angsuran_ke,
                'bukti_pembayaran' => $request->file('bukti_pembayaran') 
                    ? $request->file('bukti_pembayaran')->store('angsuran', 'public') 
                    : $angsuran->bukti_pembayaran,
                'total_bayar'  => $request->total_bayar,
                'keterangan'   => $request->keterangan,
                'status_pembayaran' => $request->status_pembayaran,
            ]);
            
            // Jika sebelumnya status belum Diterima, dan sekarang jadi Diterima
            if ($oldStatus !== 'Diterima' && $request->status_pembayaran === 'Diterima') {
                $newSisaKredit = max(0, $kredit->sisa_kredit - $request->total_bayar);
                $kredit->update([
                    'sisa_kredit' => $newSisaKredit,
                    'status_kredit' => $newSisaKredit <= 0 ? 'Lunas' : 'Dicicil',
                ]);
            }
          
            if ($oldStatus === 'Diterima' && $request->status_pembayaran !== 'Diterima') {
                $kredit->update([
                    'sisa_kredit' => $kredit->sisa_kredit + $oldTotalBayar,
                    'status_kredit' => 'Dicicil',
                ]);
            }
            
            return redirect()->route('angsuran.index')->with('success', 'Angsuran berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui angsuran.')->withInput();
        }
    }
    

    public function destroy($id)
    {
        try {
            $angsuran = Angsuran::findOrFail($id);
            $kredit = Kredit::findOrFail($angsuran->id_kredit);
    
            $kredit->sisa_kredit += $angsuran->total_bayar;
            $kredit->status_kredit = 'Dicicil';
            $kredit->save();
    
            $angsuran->delete();
    
            return redirect()->route('angsuran.index')->with('success', 'Angsuran berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('angsuran.index')->with('error', 'Data angsuran tidak dapat dihapus karena masih terhubung dengan data lain.');
        } catch (\Exception $e) {
            return redirect()->route('angsuran.index')->with('error', 'Terjadi kesalahan saat menghapus data angsuran.');
        }
    }
    
}
