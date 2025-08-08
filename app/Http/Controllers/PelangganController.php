<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;


class PelangganController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('search');
    $filterKota = $request->input('filter_kota');

    $query = Pelanggan::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('nama_pelanggan', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%')
              ->orWhere('no_telp', 'like', '%' . $search . '%');
        });
    }

    if ($filterKota) {
        $query->where('kota1', $filterKota);
    }

    $pelanggans = $query->latest()->get();

    $daftarKota = Pelanggan::select('kota1')->distinct()->pluck('kota1');

    return view('pelanggan.index', compact('pelanggans', 'daftarKota', 'search', 'filterKota'));
}

    
    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {


        $validated = $request->validate([
            'nama_pelanggan' => 'required|max:255',
            'email' => 'required|email|max:255',
            'kata_kunci' => 'required|max:255',
            'no_telp' => 'required|max:15',
            'alamat1' => 'required|max:255',
            'kota1' => 'required|max:255',
            'propinsi1' => 'required|max:255',
            'kodepos1' => 'required|max:255',
            'alamat2' => 'nullable|max:255',
            'kota2' => 'nullable|max:255',
            'propinsi2' => 'nullable|max:255',
            'kodepos2' => 'nullable|max:255',
            'alamat3' => 'nullable|max:255',
            'kota3' => 'nullable|max:255',
            'propinsi3' => 'nullable|max:255',
            'kodepos3' => 'nullable|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pelanggan', 'public');
        }

       $validated['kata_kunci'] = Hash::make($validated['kata_kunci']);
Pelanggan::create($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|max:255',
            'email' => 'required|email|max:255',
            'kata_kunci' => 'required|max:255',
            'no_telp' => 'required|max:15',
            'alamat1' => 'required|max:255',
            'kota1' => 'required|max:255',
            'propinsi1' => 'required|max:255',
            'kodepos1' => 'required|max:255',
            'alamat2' => 'nullable|max:255',
            'kota2' => 'nullable|max:255',
            'propinsi2' => 'nullable|max:255',
            'kodepos2' => 'nullable|max:255',
            'alamat3' => 'nullable|max:255',
            'kota3' => 'nullable|max:255',
            'propinsi3' => 'nullable|max:255',
            'kodepos3' => 'nullable|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($pelanggan->foto && Storage::disk('public')->exists($pelanggan->foto)) {
                Storage::disk('public')->delete($pelanggan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pelanggan', 'public');
        }
if ($request->filled('kata_kunci')) {
    $validated['kata_kunci'] = Hash::make($validated['kata_kunci']);
} else {
    unset($validated['kata_kunci']);
}

$pelanggan->update($validated);


        return redirect()->route('home.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

public function destroy(Pelanggan $pelanggan)
{
    try {
        if ($pelanggan->foto && Storage::disk('public')->exists($pelanggan->foto)) {
            Storage::disk('public')->delete($pelanggan->foto);
        }
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    } catch (QueryException $e) {
        return redirect()->route('pelanggan.index')->with('error', 'Gagal menghapus pelanggan karena masih memiliki data pengajuan kredit.');
    }
}

}
