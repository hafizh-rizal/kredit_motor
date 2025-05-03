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
        // Simpan angsuran baru
        $angsuran = Angsuran::create([
            'id_kredit'    => $request->id_kredit,
            'tgl_bayar'    => $request->tgl_bayar,
            'angsuran_ke'  => $request->angsuran_ke,
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('angsuran', 'public'),
            'total_bayar'  => $request->total_bayar,
            'keterangan'   => $request->keterangan,
        ]);

        // Perbarui sisa kredit setelah angsuran dibayar
        $kredit = Kredit::findOrFail($request->id_kredit);
        $newSisaKredit = $kredit->sisa_kredit - $request->total_bayar;

        $kredit->update([
            'sisa_kredit' => $newSisaKredit,
            // Jika sisa kredit 0, ubah status kredit menjadi Lunas
            'status_kredit' => $newSisaKredit <= 0 ? 'Lunas' : $kredit->status_kredit,
        ]);

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
        ]);
    
        try {
            $angsuran = Angsuran::findOrFail($id);
            $kredit = Kredit::findOrFail($angsuran->id_kredit);
    
            // Hitung perubahan sisa_kredit
            $oldTotalBayar = $angsuran->total_bayar;
            $newSisaKredit = $kredit->sisa_kredit + $oldTotalBayar - $request->total_bayar;
    
            // Perbarui angsuran
            $angsuran->update([
                'id_kredit'    => $request->id_kredit,
                'tgl_bayar'    => $request->tgl_bayar,
                'angsuran_ke'  => $request->angsuran_ke,
                'bukti_pembayaran' => $request->file('bukti_pembayaran') 
                    ? $request->file('bukti_pembayaran')->store('angsuran', 'public') 
                    : $angsuran->bukti_pembayaran,
                'total_bayar'  => $request->total_bayar,
                'keterangan'   => $request->keterangan,
            ]);
    
            // Update sisa kredit
            $kredit->update([
                'sisa_kredit' => $newSisaKredit,
                // Jika sisa kredit 0, ubah status kredit menjadi Lunas
                'status_kredit' => $newSisaKredit <= 0 ? 'Lunas' : $kredit->status_kredit,
            ]);
    
            return redirect()->route('angsuran.index')->with('success', 'Angsuran berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui angsuran.')->withInput();
        }
    }
    

    public function destroy($id)
    {
        try {
            $angsuran = Angsuran::findOrFail($id);
            $angsuran->delete();

            return redirect()->route('angsuran.index')->with('success', 'Angsuran berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('angsuran.index')->with('error', 'Data angsuran tidak dapat dihapus karena masih terhubung dengan data lain.');
        } catch (\Exception $e) {
            return redirect()->route('angsuran.index')->with('error', 'Terjadi kesalahan saat menghapus data angsuran.');
        }
    }
}
